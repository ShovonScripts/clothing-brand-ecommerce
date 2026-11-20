@props([
    'id' => null,
    'active' => false,
    'size' => 'md',
    'card' => false,
    'tooltip' => 'Add to wishlist',
    'onToggle' => null,
])

<?php
$classes = ['gm-wishlist-button', "gm-wishlist-button--{$size}"];
if ($active) $classes[] = 'gm-wishlist-button--active';
if ($card) $classes[] = 'gm-wishlist-button--card';
$class = implode(' ', $classes);

$heartIcon = '<svg class="gm-wishlist-button__icon" viewBox="0 0 24 24" fill="' . ($active ? 'currentColor' : 'none') . '" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>';
?>

<button
    type="button"
    {{ $attributes->merge(['class' => $class, 'data-tooltip' => $tooltip]) }}
    aria-label="{{ $tooltip }}"
    aria-pressed="{{ $active ? 'true' : 'false' }}"
>
    {!! $heartIcon !!}
</button>