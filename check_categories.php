<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$products = \App\Models\Product::whereIn('id', [185, 186, 187, 188, 189, 190, 191, 192])->with('category')->get();
foreach($products as $p) {
    echo $p->id . ': ' . $p->name . ' -> Category: ' . ($p->category ? $p->category->name : 'NULL') . PHP_EOL;
}