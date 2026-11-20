@props([
    'variant' => 'primary',
    'size' => 'md',
    'full' => false,
    'loading' => false,
    'disabled' => false,
    'icon' => null,
    'iconPosition' => 'left',
    'tag' => 'button',
    'href' => null,
])

<?php
$classes = ['gm-btn', "gm-btn--{$variant}", "gm-btn--{$size}"];
if ($full) $classes[] = 'gm-btn--full';
if ($loading) $classes[] = 'gm-btn--loading';
if ($disabled) $classes[] = 'gm-btn--disabled';
$class = implode(' ', $classes);

$attrs = ['class' => $class, 'type' => $tag === 'button' ? 'button' : null];
if ($disabled) $attrs['disabled'] = true;
if ($href) { $attrs['href'] = $href; $tag = 'a'; unset($attrs['type']); }
?>

<@php($tag) {{ $attrs->merge($attributes->except(['class']))->class($class) }}>
    @if($icon && $iconPosition === 'left')
        <span class="gm-btn__icon gm-btn__icon--left">{{ $icon }}</span>
    @endif
    <span class="gm-btn__text">{{ $slot }}</span>
    @if($icon && $iconPosition === 'right')
        <span class="gm-btn__icon gm-btn__icon--right">{{ $icon }}</span>
    @endif
</@php($tag)>