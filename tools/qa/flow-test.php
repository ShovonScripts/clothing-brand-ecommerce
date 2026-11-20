<?php
/**
 * End-to-end shopping flow through the real HTTP kernel, inside a DB
 * transaction that is rolled back at the end (nothing is left in the DB).
 *
 * Usage: php flow-test.php <project-dir> <product-id> <variation-id> <order-owner-user-id>
 */
$dir = $argv[1];
[$productId, $variationId, $ownerId] = [(int) $argv[2], (int) $argv[3], (int) $argv[4]];
chdir($dir);
require $dir . '/vendor/autoload.php';
$app = require $dir . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

$cookies = [];
$csrf = null;
$fails = 0;

function req(string $method, string $uri, array $params = [], bool $ajax = false, ?int $userId = null) {
    global $app, $kernel, $cookies, $csrf;
    $server = [];
    if ($ajax) {
        $server['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $server['HTTP_ACCEPT'] = 'application/json, text/html';
    }
    if ($csrf) $server['HTTP_X_CSRF_TOKEN'] = $csrf;
    $request = Request::create($uri, $method, $params, $cookies, [], $server);
    $app->instance('request', $request);
    $guard = $app['auth']->guard('web');
    $guard->setRequest($request);
    if ($userId) $guard->setUser(App\Models\User::find($userId)); else $guard->forgetUser();

    $response = $kernel->handle($request);
    foreach ($response->headers->getCookies() as $c) $cookies[$c->getName()] = $c->getValue();
    $body = $response->getContent();
    if (preg_match('/<meta name="csrf-token" content="([^"]+)"/', $body, $m)) $csrf = $m[1];
    $err = (property_exists($response, 'exception') && $response->exception) ? $response->exception->getMessage() : '';
    return [$response->getStatusCode(), $body, $err];
}

function check(string $label, bool $ok, string $detail = '') {
    global $fails;
    if (!$ok) $fails++;
    printf("%s  %s%s\n", $ok ? 'PASS' : 'FAIL', $label, $detail !== '' ? "  — $detail" : '');
}

function money(string $html, string $key): ?float {
    if (!preg_match('/data-gm-summary="' . $key . '"[^>]*>\s*([^<]+)</u', $html, $m)) return null;
    return (float) preg_replace('/[^0-9.]/', '', $m[1]);
}

DB::beginTransaction();
try {
    // ---- Browse ----------------------------------------------------------
    [$s, $b, $e] = req('GET', '/');
    check('home renders', $s === 200, $e);

    [$s, $b, $e] = req('GET', '/products-list');
    check('shop page renders', $s === 200 && str_contains($b, 'id="gm-shop-filters"'), $e);
    check('shop: filter inputs use controller names', str_contains($b, 'name="cat_id[]"') && str_contains($b, 'name="brand_id"') && str_contains($b, 'name="size_id[]"'));

    [$s, $b, $e] = req('GET', '/products-list?page=1', [], true);
    check('shop AJAX returns product cards', $s === 200 && str_contains($b, 'gm-product-card'), $e ?: substr(strip_tags($b), 0, 80));
    check('shop AJAX card has quick-add form', str_contains($b, 'gm-quick-add') && str_contains($b, 'name="variation_id"'));

    [$s, $b, $e] = req('GET', '/products-list?cat_id[]=999999', [], true);
    check('shop AJAX filter with no match shows empty state', $s === 200 && str_contains($b, 'No products found'), $e);

    [$s, $b, $e] = req('GET', '/discount-products', [], true);
    $json = json_decode($b, true);
    check('sale AJAX returns JSON html', $s === 200 && isset($json['html']), $e);

    [$s, $b, $e] = req('GET', "/product-show/$productId");
    check('product page renders', $s === 200, $e);
    check('product page: tabs use new component', str_contains($b, 'data-gm-tabs') && str_contains($b, 'data-gm-tab-panel'));
    check('product page: no Livewire leftovers', !str_contains($b, 'wire:') && !str_contains($b, '$dispatch'));

    // ---- Cart --------------------------------------------------------------
    $is_stock = (int) App\Models\Product::find($productId)->is_stock;
    [$s, $b, $e] = req('POST', '/cart/store', ['product_id' => $productId, 'variation_id' => $variationId, 'quantity' => 1, 'is_stock' => $is_stock], true);
    $json = json_decode($b, true);
    check('quick add to bag (POST /cart/store)', $s === 200 && ($json['success'] ?? false), $e ?: ($json['msg'] ?? substr($b, 0, 120)));

    [$s, $b, $e] = req('GET', "/carts/$variationId/edit?quantity=2", [], true);
    $json = json_decode($b, true);
    check('change quantity to 2 (GET /carts/{id}/edit)', $s === 200 && ($json['success'] ?? false), $e ?: ($json['msg'] ?? ''));

    [$s, $b, $e] = req('GET', '/carts');
    check('bag page renders with the line', $s === 200 && str_contains($b, 'data-gm-cart-qty="' . $variationId . '"'), $e);
    $line = session('cart')[$variationId] ?? null;
    $expectedSubtotal = $line ? $line['price'] * $line['quantity'] : null;
    check('bag subtotal = Σ price × qty (no double discount)', money($b, 'subtotal') === (float) $expectedSubtotal, 'shown ' . money($b, 'subtotal') . ' expected ' . $expectedSubtotal);
    check('bag shows no invented delivery fee', str_contains($b, 'Calculated at checkout'));
    check('bag total = subtotal', money($b, 'total') === (float) $expectedSubtotal);

    // ---- Checkout ------------------------------------------------------------
    [$s, $b, $e] = req('GET', '/checkouts');
    check('checkout renders', $s === 200 && str_contains($b, 'id="checkout_form"'), $e);
    foreach (['first_name', 'mobile', 'shipping_address', 'ip_address', 'delivery_charge_id', 'payment_method', 'pay_num', 'tnx_id'] as $f) {
        check("checkout field name=\"$f\"", str_contains($b, 'name="' . $f . '"'));
    }
    check('checkout loads checkout.js (AJAX submit)', str_contains($b, 'frontend/js/checkout.js'));
    check('checkout ip_address prefilled server-side', (bool) preg_match('/name="ip_address" id="ip_address" value="[^"]+"/', $b));
    check('checkout: no PayPal/Stripe options offered', !str_contains($b, 'value="paypal"') && !str_contains($b, 'value="stripe"'));
    check('checkout: Bangla delivery titles intact (UTF-8)', str_contains($b, 'ঢাকার ভিতরে'));
    $charge = App\Models\DeliveryCharge::whereNotNull('status')->first();
    $shownTotal = money($b, 'total');
    $expectedTotal = $expectedSubtotal + ($charge->amount ?? 0);
    check('checkout total = subtotal + first delivery charge', $shownTotal === (float) $expectedTotal, "shown $shownTotal expected $expectedTotal");

    [$s, $b, $e] = req('POST', '/checkouts', [
        'first_name' => 'Flow Test', 'mobile' => '01700000000', 'shipping_address' => 'Test Road, Dhaka',
        'ip_address' => '127.0.0.1', 'delivery_charge_id' => $charge->id, 'payment_method' => 'cash', 'note' => '',
    ], true);
    $json = json_decode($b, true);
    check('place order (cash) → success JSON with redirect url', $s === 200 && ($json['success'] ?? false) && !empty($json['url']), $e ?: ($json['msg'] ?? substr($b, 0, 160)));
    $order = App\Models\Order::latest('id')->first();
    check('stored final_amount = total shown at checkout', $order && (float) $order->final_amount === (float) $shownTotal, 'db ' . ($order->final_amount ?? 'none') . " shown $shownTotal");
    check('cart emptied after order', empty(session('cart')));

    if (!empty($json['url'])) {
        [$s, $b, $e] = req('GET', parse_url($json['url'], PHP_URL_PATH));
        check('order confirmation page renders', $s === 200, $e);
    }

    // ---- Account pages (as the owner of existing orders) ---------------------
    [$s, $b, $e] = req('GET', '/orders', [], false, $ownerId);
    check('my orders renders', $s === 200 && str_contains($b, 'gm-dashboard-layout'), $e);
    $mine = App\Models\Order::where('user_id', $ownerId)->value('id');
    [$s, $b, $e] = req('GET', "/orders/$mine", [], false, $ownerId);
    check('order detail renders', $s === 200 && str_contains($b, 'gm-order-steps'), $e);
    check('order detail logout is a real form', str_contains($b, 'action="' . route('logout') . '"'));
} finally {
    DB::rollBack();
}
echo $fails ? "\n$fails check(s) FAILED\n" : "\nALL CHECKS PASSED\n";
exit($fails ? 1 : 0);
