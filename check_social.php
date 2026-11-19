<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$i = \App\Models\Information::first();
echo 'facebook: ' . $i->facebook . PHP_EOL;
echo 'instagram: ' . $i->instagram . PHP_EOL;
echo 'youtube: ' . $i->youtube . PHP_EOL;