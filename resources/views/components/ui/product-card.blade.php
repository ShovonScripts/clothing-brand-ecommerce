@props([
    'product' => null,
    'image' => null,
    'name' => null,
    'price' => null,
    'originalPrice' => null,
    'category' => null,
    'rating' => null,
    'reviewCount' => 0,
    'badges' => [],
    'href' => '#',
    'wishlistId' => null,
    'inWishlist' => false,
    'quickView' => false,
    'horizontal' => false,
    'stock' => 'in-stock',
])

<?php
$classes = ['gm-product-card'];
if ($horizontal) $classes[] = 'gm-product-card--horizontal';
$class = implode(' ', $classes);
?>

<article {{ $attributes->merge(['class' => $class]) }}>
    <a href="{{ $href }}" class="gm-product-card__link" aria-label="{{ $name }}">
        <div class="gm-product-card__image-wrapper">
            @if($image)
                <img src="{{ $image }}" alt="" class="gm-product-card__image" loading="lazy" width="400" height="400">
            @else
                <div class="gm-skeleton gm-skeleton--box" aria-hidden="true"></div>
            @endif

            @if($badges)
                <div class="gm-product-card__badges" aria-label="Product badges">
                    @foreach($badges as $badge)
                        <x-ui.badge :variant="$badge['variant'] ?? 'neutral'" size="sm">{{ $badge['label'] }}</x-ui.badge>
                    @endforeach
                </div>
            @endif

            @if($wishlistId !== null)
                <x-ui.wishlist-button
                    :id="$wishlistId"
                    :active="$inWishlist"
                    class="gm-product-card__wishlist"
                    data-tooltip="Add to wishlist"
                >
                    <svg class="gm-wishlist-button__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                </x-ui.wishlist-button>
            @endif

            @if($quickView)
                <button type="button" class="gm-btn gm-btn--ghost gm-btn--sm gm-product-card__quick-view">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    Quick View
                </button>
            @endif
        </div>

        <div class="gm-product-card__content">
            @if($category)
                <div class="gm-product-card__meta">
                    <span class="gm-product-card__category">{{ $category }}</span>
                </div>
            @endif

            <h3 class="gm-product-card__name">{{ $name }}</h3>

            @if($rating !== null)
                <x-ui.rating :value="$rating" :count="$reviewCount" readonly size="sm" class="gm-product-card__rating" />
            @endif

            <div class="gm-product-card__price-wrapper">
                <x-ui.price
                    :current="$price"
                    :original="$originalPrice"
                    class="gm-product-card__price"
                />
            </div>
        </div>
    </a>

    @if($attributes->has('actions'))
        <div class="gm-product-card__actions">
            {{ $attributes->get('actions') }}
        </div>
    @endif
</article>