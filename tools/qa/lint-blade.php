<?php
/**
 * Compile Blade views to PHP and lint each one, printing the offending
 * compiled line plus nearby source context.
 * Usage: php lint-blade.php <project-dir> <view-file> [<view-file> ...]
 */
$dir = $argv[1];
chdir($dir);
require $dir . '/vendor/autoload.php';
$app = require $dir . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$blade = app('blade.compiler');
$tmp = sys_get_temp_dir() . '/blade_lint_' . getmypid() . '.php';

foreach (array_slice($argv, 2) as $file) {
    try {
        $php = $blade->compileString(file_get_contents($file));
    } catch (Throwable $t) {
        echo "COMPILE-FAIL $file: " . $t->getMessage() . "\n";
        continue;
    }
    file_put_contents($tmp, $php);
    $out = shell_exec('php -l ' . escapeshellarg($tmp) . ' 2>&1');
    if (strpos($out, 'No syntax errors') !== false) { echo "OK   $file\n"; continue; }
    preg_match('/on line (\d+)/', $out, $m);
    $line = (int)($m[1] ?? 0);
    $lines = explode("\n", $php);
    $msg = trim(preg_replace('/\s+in .*? on line \d+.*/s', '', $out));
    echo "FAIL $file  [compiled line $line] $msg\n";
    echo "     >> " . mb_substr(trim($lines[$line - 1] ?? ''), 0, 260) . "\n";
}
@unlink($tmp);
