<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$p = \App\Models\Product::find(169);
foreach($p->variations as $v) echo $v->id . ': ' . $v->price . PHP_EOL;