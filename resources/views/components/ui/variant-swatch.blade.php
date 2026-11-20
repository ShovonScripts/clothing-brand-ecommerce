@props([
    'name' => null,
    'label' => null,
    'value' => null,
    'selected' => false,
    'disabled' => false,
    'color' => null,
    'size' => 'md',
    'onSelect' => null,
])

<?php
$classes = ['gm-variant-swatch', "gm-variant-swatch--{$size}"];
if ($color) $classes[] = 'gm-variant-swatch--color';
if ($selected) $classes[] = 'gm-variant-swatch--selected';
if ($disabled) $classes[] = 'gm-variant-swatch--disabled';

$style = '';
if ($color) $style = 'style="--swatch-color: ' . e($color) . '"';
?>

@if($onSelect)
    <button
        type="button"
        class="{{ implode(' ', $classes) }}"
        {{ $style }}
        @if($disabled) disabled @endif
        wire:click="{{ $onSelect }}"
        {{ $attributes->except(['class', 'disabled', 'style']) }}
        aria-pressed="{{ $selected ? 'true' : 'false' }}"
        aria-label="{{ $label ?: $value }}"
    >
        @if(!$color) {{ $value }} @endif
    </button>
@else
    <input
        type="radio"
        name="{{ $name }}"
        value="{{ $value }}"
        id="{{ $attributes->get('id') ?? 'gm-swatch-' . uniqid() }}"
        class="gm-variant-swatch__input"
        @if($selected) checked @endif
        @if($disabled) disabled @endif
        @if($onSelect) wire:click="$dispatch('variant-select', { name: '{{ $name }}', value: '{{ $value }}' })" @endif
        {{ $attributes->except(['class', 'id', 'value', 'checked', 'disabled']) }}
    >
    <label
        for="{{ $attributes->get('id') ?? 'gm-swatch-' . uniqid() }}"
        class="{{ implode(' ', $classes) }}"
        {{ $style }}
        {{ $attributes->except(['class', 'for', 'style']) }}
    >
        @if(!$color) {{ $value }} @endif
    </label>
@endif