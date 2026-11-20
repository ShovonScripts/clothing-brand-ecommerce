<?php
/**
 * Render pages through the kernel (with a cart in session so checkout renders),
 * pull out every inline <script> block and syntax-check it with `node --check`.
 * Usage: php js-check.php <project-dir> <product-id> <variation-id> <owner-user-id> <out-dir>
 */
$dir = $argv[1];
[$productId, $variationId, $ownerId, $out] = [(int) $argv[2], (int) $argv[3], (int) $argv[4], $argv[5]];
chdir($dir);
require $dir . '/vendor/autoload.php';
$app = require $dir . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();
@mkdir($out, 0777, true);

function render(string $uri, ?int $userId = null): string {
    global $app, $kernel;
    $r = Illuminate\Http\Request::create($uri, 'GET');
    $app->instance('request', $r);
    $g = $app['auth']->guard('web');
    $g->setRequest($r);
    $userId ? $g->setUser(App\Models\User::find($userId)) : $g->forgetUser();
    return $kernel->handle($r)->getContent();
}

// Put one item in the session cart so /carts and /checkouts render fully.
$p = App\Models\Product::find($productId);
$data = getProductInfo($p);
session()->put('cart', [$variationId => [
    'name' => $p->name, 'size' => '', 'color' => '', 'quantity' => 1, 'price' => $data['price'],
    'discount' => $data['discount_amount'], 'variation_id' => $variationId, 'product_id' => $productId,
    'image' => $p->image, 'is_stock' => $p->is_stock, 'is_free_shipping' => $p->is_free_shipping,
]]);

$pages = ['/', '/products-list', '/discount-products', '/combo-products', '/free-shipping-product',
          "/product-show/$productId", '/carts', '/checkouts', '/faq', '/about-us', '/contact-us', '/login'];
$owner = ['/orders', '/orders/' . App\Models\Order::where('user_id', $ownerId)->value('id')];

$bad = 0; $total = 0;
foreach (array_merge(array_map(fn ($u) => [$u, null], $pages), array_map(fn ($u) => [$u, $ownerId], $owner)) as [$uri, $uid]) {
    $html = render($uri, $uid);
    preg_match_all('#<script(?![^>]*\bsrc=)(?![^>]*type="application/ld\+json")[^>]*>(.*?)</script>#is', $html, $m);
    foreach ($m[1] as $i => $js) {
        if (trim($js) === '') continue;
        $total++;
        $file = $out . '/' . trim(preg_replace('/[^a-z0-9]+/i', '_', $uri), '_') . "_$i.js";
        file_put_contents($file, $js);
        $res = shell_exec('node --check ' . escapeshellarg($file) . ' 2>&1');
        if (trim((string) $res) !== '') {
            $bad++;
            $first = strtok(trim($res), "\n");
            preg_match('/SyntaxError: (.*)/', $res, $se);
            printf("FAIL %-26s script #%d  %s\n", $uri, $i, $se[1] ?? $first);
        }
    }
}
printf("\n%d inline scripts checked, %d with syntax errors\n", $total, $bad);
