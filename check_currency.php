<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$i = \App\Models\Information::first();
echo "Currency: " . $i->currency . "\n";
echo "Currency symbol: " . $i->currency_symbol . "\n";