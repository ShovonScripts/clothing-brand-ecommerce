@props([
    'listView' => false,
])

<?php
$classes = ['gm-product-grid'];
if ($listView) $classes[] = 'gm-product-grid--list';
$class = implode(' ', $classes);
?>

<div {{ $attributes->merge(['class' => $class, 'role' => 'list']) }}>
    {{ $slot }}
</div>