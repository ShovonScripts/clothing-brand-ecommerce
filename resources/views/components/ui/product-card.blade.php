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
    <div class="gm-product-card__image-wrapper">
        <a href="{{ $href }}" class="gm-product-card__link" aria-label="{{ $name }}">
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
        </a>

        {{-- Interactive controls sit outside the <a> so a click never navigates
             to the product page. They are still inside the positioned image
             wrapper, so the CSS overlay placement is unchanged. --}}
        @if($wishlistId !== null)
            <x-ui.wishlist-button
                :id="$wishlistId"
                :active="$inWishlist"
                class="gm-product-card__wishlist"
                data-tooltip="Add to wishlist"
            />
        @endif

        @if($quickView)
            <button type="button" class="gm-btn gm-btn--ghost gm-btn--sm gm-product-card__quick-view">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                Quick View
            </button>
        @endif
    </div>

    <a href="{{ $href }}" class="gm-product-card__link">
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

    {{-- Optional actions (e.g. a quick-add form). Kept outside the link so the
         HTML stays valid and the buttons don't navigate to the product page. --}}
    @isset($actions)
        <div class="gm-product-card__actions">
            {{ $actions }}
        </div>
    @endisset
</article>
