@props([
    'name' => null,
    'value' => 1,
    'min' => 1,
    'max' => 99,
    // Known stock for this item, or null when unknown. Only drives the low-stock note.
    'stock' => null,
    'size' => 'md',
    'inline' => false,
    'id' => null,
])

{{--
    The − / + buttons are wired in resources/js/ui.js: they clamp the value to
    min/max and fire a bubbling `change` event on the input, so pages listen for
    `change` on the input (or the form) exactly as they would for typing.
    Extra attributes (e.g. data-*) go on the <input>.
--}}
@php
    $stepperId = $id ?? 'gm-qty-' . uniqid();
    $classes = ['gm-quantity-stepper', "gm-quantity-stepper--{$size}"];
    if ($inline) $classes[] = 'gm-quantity-stepper--inline';
    $cap = $stock !== null ? min((int) $max, (int) $stock) : (int) $max;
    $left = $stock !== null ? (int) $stock - (int) $value : null;
@endphp

<div class="{{ implode(' ', $classes) }}" data-gm-qty>
    <button type="button" class="gm-quantity-stepper__btn gm-quantity-stepper__btn--decrement"
            data-gm-qty-step="-1" aria-label="Decrease quantity" @disabled($value <= $min)>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
    </button>

    <input
        type="number"
        @if($name) name="{{ $name }}" @endif
        id="{{ $stepperId }}"
        value="{{ $value }}"
        min="{{ $min }}"
        max="{{ $cap }}"
        aria-label="Quantity"
        inputmode="numeric"
        {{ $attributes->merge(['class' => 'gm-quantity-stepper__input']) }}
    />

    <button type="button" class="gm-quantity-stepper__btn gm-quantity-stepper__btn--increment"
            data-gm-qty-step="1" aria-label="Increase quantity" @disabled($value >= $cap)>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
    </button>
</div>

@if($left !== null && $left <= 5)
    <p class="gm-quantity-stepper__limit {{ $left <= 0 ? 'gm-quantity-stepper__limit--error' : 'gm-quantity-stepper__limit--warning' }}">
        {{ $left <= 0 ? 'No more in stock' : "Only {$stock} left in stock" }}
    </p>
@endif
