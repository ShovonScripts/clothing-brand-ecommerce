@props([
    'subtotal' => 0,
    'shipping' => 0,
    'discount' => 0,
    'tax' => 0,
    'total' => 0,
    'currency' => 'BDT',
    'freeShippingThreshold' => null,
    'variant' => 'default',
    'actionText' => 'Proceed to checkout',
    'actionUrl' => '#',
    'onAction' => null,
])

<?php
$classes = ['gm-order-summary', "gm-order-summary--{$variant}"];
$class = implode(' ', $classes);

$symbol = $currency === 'BDT' ? '৳' : '$';
$format = fn($v) => $symbol . number_format($v, 2);

$showShippingProgress = $freeShippingThreshold && $subtotal < $freeShippingThreshold;
$progressPercent = $showShippingProgress ? min(100, ($subtotal / $freeShippingThreshold) * 100) : 100;
?>

<div {{ $attributes->merge(['class' => $class]) }}>
    <h2 class="gm-order-summary__title">Order Summary</h2>

    <div class="gm-order-summary__rows">
        <div class="gm-order-summary__row gm-order-summary__row--subtotal">
            <span class="gm-order-summary__label">Subtotal</span>
            <span class="gm-order-summary__value">{{ $format($subtotal) }}</span>
        </div>

        @if($shipping > 0 || $showShippingProgress)
            <div class="gm-order-summary__row gm-order-summary__row--shipping">
                <span class="gm-order-summary__label">Shipping</span>
                <span class="gm-order-summary__value">
                    @if($showShippingProgress)
                        {{ $format($shipping) }}
                    @else
                        {{ $format($shipping) }}
                    @endif
                </span>
            </div>

            @if($showShippingProgress)
                <div class="gm-order-summary__shipping-progress">
                    <div class="gm-order-summary__shipping-progress-bar">
                        <div class="gm-order-summary__shipping-progress-fill" style="width: {{ $progressPercent }}%"></div>
                    </div>
                    <p class="gm-order-summary__shipping-progress-text">
                        Add <strong>{{ $format($freeShippingThreshold - $subtotal) }}</strong> more for free delivery
                    </p>
                </div>
            @elseif($shipping === 0 || $freeShippingThreshold)
                <p class="gm-order-summary__shipping-notice gm-order-summary__shipping-notice--free">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    Free delivery on orders over {{ $format($freeShippingThreshold ?? $subtotal) }}
                </p>
            @endif
        @endif

        @if($discount > 0)
            <div class="gm-order-summary__row gm-order-summary__row--discount">
                <span class="gm-order-summary__label">Discount</span>
                <span class="gm-order-summary__value">-{{ $format($discount) }}</span>
            </div>
        @endif

        @if($tax > 0)
            <div class="gm-order-summary__row">
                <span class="gm-order-summary__label">Tax</span>
                <span class="gm-order-summary__value">{{ $format($tax) }}</span>
            </div>
        @endif
    </div>

    <div class="gm-order-summary__divider"></div>

    <div class="gm-order-summary__total">
        <span class="gm-order-summary__label">Total</span>
        <span class="gm-order-summary__value gm-order-summary__total-value">{{ $format($total) }}</span>
    </div>

    <div class="gm-order-summary__actions" style="margin-top: var(--s-4); display: flex; flex-direction: column; gap: var(--s-2);">
        <x-ui.button
            variant="primary"
            size="lg"
            full
            :href="$actionUrl"
            @if($onAction) wire:click="{{ $onAction }}" @endif
        >
            {{ $actionText }}
        </x-ui.button>

        @if($variant === 'cart')
            <x-ui.button
                variant="ghost"
                size="md"
                full
                href="{{ route('front.products.index') }}"
            >
                Continue Shopping
            </x-ui.button>
        @endif
    </div>
</div>