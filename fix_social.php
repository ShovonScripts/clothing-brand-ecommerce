<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$i = \App\Models\Information::first();
$i->facebook = 'https://www.facebook.com/gentrymenswear';
$i->instagram = 'https://www.instagram.com/gentrymenswear';
$i->youtube = 'https://www.youtube.com/@gentrymenswear';
$i->save();
echo "Updated social links";