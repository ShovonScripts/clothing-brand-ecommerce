@extends('frontend.app')

@section('title', $product->name . ' — GENTRY')

@section('content')
@php
$info = \App\Models\Information::first();
$data = getProductInfo($product);
$currencySymbol = match($info->currency) {
    'BDT' => '৳',
    'Dollar' => '$',
    'Euro' => '€',
    'Rupee' => '₹',
    default => ''
};
$images = collect([$product->image])->merge($product->images->pluck('image')->toArray())->filter()->values();
$hasVariations = $product->type !== 'single' && $product->variations->count();
$variationOptions = $hasVariations ? $product->variations->mapWithKeys(function($v) {
    $sizeLabel = optional($v->size)->title;
    $colorLabel = optional($v->color)->name;
    return [$v->id => [
        'label' => $sizeLabel ?: $colorLabel ?: 'One size',
        'price' => $v->price,
        'stock' => $v->is_stock ?? $product->is_stock,
    ]];
}) : [];
$firstVariation = $hasVariations ? $product->variations->first() : null;
$selectedVariationId = $firstVariation?->id ?? ($product->variation->id ?? '');
$maxStock = $hasVariations ? ($firstVariation?->is_stock ?? $product->is_stock) : $product->is_stock;
@endphp

<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Shop', 'url' => route('front.products.index')],
            ['label' => $product->name],
        ]"
    />

    <x-ui.section size="md">
        <div class="gm-pdp-layout" style="display: grid; grid-template-columns: 1fr 480px; gap: var(--s-8); align-items: start;">

            {{-- Gallery --}}
            <div class="gm-pdp-gallery" style="position: sticky; top: calc(var(--header-h) + var(--s-4));">
                <x-ui.gallery :images="$images->toArray()" />
            </div>

            {{-- Product Info --}}
            <div class="gm-pdp-info" style="padding-inline-start: var(--s-6);">
                <div class="gm-pdp-meta" style="display: flex; flex-wrap: wrap; gap: var(--s-2); margin-bottom: var(--s-2); font-size: var(--t-sm);">
                    @if($product->category)
                        <span class="gm-pdp-category" style="color: var(--c-accent); font-weight: 500; text-transform: uppercase; letter-spacing: var(--ls-wide);">{{ $product->category->name }}</span>
                    @endif
                    @if($product->brand)
                        <span class="gm-pdp-brand" style="color: var(--c-ink-500);">{{ $product->brand->name }}</span>
                    @endif
                </div>

                <h1 class="gm-pdp-title" style="font-size: clamp(var(--t-xl), 4vw, var(--t-2xl)); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-3); line-height: var(--lh-tight);">{{ $product->name }}</h1>

                <x-ui.price
                    :current="$data['price']"
                    :original="$data['discount_amount'] > 0 ? $data['old_price'] : null"
                    context="pdp"
                    currency="$info->currency"
                    class="gm-pdp-price"
                />

                @if($product->feature)
                    <ul class="gm-pdp-features" style="list-style: none; padding: 0; margin: var(--s-4) 0; display: flex; flex-wrap: wrap; gap: var(--s-3) var(--s-5);">
                        @foreach(explode('<li>', strip_tags($product->feature, '<li>')) as $feature)
                            @if(trim($feature))
                                <li style="position: relative; padding-inline-start: var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); line-height: var(--lh-base);">
                                    <span style="position: absolute; inset-inline-start: 0; top: 0.6em; width: 6px; height: 6px; border-radius: 50%; background: var(--c-accent);"></span>
                                    {{ trim($feature) }}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ route('front.carts.storeCart') }}" class="gm-pdp-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="price" :value="$data['price']">
                    <input type="hidden" name="is_stock" value="{{ $maxStock }}">
                    <input type="hidden" name="quantity" value="1">

                    @if($hasVariations)
                        <div class="gm-pdp-variations" style="margin-bottom: var(--s-4);">
                            @foreach($variationOptions as $variationId => $variation)
                                @php
                                    $isSelected = $variationId == $selectedVariationId;
                                @endphp
                                <input type="radio"
                                    name="variation_id"
                                    value="{{ $variationId }}"
                                    id="variation_{{ $variationId }}"
                                    class="gm-variant-swatch__input"
                                    @if($isSelected) checked @endif
                                    @if($variation['stock'] <= 0) disabled @endif
                                >
                            @endforeach

                            <div class="gm-variant-swatch-group" style="margin-top: var(--s-3);" role="radiogroup" aria-label="Size options">
                                @foreach($variationOptions as $variationId => $variation)
                                    <x-ui.variant-swatch
                                        :value="$variationId"
                                        :label="$variation['label']"
                                        :selected="$variationId == $selectedVariationId"
                                        :disabled="$variation['stock'] <= 0"
                                        size="md"
                                    />
                                @endforeach
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="variation_id" value="{{ $selectedVariationId }}">
                    @endif

                    <div class="gm-pdp-quantity" style="display: flex; align-items: center; gap: var(--s-4); margin-bottom: var(--s-4);">
                        <label for="pdp-qty" class="gm-qty-label" style="font-size: var(--t-xs); font-weight: 500; letter-spacing: var(--ls-wide); text-transform: uppercase; color: var(--c-ink-900); white-space: nowrap;">Quantity</label>
                        <x-ui.quantity-stepper
                            name="quantity"
                            :value="$quantity ?? 1"
                            :min="1"
                            :max="$maxStock"
                            :stock="$maxStock"
                            size="md"
                            inline
                        />
                    </div>

                    <div class="gm-pdp-actions" style="display: flex; flex-direction: column; gap: var(--s-3);">
                        <x-ui.button
                            variant="primary"
                            size="lg"
                            full
                            type="submit"
                            :disabled="$maxStock <= 0"
                        >
                            @if($maxStock <= 0)
                                Out of Stock
                            @else
                                Add to Bag
                            @endif
                        </x-ui.button>

                        @auth
                            <x-ui.button
                                variant="ghost"
                                size="md"
                                full
                                :active="$product->in_wishlist ?? false"
                            >
                                Save for later
                            </x-ui.button>
                        @else
                            <a href="{{ route('login') }}" class="gm-btn gm-btn--ghost gm-btn--md gm-btn--full" style="text-align: center;">Sign in to save</a>
                        @endauth
                    </div>
                </form>

                {{-- Delivery Info --}}
                <div class="gm-pdp-delivery" style="display: flex; flex-wrap: wrap; gap: var(--s-3) var(--s-5); padding-top: var(--s-4); border-top: 1px solid var(--c-line); margin-top: var(--s-4);">
                    <div class="gm-pdp-delivery-item" style="display: inline-flex; align-items: center; gap: var(--s-2); font-size: var(--t-sm); color: var(--c-ink-700);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <span>Free delivery over {{ $currencySymbol }} 5,000</span>
                    </div>
                    <div class="gm-pdp-delivery-item" style="display: inline-flex; align-items: center; gap: var(--s-2); font-size: var(--t-sm); color: var(--c-ink-700);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                        <span>14-day easy returns</span>
                    </div>
                    <div class="gm-pdp-delivery-item" style="display: inline-flex; align-items: center; gap: var(--s-2); font-size: var(--t-sm); color: var(--c-ink-700);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><rect x="2" y="2" width="20" height="20" rx="2"></rect><line x1="2" y1="12" x2="22" y2="12"></line></svg>
                        <span>Secure payment</span>
                    </div>
                </div>
            </div>
        </div>
    </x-ui.section>

    {{-- Description Tabs --}}
    <x-ui.section size="md" background="bg">
        @php
            $reviewCount = $product->reviews->count();
            $tabLabels = ['Description'];
            if ($product->video_link) $tabLabels[] = 'Video';
            if ($reviewCount) $tabLabels[] = "Reviews ({$reviewCount})";
        @endphp
        <x-ui.tabs variant="underline" :labels="$tabLabels">
                <div class="gm-tabs__panel" data-gm-tab-panel>
                    <div class="gm-prose" style="font-family: var(--f-body); font-size: var(--t-md); line-height: var(--lh-loose); color: var(--c-ink-700);">
                        {!! $product->body !!}
                    </div>
                </div>

                @if($product->video_link)
                    <div class="gm-tabs__panel" data-gm-tab-panel>
                        <div class="gm-video-wrapper" style="position: relative; width: 100%; padding-top: 56.25%; border-radius: var(--r-md); overflow: hidden;">
                            {!! $product->video_link !!}
                        </div>
                    </div>
                @endif

                @if($reviewCount)
                    <div class="gm-tabs__panel" data-gm-tab-panel>
                      <div class="gm-reviews" style="display: flex; flex-direction: column; gap: var(--s-5);">
                        @foreach($product->reviews as $review)
                            <article class="gm-review" style="padding: var(--s-4); background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-md);">
                                <div class="gm-review-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--s-2);">
                                    <div>
                                        <strong style="font-family: var(--f-display); color: var(--c-ink-900);">{{ full_name($review->user) ?: 'Customer' }}</strong>
                                        <time style="font-size: var(--t-sm); color: var(--c-ink-500); margin-inline-start: var(--s-3);">{{ $review->created_at->format('F j, Y') }}</time>
                                    </div>
                                    <x-ui.rating :value="$review->rating" :max="5" readonly size="sm" />
                                </div>
                                <p style="margin: 0; color: var(--c-ink-700);">{{ $review->comment }}</p>
                            </article>
                        @endforeach
                      </div>
                    </div>
                @endif
        </x-ui.tabs>
    </x-ui.section>

    {{-- Related Products --}}
    <x-ui.section size="md">
        <x-ui.section-header
            title="You Might Also Like"
            action="View All"
            :actionUrl="route('front.products.index')"
        />
        <x-ui.product-grid id="gm-relative-products" style="opacity: 0; transition: opacity 0.3s ease;">
            {{-- Loaded via AJAX --}}
        </x-ui.product-grid>
    </x-ui.section>
