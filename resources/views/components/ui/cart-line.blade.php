@props([
    'id' => null,
    'image' => null,
    'name' => null,
    'href' => '#',
    'variant' => [],
    'price' => 0,
    'originalPrice' => null,
    'quantity' => 1,
    'maxQuantity' => 99,
    'stock' => null,
    'onQuantityChange' => null,
    'onRemove' => null,
    'drawer' => false,
])

<?php
$classes = ['gm-cart-line'];
if ($drawer) $classes[] = 'gm-cart-line--drawer';
$class = implode(' ', $classes);
?>

<div {{ $attributes->merge(['class' => $class, 'data-cart-line-id' => $id]) }}>
    <a href="{{ $href }}" class="gm-cart-line__image-wrapper" aria-label="{{ $name }}">
        @if($image)
            <img src="{{ $image }}" alt="" class="gm-cart-line__image" loading="lazy" width="160" height="160">
        @else
            <div class="gm-skeleton gm-skeleton--box" aria-hidden="true"></div>
        @endif
    </a>

    <div class="gm-cart-line__details">
        <a href="{{ $href }}" class="gm-cart-line__link">
            <h3 class="gm-cart-line__name">{{ $name }}</h3>
        </a>

        @if($variant)
            <div class="gm-cart-line__variant">
                @foreach($variant as $key => $value)
                    <span class="gm-cart-line__variant-item">
                        <span class="gm-cart-line__variant-label">{{ $key }}:</span>
                        <span class="gm-cart-line__variant-value">{{ $value }}</span>
                    </span>
                @endforeach
            </div>
        @endif

        <x-ui.price
            :current="$price"
            :original="$originalPrice"
            context="cart"
            class="gm-cart-line__price"
        />
    </div>

    <div class="gm-cart-line__quantity">
        <x-ui.quantity-stepper
            :name="'quantity_' . $id"
            :value="$quantity"
            :min="1"
            :max="$maxQuantity"
            :stock="$stock"
            :inline="true"
            :onChange="$onQuantityChange"
        />
    </div>

    @if($onRemove)
        <button
            type="button"
            class="gm-cart-line__remove"
            wire:click="{{ $onRemove }}"
            aria-label="Remove {{ $name }} from cart"
        >
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
        </button>
    @endif
</div>