@props([
    'name' => null,
    'value' => 1,
    'min' => 1,
    'max' => 99,
    'stock' => null,
    'size' => 'md',
    'inline' => false,
    'id' => null,
    'onChange' => null,
])

<?php
$stepperId = $id ?? 'gm-qty-' . uniqid();
$classes = ['gm-quantity-stepper', "gm-quantity-stepper--{$size}"];
if ($inline) $classes[] = 'gm-quantity-stepper--inline';
$class = implode(' ', $classes);
?>

<div {{ $attributes->merge(['class' => $class]) }}>
    <button
        type="button"
        class="gm-quantity-stepper__btn gm-quantity-stepper__btn--decrement"
        @if($value <= $min) disabled @endif
        @if($onChange) wire:click="$dispatch('quantity-change', { name: '{{ $name }}', value: {{ $value - 1 }} })" @endif
        aria-label="Decrease quantity"
    >
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
    </button>

    <input
        type="number"
        name="{{ $name }}"
        id="{{ $stepperId }}"
        class="gm-quantity-stepper__input"
        value="{{ $value }}"
        min="{{ $min }}"
        max="{{ $max }}"
        @if($onChange) wire:model.debounce.300ms="{{ $name }}" @endif
        aria-label="Quantity"
        inputmode="numeric"
        {{ $attributes->except(['class', 'id', 'name', 'value', 'min', 'max']) }}
    />

    <button
        type="button"
        class="gm-quantity-stepper__btn gm-quantity-stepper__btn--increment"
        @if($stock !== null && $value >= $stock) disabled @endif
        @if($max !== null && $value >= $max) disabled @endif
        @if($onChange) wire:click="$dispatch('quantity-change', { name: '{{ $name }}', value: {{ $value + 1 }} })" @endif
        aria-label="Increase quantity"
    >
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
    </button>
</div>

@if($stock !== null || $max !== null)
    <p class="gm-quantity-stepper__limit"
       @if($stock !== null && $value >= $stock) class="gm-quantity-stepper__limit--error" @endif
       @if($stock !== null && $value >= $stock - 2 && $value < $stock) class="gm-quantity-stepper__limit--warning" @endif
    >
        @if($stock !== null)
            {{ $stock - $value > 0 ? "Only {$stock} left in stock" : 'Out of stock' }}
        @elseif($max !== null && $value >= $max)
            Maximum quantity reached
        @endif
    </p>
@endif