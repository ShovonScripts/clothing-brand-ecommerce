@extends('frontend.app')

@section('title', 'GENTRY — Modern Menswear')

@section('content')
@php
$information = \App\Models\Information::first();
$sliders = $sliders ?? collect();
$cats = $cats ?? collect();
$newArrivals = $newArrivals ?? collect();
$saleProducts = $saleProducts ?? collect();
$recommended = $recommended ?? collect();
@endphp

<main class="main-wrapper" id="top">
    {{-- Hero --}}
    <section class="gm-section gm-section--xl" style="padding-top: 0; padding-bottom: 0;" aria-labelledby="gm-hero-title">
        @if($sliders->count())
            <div id="gmHero" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6500" role="region" aria-label="Hero carousel">
                <div class="carousel-inner">
                    @foreach($sliders as $key => $s)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="gm-hero-media" style="position: relative; width: 100%; aspect-ratio: 16/9; overflow: hidden;">
                                <img src="{{ getImage('sliders', $s->image) }}" alt="{{ $s->title ?: 'Gentry collection' }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="gm-container" style="position: absolute; inset: 0; display: flex; align-items: center; z-index: 1;">
                                <div class="gm-hero-content" style="max-width: 720px; color: var(--c-bg); text-shadow: 0 2px 16px rgba(0,0,0,0.3);">
                                    <span class="gm-hero-eyebrow" style="display: block; font-size: var(--t-sm); font-weight: 500; text-transform: uppercase; letter-spacing: var(--ls-wide); margin-bottom: var(--s-3); opacity: 0.9;">Autumn / Winter Collection</span>
                                    <h1 id="gm-hero-title" class="gm-hero-title" style="font-size: clamp(var(--t-2xl), 6vw, var(--t-3xl)); font-weight: 500; line-height: var(--lh-tight); margin: 0 0 var(--s-3);">{{ $s->title ?: 'The New Tailoring' }}</h1>
                                    <p class="gm-hero-text" style="font-size: var(--t-lg); opacity: 0.9; margin: 0 0 var(--s-5); max-width: 480px;">{{ $s->description ?: 'Considered layers, refined textures and a sharper silhouette — built for the everyday.' }}</p>
                                    <div class="gm-hero-actions" style="display: flex; gap: var(--s-3); flex-wrap: wrap;">
                                        <x-ui.button variant="primary" size="lg" :href="$s->link ?: route('front.products.index')">Shop the collection</x-ui.button>
                                        <x-ui.button variant="ghost" size="lg" href="{{ route('front.aboutUs') }}">Our story</x-ui.button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#gmHero" data-bs-slide="prev" aria-label="Previous slide">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#gmHero" data-bs-slide="next" aria-label="Next slide">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
                @if($sliders->count() > 1)
                    <div class="gm-hero-indicators" style="position: absolute; bottom: var(--s-5); left: 50%; transform: translateX(-50%); display: flex; gap: var(--s-2); z-index: 2;">
                        @foreach($sliders as $key => $s)
                            <button type="button" data-bs-target="#gmHero" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" aria-label="Slide {{ $key + 1 }}" style="width: 10px; height: 10px; border-radius: 50%; border: none; background: rgba(255,255,255,0.5); cursor: pointer; transition: background 0.2s;"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="gm-hero-media" style="position: relative; width: 100%; aspect-ratio: 16/9; overflow: hidden; background: var(--c-bg-2);">
                <img src="{{ asset('sliders/mens-hero-1.jpg') }}" alt="Gentry collection" style="width: 100%; height: 100%; object-fit: cover;">
                <div class="gm-container" style="position: absolute; inset: 0; display: flex; align-items: center; z-index: 1;">
                    <div class="gm-hero-content" style="max-width: 720px; color: var(--c-bg); text-shadow: 0 2px 16px rgba(0,0,0,0.3);">
                        <span class="gm-hero-eyebrow" style="display: block; font-size: var(--t-sm); font-weight: 500; text-transform: uppercase; letter-spacing: var(--ls-wide); margin-bottom: var(--s-3); opacity: 0.9;">Autumn / Winter Collection</span>
                        <h1 id="gm-hero-title" class="gm-hero-title" style="font-size: clamp(var(--t-2xl), 6vw, var(--t-3xl)); font-weight: 500; line-height: var(--lh-tight); margin: 0 0 var(--s-3);">The New Tailoring</h1>
                        <p class="gm-hero-text" style="font-size: var(--t-lg); opacity: 0.9; margin: 0 0 var(--s-5); max-width: 480px;">Considered layers, refined textures and a sharper silhouette — built for the everyday.</p>
                        <div class="gm-hero-actions" style="display: flex; gap: var(--s-3); flex-wrap: wrap;">
                            <x-ui.button variant="primary" size="lg" href="{{ route('front.products.index') }}">Shop the collection</x-ui.button>
                            <x-ui.button variant="ghost" size="lg" href="{{ route('front.aboutUs') }}">Our story</x-ui.button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>

    {{-- Categories --}}
    @if($cats->count())
    <x-ui.section size="md">
        <x-ui.section-header
            title="Built for every day"
            subtitle="Shop by category"
            action="View all"
            :actionUrl="route('front.products.index')"
        />
        <x-ui.grid :columns="4" :gap="4" :autoFit="true" :minWidth="220">
            @foreach($cats as $cat)
                <a href="{{ route('front.products.index') }}?category_id={{ $cat->id }}" class="gm-product-card gm-product-card--horizontal" style="text-decoration: none; color: inherit;">
                    <div class="gm-product-card__image-wrapper" style="width: 100%; aspect-ratio: 16/10; background: var(--c-bg-2); overflow: hidden;">
                        <img src="{{ getImage('categories', $cat->image) }}" alt="{{ $cat->name }}" loading="lazy" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                    </div>
                    <div class="gm-product-card__content" style="padding: var(--s-4); display: flex; flex-direction: column; justify-content: center;">
                        <h3 class="gm-product-card__name" style="margin: 0; font-size: var(--t-lg);">{{ $cat->name }}</h3>
                        <p class="gm-product-card__meta" style="margin: var(--s-2) 0 0; font-size: var(--t-sm); color: var(--c-ink-500);">{{ $cat->products_count ?? 0 }} items</p>
                    </div>
                </a>
            @endforeach
        </x-ui.grid>
    </x-ui.section>
    @endif

    {{-- New Arrivals --}}
    @if($newArrivals->count())
    <x-ui.section size="md" background="bg">
        <x-ui.section-header
            title="Fresh arrivals"
            subtitle="New in"
            action="View all"
            :actionUrl="route('front.products.index') . '?shorting=desc'"
        />
        <x-ui.product-grid>
            @foreach($newArrivals as $product)
                <x-ui.product-card
                    :product="$product"
                    :image="getImage('products', $product->image)"
                    :name="$product->name"
                    :price="getProductInfo($product)['price']"
                    :originalPrice="getProductInfo($product)['discount_amount'] > 0 ? getProductInfo($product)['old_price'] : null"
                    :category="optional($product->category)->name"
                    :href="route('front.products.show', [$product->id])"
                    :wishlistId="'wishlist_' . $product->id"
                />
            @endforeach
        </x-ui.product-grid>
    </x-ui.section>
    @endif

    {{-- Sale --}}
    @if($saleProducts->count())
    <x-ui.section size="md">
        <x-ui.section-header
            title="Seasonal offers"
            subtitle="Sale"
            action="View all"
            :actionUrl="route('front.discountProduct')"
        />
        <x-ui.product-grid>
            @foreach($saleProducts as $product)
                <x-ui.product-card
                    :product="$product"
                    :image="getImage('products', $product->image)"
                    :name="$product->name"
                    :price="getProductInfo($product)['price']"
                    :originalPrice="getProductInfo($product)['old_price']"
                    :category="optional($product->category)->name"
                    :badges="[['variant' => 'sale', 'label' => 'Sale']]"
                    :href="route('front.products.show', [$product->id])"
                    :wishlistId="'wishlist_' . $product->id"
                />
            @endforeach
        </x-ui.product-grid>
    </x-ui.section>
    @endif

    {{-- Recommended --}}
    @if($recommended->count())
    <x-ui.section size="md" background="bg">
        <x-ui.section-header
            title="Recommended for you"
            subtitle="Editor's pick"
            action="View all"
            :actionUrl="route('front.products.index')"
        />
        <x-ui.product-grid>
            @foreach($recommended as $product)
                <x-ui.product-card
                    :product="$product"
                    :image="getImage('products', $product->image)"
                    :name="$product->name"
                    :price="getProductInfo($product)['price']"
                    :originalPrice="getProductInfo($product)['discount_amount'] > 0 ? getProductInfo($product)['old_price'] : null"
                    :category="optional($product->category)->name"
                    :href="route('front.products.show', [$product->id])"
                    :wishlistId="'wishlist_' . $product->id"
                />
            @endforeach
        </x-ui.product-grid>
    </x-ui.section>
    @endif

    {{-- Values / Promise --}}
    <x-ui.section size="lg" background="ink">
        <div class="gm-values-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: var(--s-6); text-align: center; color: var(--c-bg);">
            <article class="gm-value">
                <div class="gm-value-icon" style="width: 56px; height: 56px; margin: 0 auto var(--s-4); border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: var(--c-accent);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                </div>
                <h3 class="gm-value-title" style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); margin: 0 0 var(--s-2);">Free delivery</h3>
                <p class="gm-value-text" style="color: rgba(255,255,255,0.7); margin: 0;">On orders over {{ $information->currency_symbol ?? '৳' }}5,000</p>
            </article>
            <article class="gm-value">
                <div class="gm-value-icon" style="width: 56px; height: 56px; margin: 0 auto var(--s-4); border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: var(--c-accent);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                </div>
                <h3 class="gm-value-title" style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); margin: 0 0 var(--s-2);">Easy returns</h3>
                <p class="gm-value-text" style="color: rgba(255,255,255,0.7); margin: 0;">14 days, no questions</p>
            </article>
            <article class="gm-value">
                <div class="gm-value-icon" style="width: 56px; height: 56px; margin: 0 auto var(--s-4); border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: var(--c-accent);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="2"></rect><line x1="2" y1="12" x2="22" y2="12"></line></svg>
                </div>
                <h3 class="gm-value-title" style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); margin: 0 0 var(--s-2);">Secure payment</h3>
                <p class="gm-value-text" style="color: rgba(255,255,255,0.7); margin: 0;">Trusted & encrypted</p>
            </article>
            <article class="gm-value">
                <div class="gm-value-icon" style="width: 56px; height: 56px; margin: 0 auto var(--s-4); border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: var(--c-accent);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                </div>
                <h3 class="gm-value-title" style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); margin: 0 0 var(--s-2);">Support</h3>
                <p class="gm-value-text" style="color: rgba(255,255,255,0.7); margin: 0;">Mon–Fri, 9–6</p>
            </article>
        </div>
    </x-ui.section>
</main>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var hero = document.getElementById('gmHero');
        if (hero && window.bootstrap && bootstrap.Carousel) {
            new bootstrap.Carousel(hero, { interval: 6500, ride: 'carousel', touch: true });
        }
    });
</script>
@endpush