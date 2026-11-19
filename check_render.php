<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$sliders = \App\Models\Slider::orderBy('id')->get();
$cats = \App\Models\Category::whereNull('parent_id')->where('is_popular', 1)->with('subcats')->get();
$images = \App\Models\HomeSectionImage::all();

$newArrivals = \App\Models\Product::with(['variation', 'category'])
    ->select('products.id','products.name','products.type','products.sell_price','products.regular_price','products.image','products.is_stock','products.is_free_shipping','products.category_id','products.discount_type','products.discount','products.after_discount','products.dicount_amount','products.created_at')
    ->latest()
    ->take(8)
    ->get();

$saleProducts = \App\Models\Product::with(['variation', 'category'])
    ->select('products.id','products.name','products.type','products.sell_price','products.regular_price','products.image','products.is_stock','products.is_free_shipping','products.category_id','products.discount_type','products.discount','products.after_discount','products.dicount_amount','products.created_at')
    ->whereNotNull('products.discount_type')
    ->take(4)
    ->get();

$recommended = \App\Models\Product::with(['variation', 'category'])
    ->select('products.id','products.name','products.type','products.sell_price','products.regular_price','products.image','products.is_stock','products.is_free_shipping','products.category_id','products.discount_type','products.discount','products.after_discount','products.dicount_amount','products.created_at')
    ->where('products.is_recommended', 1)
    ->take(4)
    ->get();

$view = view('frontend.home', compact('sliders','cats','brands','images','newArrivals','saleProducts','recommended'));
$html = $view->render();

// Extract categories
$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXPath($dom);
$metas = $xpath->query('//div[contains(@class, "gm-card-meta")]');
foreach($metas as $meta) {
    echo trim($meta->textContent) . "\n";
}