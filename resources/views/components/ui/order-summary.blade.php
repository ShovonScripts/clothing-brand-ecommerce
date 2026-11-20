@props([
    'subtotal' => 0,
    // null = not known yet (the delivery area is chosen at checkout).
    'shipping' => null,
    'shippingLabel' => 'Calculated at checkout',
    // Money taken off the total (e.g. a coupon).
    'discount' => 0,
    // Informational only: what product markdowns already saved (prices are already reduced).
    'savings' => 0,
    // Defaults to subtotal + shipping - discount.
    'total' => null,
    'variant' => 'default',
    'actionText' => 'Proceed to checkout',
    // null = no action button.
    'actionUrl' => null,
    // Ignored, kept so older callers don't render them as HTML attributes:
    // the store currency comes from priceFormate(), and the store has no free-shipping threshold.
    'currency' => null,
    'freeShippingThreshold' => null,
    'tax' => 0,
])

@php
    $grandTotal = $total ?? ($subtotal + ($shipping ?? 0) - $discount);
@endphp

<div {{ $attributes->merge(['class' => "gm-order-summary gm-order-summary--{$variant}"]) }}>
    <h2 class="gm-order-summary__title">Order summary</h2>

    <div class="gm-order-summary__rows">
        <div class="gm-order-summary__row gm-order-summary__row--subtotal">
            <span class="gm-order-summary__label">Subtotal</span>
            <span class="gm-order-summary__value" data-gm-summary="subtotal">{{ priceFormate($subtotal) }}</span>
        </div>

        <div class="gm-order-summary__row gm-order-summary__row--shipping">
            <span class="gm-order-summary__label">Delivery</span>
            <span class="gm-order-summary__value" data-gm-summary="shipping">
                {{ $shipping === null ? $shippingLabel : ($shipping > 0 ? priceFormate($shipping) : 'Free') }}
            </span>
        </div>

        <div class="gm-order-summary__row gm-order-summary__row--discount" data-gm-summary-row="discount" @if($discount <= 0) hidden @endif>
            <span class="gm-order-summary__label">Discount</span>
            <span class="gm-order-summary__value" data-gm-summary="discount">−{{ priceFormate($discount) }}</span>
        </div>

        @if($tax > 0)
            <div class="gm-order-summary__row">
                <span class="gm-order-summary__label">Tax</span>
                <span class="gm-order-summary__value">{{ priceFormate($tax) }}</span>
            </div>
        @endif
    </div>

    <div class="gm-order-summary__divider"></div>

    <div class="gm-order-summary__total">
        <span class="gm-order-summary__label">Total</span>
        <span class="gm-order-summary__value gm-order-summary__total-value" data-gm-summary="total">{{ priceFormate($grandTotal) }}</span>
    </div>

    @if($savings > 0)
        <p class="gm-order-summary__shipping-notice gm-order-summary__shipping-notice--free">
            You save {{ priceFormate($savings) }} on this order
        </p>
    @endif

    {{ $slot }}

    @if($actionUrl)
        <div class="gm-order-summary__actions">
            <x-ui.button variant="primary" size="lg" full :href="$actionUrl">{{ $actionText }}</x-ui.button>
            @if($variant === 'cart')
                <x-ui.button variant="ghost" size="md" full :href="route('front.products.index')">Continue shopping</x-ui.button>
            @endif
        </div>
    @endif
</div>
