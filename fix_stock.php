<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$p = \App\Models\Product::find(169);
$p->is_stock = 10;
$p->save();
// Update product_stocks
$stocks = \App\Models\ProductStock::whereIn('variation_id', $p->variations->pluck('id'))->get();
foreach($stocks as $s) {
    $s->quantity = 10;
    $s->save();
}
echo "Updated stock to 10";