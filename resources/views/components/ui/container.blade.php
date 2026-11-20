@props([
    'fluid' => false,
    'narrow' => false,
    'wide' => false,
])

<?php
$classes = ['gm-container'];
if ($fluid) $classes[] = 'gm-container--fluid';
if ($narrow) $classes[] = 'gm-container--narrow';
if ($wide) $classes[] = 'gm-container--wide';
$class = implode(' ', $classes);
?>

<div {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>