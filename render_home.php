<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Simulate the homepage rendering
$sliders = \App\Models\Slider::orderBy('id')->get();
$cats = \App\Models\Category::whereNull('parent_id')->where('is_popular', 1)->with('subcats')->get();
$images = \App\Models\HomeSectionImage::all();

$newArrivals = \App\Models\Product::with(['variation', 'category'])
    ->select('products.id','products.name','products.type','products.sell_price','products.regular_price','products.image','products.is_stock','products.is_free_shipping','products.category_id','products.discount_type','products.discount','products.after_discount','products.dicount_amount','products.created_at')
    ->latest()
    ->take(8)
    ->get();

$view = view('frontend.home', compact('sliders','cats','brands','images','newArrivals','saleProducts','recommended'));
echo $view->render();