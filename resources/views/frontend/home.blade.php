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

<main class="main-wrapper gm-home" id="top">
    {{-- Hero --}}
    <section class="gm-section gm-section--home-hero" aria-labelledby="gm-hero-title">
        @if($sliders->count())
            <div id="gmHero" class="gm-hero carousel slide" data-bs-ride="carousel" data-bs-interval="6500" role="region" aria-label="Hero carousel">
                <div class="carousel-inner">
                    @foreach($sliders as $key => $s)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="gm-hero__media">
                                <img src="{{ getImage('sliders', $s->image) }}" alt="{{ $s->title ?: 'Gentry collection' }}">
                            </div>
                            <div class="gm-hero__overlay"></div>
                            <div class="gm-container gm-hero__content">
                                <span class="gm-hero__eyebrow">Autumn / Winter Collection</span>
                                <h1 id="gm-hero-title" class="gm-hero__title">{{ $s->title ?: 'The New Tailoring' }}</h1>
                                <p class="gm-hero__text">{{ $s->description ?: 'Considered layers, refined textures and a sharper silhouette — built for the everyday.' }}</p>
                                <div class="gm-hero__actions">
                                    <x-ui.button variant="primary" size="lg" class="gm-hero__btn" :href="$s->link ?: route('front.products.index')">Shop the collection</x-ui.button>
                                    <x-ui.button variant="ghost" size="lg" class="gm-hero__btn" href="{{ route('front.aboutUs') }}">Our story</x-ui.button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="gm-hero__control carousel-control-prev" type="button" data-bs-target="#gmHero" data-bs-slide="prev" aria-label="Previous slide">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>
                <button class="gm-hero__control carousel-control-next" type="button" data-bs-target="#gmHero" data-bs-slide="next" aria-label="Next slide">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
                @if($sliders->count() > 1)
                    <div class="gm-hero__indicators">
                        @foreach($sliders as $key => $s)
                            <button type="button" data-bs-target="#gmHero" data-bs-slide-to="{{ $key }}" class="gm-hero__indicator {{ $key == 0 ? 'active' : '' }}" aria-label="Slide {{ $key + 1 }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="gm-hero">
                <div class="gm-hero__media">
                    <img src="{{ asset('sliders/mens-hero-1.jpg') }}" alt="Gentry collection">
                </div>
                <div class="gm-hero__overlay"></div>
                <div class="gm-container gm-hero__content">
                    <span class="gm-hero__eyebrow">Autumn / Winter Collection</span>
                    <h1 id="gm-hero-title" class="gm-hero__title">The New Tailoring</h1>
                    <p class="gm-hero__text">Considered layers, refined textures and a sharper silhouette — built for the everyday.</p>
                    <div class="gm-hero__actions">
                        <x-ui.button variant="primary" size="lg" class="gm-hero__btn" href="{{ route('front.products.index') }}">Shop the collection</x-ui.button>
                        <x-ui.button variant="ghost" size="lg" class="gm-hero__btn" href="{{ route('front.aboutUs') }}">Our story</x-ui.button>
                    </div>
                </div>
            </div>
        @endif
    </section>

    {{-- Categories --}}
    @if($cats->count())
    <x-ui.section size="md" class="gm-categories">
        <x-ui.section-header
            title="Built for every day"
            subtitle="Shop by category"
            action="View all"
            :actionUrl="route('front.products.index')"
        />
        <div class="gm-categories__grid" role="list">
            @foreach($cats as $cat)
                <a href="{{ route('front.products.index') }}?category_id={{ $cat->id }}" class="gm-category-card" role="listitem">
                    <div class="gm-category-card__image-wrapper">
                        <img src="{{ getImage('categories', $cat->image) }}" alt="{{ $cat->name }}" loading="lazy" class="gm-category-card__image">
                    </div>
                    <div class="gm-category-card__content">
                        <h3 class="gm-category-card__name">{{ $cat->name }}</h3>
                        <p class="gm-category-card__meta">{{ $cat->products_count ?? 0 }} items</p>
                    </div>
                </a>
            @endforeach
        </div>
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
    <x-ui.section size="lg" class="gm-section--home-values gm-values">
        <div class="gm-container gm-values__grid">
            <article class="gm-value">
                <div class="gm-value__icon" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                </div>
                <h3 class="gm-value__title">Free delivery</h3>
                <p class="gm-value__text">On orders over {{ $information->currency_symbol ?? '৳' }}5,000</p>
            </article>
            <article class="gm-value">
                <div class="gm-value__icon" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                </div>
                <h3 class="gm-value__title">Easy returns</h3>
                <p class="gm-value__text">14 days, no questions</p>
            </article>
            <article class="gm-value">
                <div class="gm-value__icon" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="2"></rect><line x1="2" y1="12" x2="22" y2="12"></line></svg>
                </div>
                <h3 class="gm-value__title">Secure payment</h3>
                <p class="gm-value__text">Trusted & encrypted</p>
            </article>
            <article class="gm-value">
                <div class="gm-value__icon" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                </div>
                <h3 class="gm-value__title">Support</h3>
                <p class="gm-value__text">Mon–Fri, 9–6</p>
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