@props([
    'variant' => 'text',
    'width' => '100%',
    'height' => null,
    'count' => 1,
    'animation' => true,
])

<?php
$classes = ['gm-skeleton', "gm-skeleton--{$variant}"];
if (!$animation) $classes[] = 'gm-skeleton--no-animation';

$style = 'width: ' . $width . ';';
if ($height) $style .= ' height: ' . $height . ';';
?>

@for($i = 0; $i < $count; $i++)
    <div
        {{ $attributes->merge(['class' => implode(' ', $classes), 'style' => $style, 'aria-hidden' => 'true', 'role' => 'status', 'aria-label' => 'Loading...']) }}
    ></div>
@endfor