</main>

{{-- Mobile Sticky Bar --}}
<div class="gm-sticky-bar" id="gm-sticky-bar" style="position: fixed; bottom: 0; left: 0; right: 0; z-index: 100; transform: translateY(100%); transition: transform var(--d-base) var(--e-out); background: var(--c-bg); box-shadow: 0 -4px 24px rgba(16,16,16,0.08); border-top: 1px solid var(--c-line);">
    <div class="gm-sticky-bar-inner" style="display: grid; grid-template-columns: 1fr 1.5fr 1.5fr; align-items: stretch; max-width: 1280px; margin: 0 auto;">
        <button type="button" class="gm-sticky-btn gm-sticky-btn--store" data-gm-drawer-open="cart-drawer" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 2px; padding: var(--s-3) var(--s-2); background: transparent; border: none; color: var(--c-ink-500); font-size: var(--t-xs); font-weight: 500; letter-spacing: var(--ls-wide); text-transform: uppercase; cursor: pointer;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
            <span>Bag</span>
            <span class="gm-sticky-count" id="gm-sticky-count" style="position: absolute; top: 2px; right: 2px; min-width: 16px; height: 16px; padding: 0 4px; background: var(--c-accent); color: var(--c-accent-ink); font-size: 10px; font-weight: 600; line-height: 16px; text-align: center; border-radius: 8px;">{{ getTotalCart() }}</span>
        </button>

        <form method="POST" action="{{ route('front.carts.storeCart') }}" class="gm-sticky-form">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="price" :value="$data['price']">
            <input type="hidden" name="is_stock" value="{{ $maxStock }}">
            <input type="hidden" name="quantity" value="1">
            @if($hasVariations)
                <input type="hidden" name="variation_id" class="gm-sticky-variation" value="{{ $selectedVariationId }}">
            @else
                <input type="hidden" name="variation_id" value="{{ $selectedVariationId }}">
            @endif
            <button type="submit" class="gm-sticky-btn gm-sticky-btn--buy" style="background: var(--c-accent); color: var(--c-accent-ink); font-family: var(--f-body); font-size: var(--t-sm); font-weight: 500; letter-spacing: var(--ls-wide); text-transform: uppercase; padding: var(--s-3); border: none; cursor: pointer; width: 100%; height: 100%;">Buy Now</button>
        </form>

        <form method="POST" action="{{ route('front.carts.storeCart') }}" class="gm-sticky-form">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="price" :value="$data['price']">
            <input type="hidden" name="is_stock" value="{{ $maxStock }}">
            <input type="hidden" name="quantity" value="1">
            @if($hasVariations)
                <input type="hidden" name="variation_id" class="gm-sticky-variation" value="{{ $selectedVariationId }}">
            @else
                <input type="hidden" name="variation_id" value="{{ $selectedVariationId }}">
            @endif
            <button type="submit" class="gm-sticky-btn gm-sticky-btn--add" style="background: var(--c-ink-900); color: var(--c-bg); font-family: var(--f-body); font-size: var(--t-sm); font-weight: 500; letter-spacing: var(--ls-wide); text-transform: uppercase; padding: var(--s-3); border: none; cursor: pointer; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; gap: var(--s-2);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Add
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    (function() {
        // Sticky bar scroll visibility
        const stickyBar = document.getElementById('gm-sticky-bar');
        if (stickyBar) {
            let ticking = false;
            window.addEventListener('scroll', () => {
                if (!ticking) {
                    requestAnimationFrame(() => {
                        const scrollTop = window.pageYOffset;
                        stickyBar.classList.toggle('is-visible', scrollTop > 260);
                        ticking = false;
                    });
                    ticking = true;
                }
            }, { passive: true });
        }

        // Variant change handler
        document.addEventListener('variant-change', function(e) {
            const { id, price, stock } = e.detail;
            const priceEls = document.querySelectorAll('[data-gm-price]');
            priceEls.forEach(el => {
                el.textContent = '{{ $currencySymbol }} ' + price.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            });
            document.querySelectorAll('input[name="price"]').forEach(input => input.value = price);
            document.querySelectorAll('input[name="is_stock"]').forEach(input => input.value = stock);

            const qtyInputs = document.querySelectorAll('input[name="quantity"]');
            qtyInputs.forEach(input => {
                input.max = stock;
            });
        });

        // Tab change handler
        document.addEventListener('tab-change', function(e) {
            console.log('Tab changed to:', e.detail.index);
        });

        // Load related products
        function loadRelated() {
            fetch('{{ route("front.products.relativeProduct", [$product->id]) }}')
                .then(res => res.json())
                .then(res => {
                    if (res.success && res.html) {
                        const container = document.getElementById('gm-relative-products');
                        if (container) {
                            container.innerHTML = res.html;
                            container.style.opacity = '1';
                        }
                    }
                })
                .catch(err => console.error('Failed to load related products:', err));
        }

        if (document.getElementById('gm-relative-products')) {
            loadRelated();
        }

        // Cart drawer sync
        window.addEventListener('cart-updated', function(e) {
            const countEl = document.getElementById('gm-sticky-count');
            if (countEl && e.detail.count !== undefined) {
                countEl.textContent = e.detail.count;
            }
        });
    })();
</script>
@endpush