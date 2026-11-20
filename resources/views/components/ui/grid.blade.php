@props([
    'columns' => 4,
    'gap' => 4,
    'autoFit' => false,
    'minWidth' => 240,
    'listView' => false,
])

<?php
$classes = ['gm-grid'];
if ($autoFit) {
    $classes[] = 'gm-grid--auto';
} else {
    $classes[] = "gm-grid--{$columns}";
}
$classes[] = "gm-grid--gap-{$gap}";
if ($listView) $classes[] = 'gm-product-grid--list';
$class = implode(' ', $classes);

$style = '';
if ($autoFit) {
    $style = 'style="grid-template-columns: repeat(auto-fill, minmax(' . $minWidth . 'px, 1fr));"';
}
?>

<div {{ $attributes->merge(['class' => $class, 'style' => $style, 'role' => 'list']) }}>
    {{ $slot }}
</div>