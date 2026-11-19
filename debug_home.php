<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$newArrivals = \App\Models\Product::with(['variation', 'category'])
    ->select('products.id','products.name','products.type','products.sell_price','products.regular_price','products.image','products.is_stock','products.is_free_shipping','products.category_id','products.discount_type','products.discount','products.after_discount','products.dicount_amount','products.created_at')
    ->latest()
    ->take(8)
    ->get();

echo "=== NEW ARRIVALS ===\n";
foreach($newArrivals as $p) {
    $data = getProductInfo($p);
    $hasDiscount = ($data['discount_amount'] > 0 && $data['old_price'] > 0);
    $categoryName = optional($p->category)->name;
    $isSingle = ($p->type ?? 'single') === 'single';
    $variationId = optional($p->variation)->id;
    echo $p->id . ': ' . $p->name . ' | Category: ' . $categoryName . ' | isSingle: ' . ($isSingle ? 'yes' : 'no') . ' | variationId: ' . $variationId . "\n";
}