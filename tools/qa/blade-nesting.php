<?php
/**
 * Print the Blade block-directive structure of a file with line numbers and
 * indentation, flagging unmatched closers and unclosed openers.
 * Usage: php blade-nesting.php <file.blade.php>
 */
$src = file($argv[1]);
$open = ['if', 'foreach', 'forelse', 'for', 'while', 'isset', 'empty', 'auth', 'guest', 'unless', 'push', 'section', 'php', 'switch', 'can'];
$close = ['endif' => 'if', 'endforeach' => 'foreach', 'endforelse' => 'forelse', 'endfor' => 'for', 'endwhile' => 'while',
          'endisset' => 'isset', 'endempty' => 'empty', 'endauth' => 'auth', 'endguest' => 'guest', 'endunless' => 'unless',
          'endpush' => 'push', 'endsection' => 'section', 'endphp' => 'php', 'endswitch' => 'switch', 'endcan' => 'can', 'stop' => 'section'];
$stack = [];
foreach ($src as $n => $line) {
    // ignore Blade comments on the line
    $line = preg_replace('/\{\{--.*?--\}\}/', '', $line);
    preg_match_all('/@(\w+)(\s*\()?/', $line, $m, PREG_SET_ORDER);
    foreach ($m as $d) {
        $name = $d[1];
        $hasArgs = !empty($d[2]);
        if ($name === 'php' && $hasArgs) continue;          // inline @php(...)
        if ($name === 'section' && $hasArgs && preg_match('/@section\s*\([^,]+,/', $line)) continue; // @section('x','y')
        if (in_array($name, ['else', 'elseif', 'empty']) && $name !== 'empty') {
            printf("%4d %s@%s\n", $n + 1, str_repeat('  ', max(0, count($stack) - 1)), $name);
            continue;
        }
        if (in_array($name, $open, true)) {
            if ($name === 'empty' && end($stack) === 'forelse') { printf("%4d %s@empty (forelse)\n", $n + 1, str_repeat('  ', count($stack) - 1)); continue; }
            printf("%4d %s@%s\n", $n + 1, str_repeat('  ', count($stack)), $name);
            $stack[] = $name;
        } elseif (isset($close[$name])) {
            $want = $close[$name];
            $top = end($stack);
            if ($top !== $want) {
                printf("%4d %s@%s   <<< UNMATCHED (open block is @%s)\n", $n + 1, str_repeat('  ', max(0, count($stack) - 1)), $name, $top ?: 'nothing');
            } else {
                array_pop($stack);
                printf("%4d %s@%s\n", $n + 1, str_repeat('  ', count($stack)), $name);
            }
        }
    }
}
if ($stack) echo "UNCLOSED at EOF: @" . implode(', @', $stack) . "\n";
