@props([
    'size' => 'md',
    'background' => null,
    'container' => true,
])

<?php
$classes = ['gm-section', "gm-section--{$size}"];
if ($background) $classes[] = 'gm-bg-' . $background;
$class = implode(' ', $classes);
?>

<section {{ $attributes->merge(['class' => $class]) }}>
    @if($container)
        <x-ui.container>{{ $slot }}</x-ui.container>
    @else
        {{ $slot }}
    @endif
</section>