<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$newArrivals = \App\Models\Product::with(['variation', 'category'])
    ->select('products.id','products.name','products.type','products.sell_price','products.regular_price','products.image','products.is_stock','products.is_free_shipping','products.category_id','products.discount_type','products.discount','products.after_discount','products.dicount_amount','products.created_at')
    ->latest()
    ->take(8)
    ->get();

foreach($newArrivals as $p) {
    echo $p->id . ': ' . $p->name . ' -> Category: ' . ($p->category ? $p->category->name : 'NULL') . PHP_EOL;
}