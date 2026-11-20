@props([
    // Cart key = variation id (see Frontend\CartController).
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
    // false = read-only line (e.g. checkout summary): shows the quantity, no controls.
    'editable' => true,
    'drawer' => false,
    // Accepted for backwards compatibility; behaviour now comes from data attributes.
    'onQuantityChange' => null,
    'onRemove' => null,
])

{{--
    Editable lines expose:
      input[data-gm-cart-qty="<id>"]     — fires `change` with the new quantity
      button[data-gm-cart-remove="<id>"] — remove this line
    The page that renders the lines decides what to do with them
    (see frontend/cart/index.blade.php).
--}}
@php
    $variant = array_filter((array) $variant, fn ($v) => filled($v));
@endphp

<div {{ $attributes->merge(['class' => 'gm-cart-line' . ($drawer ? ' gm-cart-line--drawer' : ''), 'data-cart-line-id' => $id]) }}>
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

        <x-ui.price :current="$price" :original="$originalPrice" context="cart" class="gm-cart-line__price" />
    </div>

    <div class="gm-cart-line__quantity">
        @if($editable)
            <x-ui.quantity-stepper
                :name="'quantity_' . $id"
                :value="$quantity"
                :min="1"
                :max="$maxQuantity"
                :stock="$stock"
                :inline="true"
                :data-gm-cart-qty="$id"
            />
        @else
            <span class="gm-cart-line__qty-text">Qty: {{ $quantity }}</span>
        @endif
    </div>

    @if($editable)
        <button type="button" class="gm-cart-line__remove" data-gm-cart-remove="{{ $id }}" aria-label="Remove {{ $name }} from bag">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
        </button>
    @endif
</div>
