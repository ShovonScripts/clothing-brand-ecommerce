<?php
/**
 * Smoke-crawl every GET route of the Laravel app through the HTTP kernel.
 * Usage: php crawl.php <project-dir> <product-id> <order-id>
 * Prints one line per route: STATUS  [guest|user|admin]  URI  (error if any)
 */
$dir = $argv[1];
$productId = $argv[2] ?? 1;
$orderId = $argv[3] ?? 1;
chdir($dir);
require $dir . '/vendor/autoload.php';
$app = require $dir . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap(); // boots providers so routes get registered

// Fill route params with real ids where we know them, else "1".
function fillUri(string $uri, $productId, $orderId): ?string {
    $map = [
        'product-show/{id}' => "product-show/$productId",
        'relative-product/{id}' => "relative-product/$productId",
        'orders/{order}' => "orders/$orderId",
        'admin/products/{product}' => "admin/products/$productId",
        'admin/products/{product}/edit' => "admin/products/$productId/edit",
        'admin/orders/{order}' => "admin/orders/$orderId",
        'admin/orders/{order}/edit' => "admin/orders/$orderId/edit",
    ];
    if (isset($map[$uri])) return $map[$uri];
    if (strpos($uri, '{') === false) return $uri;
    return null; // skip other parameterised routes
}

$skip = '#^(_ignition|sanctum|api/|logout|admin/logout|send-sms|cart/clear-all|.*delete.*|.*destroy.*|.*export.*|.*download.*|.*print.*|.*invoice.*)#i';

$routes = [];
foreach (app('router')->getRoutes() as $r) {
    if (!in_array('GET', $r->methods())) continue;
    $uri = $r->uri();
    if (preg_match($skip, $uri)) continue;
    $u = fillUri($uri, $productId, $orderId);
    if ($u === null) continue;
    $routes[] = $u;
}
$routes = array_values(array_unique($routes));

function hit($kernel, string $uri, ?int $userId): array {
    global $app;
    $req = Illuminate\Http\Request::create('/' . ltrim($uri, '/'), 'GET');
    $app->instance('request', $req);
    $guard = $app['auth']->guard('web');
    $guard->setRequest($req);
    if ($userId) { $guard->setUser(App\Models\User::find($userId)); } else { $guard->forgetUser(); }
    try {
        $res = $kernel->handle($req);
        $err = '';
        if (property_exists($res, 'exception') && $res->exception) {
            $ex = $res->exception;
            $err = class_basename($ex) . ': ' . mb_substr(str_replace(["\n", "\r"], ' ', $ex->getMessage()), 0, 160);
            if ($ex->getPrevious()) $err .= ' <= ' . mb_substr($ex->getPrevious()->getMessage(), 0, 120);
        }
        $loc = $res->headers->get('Location');
        return [$res->getStatusCode(), $err, $loc];
    } catch (Throwable $t) {
        return [599, class_basename($t) . ': ' . mb_substr($t->getMessage(), 0, 160), null];
    }
}

$admin = 1; $user = 24;
foreach ($routes as $u) {
    $who = str_starts_with($u, 'admin') ? 'admin' : 'guest';
    [$s, $err, $loc] = hit($kernel, $u, $who === 'admin' ? $admin : null);
    // auth-protected frontend pages: retry as a logged-in customer
    if ($who === 'guest' && $s === 302 && $loc && str_contains($loc, 'login')) {
        $who = 'user';
        [$s, $err, $loc] = hit($kernel, $u, $user);
    }
    printf("%d  %-5s  /%s%s\n", $s, $who, $u, $err ? "   !! $err" : '');
}
