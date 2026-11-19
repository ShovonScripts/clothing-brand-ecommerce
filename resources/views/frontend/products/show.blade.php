@extends('frontend.app')

@section('content')
@php
    use App\Models\Information;
    $info = Information::first();
    $data = getProductInfo($product);
    $currencySymbol = match($info->currency) {
        'BDT' => '৳',
        'Dollar' => '$',
        'Euro' => '€',
        'Rupee' => '₹',
        default => ''
    };
@endphp

<main class="main-wrapper">
    <div class="axil-single-product-area axil-section-gap bg-color-white">
        <div class="container-fluid">
            <div class="row">
                <!-- Product Gallery -->
                <div class="col-lg-6 mb--30 mb-lg-0">
                    <div class="product-gallery gm-product-gallery">
                        <div class="gallery-main">
                            <a href="{{ getImage('products', $product->image) }}" class="gallery-main-link gm-zoom" data-fancybox="product-gallery">
                                <img src="{{ getImage('products', $product->image) }}" alt="{{ $product->name }}" class="gallery-main-img">
                            </a>
                            @if($product->discount_type)
                                <div class="gm-badge gm-badge--sale">{{ $product->discount }}% OFF</div>
                            @endif
                        </div>

                        @if($product->images->count() > 0)
                            <div class="gallery-thumbs gm-thumbs">
                                <button class="gm-thumb active" data-index="0" aria-label="View main image">
                                    <img src="{{ getImage('products', $product->image) }}" alt="{{ $product->name }}">
                                </button>
                                @foreach($product->images as $index => $im)
                                    <button class="gm-thumb" data-index="{{ $index + 1 }}" aria-label="View image {{ $index + 2 }}">
                                        <img src="{{ getImage('products', $im->image) }}" alt="{{ $product->name }} - {{ $index + 2 }}">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-info gm-product-info">
                        <div class="product-meta">
                            @if($product->category)
                                <span class="gm-category">{{ $product->category->name }}</span>
                            @endif
                            @if($product->brand)
                                <span class="gm-brand">{{ $product->brand->name }}</span>
                            @endif
                        </div>

                        <h1 class="gm-product-title">{{ $product->name }}</h1>

                        <div class="gm-price-wrapper">
                            <span class="gm-price gm-price--current" id="gm-price-current">
                                {{ $currencySymbol }} {{ number_format($data['price'], 2) }}
                            </span>
                            @if($data['discount_amount'] > 0 && $data['old_price'] > 0)
                                <span class="gm-price gm-price--old" id="gm-price-old">
                                    {{ $currencySymbol }} {{ number_format($data['old_price'], 2) }}
                                </span>
                                <span class="gm-badge gm-badge--sale-inline">{{ $product->discount }}% OFF</span>
                            @endif
                        </div>

                        @if($product->feature)
                            <ul class="gm-features">
                                {!! $product->feature !!}
                            </ul>
                        @endif

                        <!-- Add to Cart Form -->
                        <form method="POST" action="{{ route('front.carts.storeCart') }}" class="gm-cart-form js-cart-form" id="gm-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="price" id="gm-price-val" value="{{ $data['price'] }}">
                            <input type="hidden" name="is_stock" value="{{ $product->is_stock }}">
                            <input type="hidden" name="quantity" value="1" class="gm-qty-input">

                            @if($product->type !== 'single')
                                <div class="gm-variations">
                                    @foreach($product->variations as $v)
                                        @php
                                            $sizeLabel = optional($v->size)->title;
                                            $colorLabel = optional($v->color)->name;
                                            $label = $sizeLabel ?: $colorLabel ?: 'One size';
                                        @endphp
                                        <input type="hidden" class="gm-variation-option" data-id="{{ $v->id }}" data-label="{{ $label }}" data-price="{{ $v->price }}">
                                    @endforeach

                                    <fieldset class="gm-variation-group">
                                        <legend class="gm-variation-label">Select Size</legend>
                                        <div class="gm-size-options" role="radiogroup" aria-label="Size options">
                                            @foreach($product->variations as $index => $v)
                                                @php
                                                    $sizeLabel = optional($v->size)->title;
                                                    $colorLabel = optional($v->color)->name;
                                                    $label = $sizeLabel ?: $colorLabel ?: 'One size';
                                                @endphp
                                                <button type="button"
                                                    class="gm-size-btn {{ $index === 0 ? 'active' : '' }}"
                                                    data-value="{{ $v->id }}"
                                                    data-price="{{ $v->price }}"
                                                    aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"
                                                    {{ $index === 0 ? 'autofocus' : '' }}>
                                                    {{ $label }}
                                                </button>
                                            @endforeach
                                        </div>
                                        <input type="hidden" name="variation_id" id="gm-variation-id" value="{{ $product->variations->first()->id ?? '' }}">
                                    </fieldset>
                                </div>
                            @else
                                <input type="hidden" name="variation_id" value="{{ $product->variation->id ?? '' }}">
                            @endif

                            <div class="gm-quantity-wrapper">
                                <label for="gm-qty" class="gm-qty-label">Quantity</label>
                                <div class="gm-qty-selector">
                                    <button type="button" class="gm-qty-btn gm-qty-btn--decrease" aria-label="Decrease quantity">−</button>
                                    <input type="number" id="gm-qty" name="quantity" value="1" min="1" max="{{ $product->is_stock }}" class="gm-qty-input" aria-label="Quantity">
                                    <button type="button" class="gm-qty-btn gm-qty-btn--increase" aria-label="Increase quantity">+</button>
                                </div>
                            </div>

                            <div class="gm-actions">
                                <button type="submit" class="gm-btn gm-btn--primary gm-btn--lg gm-btn--block">
                                    <i class="fas fa-shopping-bag" aria-hidden="true"></i> Add to Bag
                                </button>
                            </div>
                        </form>

                        <!-- Contact Phones -->
                        @if($info->number_visibility > 0)
                            <div class="gm-contact-phones">
                                @for($i = 1; $i <= $info->number_visibility; $i++)
                                    @php $num = $info->{"supp_num{$i}"}; @endphp
                                    @if($num)
                                        <a href="tel:{{ $num }}" class="gm-phone-link">
                                            <i class="fas fa-phone-alt" aria-hidden="true"></i>
                                            <span>{{ $num }}</span>
                                        </a>
                                    @endif
                                @endfor
                            </div>
                        @endif

                        <div class="gm-delivery-info">
                            <div class="gm-delivery-item">
                                <i class="fas fa-truck" aria-hidden="true"></i>
                                <span>Free delivery over {{ $currencySymbol }} 5,000</span>
                            </div>
                            <div class="gm-delivery-item">
                                <i class="fas fa-undo" aria-hidden="true"></i>
                                <span>14-day easy returns</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description Tabs -->
        <div class="gm-tabs gm-tabs--product" role="tablist">
            <button class="gm-tab-btn active" role="tab" aria-selected="true" aria-controls="tab-description" id="tab-btn-description">
                Description
            </button>
            @if($product->video_link)
                <button class="gm-tab-btn" role="tab" aria-selected="false" aria-controls="tab-video" id="tab-btn-video">
                    Video
                </button>
            @endif
        </div>

        <div class="gm-tab-panels">
            <div class="gm-tab-panel active" role="tabpanel" id="tab-description" aria-labelledby="tab-btn-description">
                <div class="gm-prose">
                    @if($product->video_link)
                        <div class="gm-video-wrapper">
                            {!! $product->video_link !!}
                        </div>
                    @endif
                    {!! $product->body !!}
                </div>
            </div>

            @if($product->video_link)
                <div class="gm-tab-panel" role="tabpanel" id="tab-video" aria-labelledby="tab-btn-video">
                    <div class="gm-video-wrapper">
                        {!! $product->video_link !!}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Related Products -->
    <div class="axil-product-area bg-color-white axil-section-gap">
        <div class="container-fluid">
            <div class="gm-section-header">
                <h2 class="gm-section-title">You Might Also Like</h2>
                <a href="{{ route('front.products.index') }}" class="gm-link gm-link--view-all">View All <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
            </div>
            <div class="gm-product-grid" id="gm-relative-products">
                <!-- Loaded via AJAX -->
            </div>
        </div>
    </div>
</main>

<!-- Mobile Sticky Bar -->
<div class="gm-sticky-bar" id="gm-sticky-bar" role="region" aria-label="Quick actions">
    <div class="gm-sticky-bar-inner">
        <button type="button" class="gm-sticky-btn gm-sticky-btn--store" data-gm-drawer-open data-gm-drawer-target="#gm-cart-drawer">
            <i class="fas fa-shopping-bag" aria-hidden="true"></i>
            <span>Bag</span>
            <span class="gm-sticky-count" id="gm-sticky-count">0</span>
        </button>

        <form method="POST" action="{{ route('front.carts.store') }}" class="gm-sticky-form js-cart-form">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="price" value="{{ $data['price'] }}">
            <input type="hidden" name="is_stock" value="{{ $product->is_stock }}">
            <input type="hidden" name="quantity" value="1">
            @if($product->type !== 'single')
                <input type="hidden" name="variation_id" class="gm-sticky-variation" value="{{ $product->variations->first()->id ?? '' }}">
            @else
                <input type="hidden" name="variation_id" value="{{ $product->variation->id ?? '' }}">
            @endif
            <button type="submit" class="gm-sticky-btn gm-sticky-btn--buy">
                Buy Now
            </button>
        </form>

        <form method="POST" action="{{ route('front.carts.storeCart') }}" class="gm-sticky-form js-cart-form">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="price" value="{{ $data['price'] }}">
            <input type="hidden" name="is_stock" value="{{ $product->is_stock }}">
            <input type="hidden" name="quantity" value="1">
            @if($product->type !== 'single')
                <input type="hidden" name="variation_id" class="gm-sticky-variation" value="{{ $product->variations->first()->id ?? '' }}">
            @else
                <input type="hidden" name="variation_id" value="{{ $product->variation->id ?? '' }}">
            @endif
            <button type="submit" class="gm-sticky-btn gm-sticky-btn--add">
                <i class="fas fa-plus" aria-hidden="true"></i> Add
            </button>
        </form>
    </div>
</div>
@endsection

@push('css')
<style>
/* Product Gallery */
.gm-product-gallery {
    position: relative;
}
.gallery-main {
    position: relative;
    border-radius: 4px;
    overflow: hidden;
    background: var(--gm-bone);
    aspect-ratio: 3/4;
}
.gallery-main-link {
    display: block;
    width: 100%;
    height: 100%;
}
.gallery-main-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.gm-zoom:hover .gallery-main-img {
    transform: scale(1.03);
}
.gm-badge {
    position: absolute;
    top: 16px;
    left: 16px;
    padding: 6px 12px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    border-radius: 2px;
    z-index: 10;
}
.gm-badge--sale {
    background: var(--gm-ink);
    color: var(--gm-paper);
}
.gm-thumbs {
    display: flex;
    gap: 12px;
    margin-top: 16px;
    overflow-x: auto;
    padding-bottom: 8px;
    scroll-snap-type: x mandatory;
}
.gm-thumb {
    flex: 0 0 80px;
    height: 100px;
    border: 2px solid transparent;
    border-radius: 4px;
    overflow: hidden;
    background: var(--gm-bone);
    cursor: pointer;
    transition: border-color 0.2s ease;
    scroll-snap-align: start;
}
.gm-thumb.active,
.gm-thumb:hover {
    border-color: var(--gm-ink);
}
.gm-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Product Info */
.gm-product-info {
    padding-left: 24px;
}
.gm-product-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 8px;
}
.gm-category,
.gm-brand {
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--gm-muted);
}
.gm-brand::before {
    content: '•';
    margin-right: 8px;
    color: var(--gm-line);
}
.gm-product-title {
    font-family: var(--gm-display);
    font-size: clamp(28px, 4vw, 40px);
    font-weight: 400;
    letter-spacing: -0.02em;
    line-height: 1.15;
    margin: 8px 0 16px;
    color: var(--gm-ink);
}
.gm-price-wrapper {
    display: flex;
    align-items: baseline;
    gap: 12px;
    flex-wrap: wrap;
    margin: 16px 0 24px;
}
.gm-price--current {
    font-family: var(--gm-display);
    font-size: clamp(28px, 3.5vw, 36px);
    font-weight: 500;
    color: var(--gm-ink);
}
.gm-price--old {
    font-family: var(--gm-display);
    font-size: clamp(20px, 2.5vw, 24px);
    font-weight: 400;
    color: var(--gm-muted);
    text-decoration: line-through;
}
.gm-badge--sale-inline {
    background: var(--gm-ink);
    color: var(--gm-paper);
    padding: 4px 10px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    border-radius: 2px;
    align-self: flex-start;
}
.gm-features {
    list-style: none;
    padding: 0;
    margin: 0 0 24px;
    display: flex;
    flex-wrap: wrap;
    gap: 16px 24px;
}
.gm-features li {
    position: relative;
    padding-left: 20px;
    font-size: 14px;
    color: var(--gm-muted);
    line-height: 1.5;
}
.gm-features li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 8px;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--gm-accent);
}

/* Cart Form */
.gm-cart-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding-top: 8px;
}
.gm-variations {
    padding-top: 4px;
}
.gm-variation-group {
    margin: 0;
    padding: 0;
    border: none;
}
.gm-variation-label {
    display: block;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gm-ink);
    margin-bottom: 12px;
}
.gm-size-options {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.gm-size-btn {
    min-width: 48px;
    height: 44px;
    padding: 0 16px;
    border: 1px solid var(--gm-line);
    background: var(--gm-paper);
    color: var(--gm-ink);
    font-family: var(--gm-body);
    font-size: 13px;
    font-weight: 500;
    border-radius: 3px;
    cursor: pointer;
    transition: all 0.15s ease;
}
.gm-size-btn:hover,
.gm-size-btn:focus-visible {
    border-color: var(--gm-ink);
}
.gm-size-btn.active {
    background: var(--gm-ink);
    color: var(--gm-paper);
    border-color: var(--gm-ink);
}
.gm-size-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

.gm-quantity-wrapper {
    display: flex;
    align-items: center;
    gap: 16px;
}
.gm-qty-label {
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gm-ink);
    white-space: nowrap;
}
.gm-qty-selector {
    display: inline-flex;
    border: 1px solid var(--gm-line);
    border-radius: 3px;
    overflow: hidden;
}
.gm-qty-btn {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--gm-bone);
    border: none;
    color: var(--gm-ink);
    font-size: 18px;
    line-height: 1;
    cursor: pointer;
    transition: background 0.15s ease;
}
.gm-qty-btn:hover {
    background: var(--gm-line);
}
.gm-qty-input {
    width: 64px;
    height: 44px;
    border: none;
    border-left: 1px solid var(--gm-line);
    border-right: 1px solid var(--gm-line);
    text-align: center;
    font-family: var(--gm-body);
    font-size: 15px;
    font-weight: 500;
    color: var(--gm-ink);
    background: var(--gm-paper);
    -moz-appearance: textfield;
}
.gm-qty-input::-webkit-outer-spin-button,
.gm-qty-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.gm-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding-top: 8px;
}
.gm-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-family: var(--gm-body);
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    border-radius: 0;
    transition: all 0.15s ease;
    border: none;
    cursor: pointer;
}
.gm-btn--primary {
    background: var(--gm-ink);
    color: var(--gm-paper);
}
.gm-btn--primary:hover {
    background: var(--gm-ink-deep);
}
.gm-btn--lg {
    padding: 16px 32px;
    font-size: 13px;
}
.gm-btn--block {
    width: 100%;
}

/* Contact Phones */
.gm-contact-phones {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding-top: 8px;
}
.gm-phone-link {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 18px;
    background: var(--gm-ink);
    color: var(--gm-paper);
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: background 0.15s ease;
}
.gm-phone-link:hover {
    background: var(--gm-ink-deep);
}
.gm-phone-link i {
    font-size: 16px;
}

/* Delivery Info */
.gm-delivery-info {
    display: flex;
    flex-wrap: wrap;
    gap: 16px 24px;
    padding-top: 16px;
    border-top: 1px solid var(--gm-line);
    margin-top: 16px;
}
.gm-delivery-item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--gm-muted);
}
.gm-delivery-item i {
    color: var(--gm-accent);
    font-size: 14px;
}

/* Tabs */
.gm-tabs {
    display: flex;
    border-bottom: 1px solid var(--gm-line);
    margin: 40px 0 24px;
    padding: 0 24px;
}
.gm-tab-btn {
    padding: 16px 0;
    background: none;
    border: none;
    border-bottom: 2px solid transparent;
    font-family: var(--gm-body);
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gm-muted);
    cursor: pointer;
    transition: all 0.15s ease;
    margin-right: 32px;
}
.gm-tab-btn:hover,
.gm-tab-btn:focus-visible {
    color: var(--gm-ink);
}
.gm-tab-btn.active {
    color: var(--gm-ink);
    border-bottom-color: var(--gm-ink);
}
.gm-tab-panels > .gm-tab-panel {
    display: none;
    padding: 0 24px;
}
.gm-tab-panels > .gm-tab-panel.active {
    display: block;
    animation: gm-fade-in 0.2s ease;
}
@keyframes gm-fade-in {
    from { opacity: 0; transform: translateY(4px); }
    to { opacity: 1; transform: translateY(0); }
}
.gm-prose {
    font-family: var(--gm-body);
    font-size: 15px;
    line-height: 1.8;
    color: var(--gm-ink);
}
.gm-prose p { margin: 0 0 1.5em; }
.gm-prose h2 { font-family: var(--gm-display); font-weight: 400; margin: 2em 0 0.5em; }
.gm-prose h3 { font-family: var(--gm-display); font-weight: 400; margin: 1.5em 0 0.5em; }
.gm-prose ul, .gm-prose ol { margin: 1em 0; padding-left: 1.5em; }
.gm-prose li { margin: 0.5em 0; }
.gm-prose strong { font-weight: 600; }
.gm-video-wrapper {
    position: relative;
    width: 100%;
    padding-top: 56.25%;
    margin: 2em 0;
    border-radius: 4px;
    overflow: hidden;
}
.gm-video-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}

/* Related Products */
.gm-section-header {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    margin-bottom: 32px;
    padding: 0 24px;
}
.gm-section-title {
    font-family: var(--gm-display);
    font-size: clamp(24px, 3vw, 32px);
    font-weight: 400;
    letter-spacing: -0.01em;
    color: var(--gm-ink);
}
.gm-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-family: var(--gm-body);
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--gm-ink);
    text-decoration: none;
    transition: gap 0.15s ease;
}
.gm-link:hover {
    gap: 10px;
}
.gm-product-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    padding: 0 24px;
}

/* Sticky Bar */
.gm-sticky-bar {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 100;
    transform: translateY(100%);
    transition: transform 0.25s ease;
    background: var(--gm-paper);
    box-shadow: 0 -4px 24px rgba(0,0,0,0.08);
    border-top: 1px solid var(--gm-line);
}
.gm-sticky-bar.is-visible {
    transform: translateY(0);
}
.gm-sticky-bar-inner {
    display: grid;
    grid-template-columns: 1fr 1.2fr 1.5fr;
    align-items: stretch;
    max-width: 100%;
    margin: 0 auto;
}
.gm-sticky-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 2px;
    padding: 12px 8px;
    background: transparent;
    border: none;
    color: var(--gm-muted);
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    cursor: pointer;
    transition: color 0.15s ease;
}
.gm-sticky-btn:hover {
    color: var(--gm-ink);
}
.gm-sticky-btn i {
    font-size: 20px;
    line-height: 1;
}
.gm-sticky-count {
    position: absolute;
    top: 2px;
    right: 2px;
    min-width: 16px;
    height: 16px;
    padding: 0 4px;
    background: var(--gm-accent);
    color: var(--gm-paper);
    font-size: 10px;
    font-weight: 600;
    line-height: 16px;
    text-align: center;
    border-radius: 8px;
}
.gm-sticky-form {
    margin: 0;
}
.gm-sticky-btn--buy {
    background: var(--gm-accent);
    color: var(--gm-paper);
    font-family: var(--gm-body);
    font-size: 13px;
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 16px;
}
.gm-sticky-btn--buy:hover {
    background: #c0392b;
    color: var(--gm-paper);
}
.gm-sticky-btn--add {
    background: var(--gm-ink);
    color: var(--gm-paper);
    font-family: var(--gm-body);
    font-size: 13px;
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 16px;
    gap: 6px;
}
.gm-sticky-btn--add:hover {
    background: var(--gm-ink-deep);
}

/* Responsive */
@media (max-width: 1199px) {
    .gm-product-grid {
        grid-template-columns: repeat(3, 1fr);
    }
    .gm-product-info {
        padding-left: 16px;
    }
}
@media (max-width: 991px) {
    .gm-product-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .gm-section-header,
    .gm-product-grid {
        padding: 0 16px;
    }
    .gm-tabs {
        padding: 0 16px;
    }
    .gm-tab-panels > .gm-tab-panel {
        padding: 0 16px;
    }
}
@media (max-width: 767px) {
    .axil-single-product-area {
        padding-top: 8px !important;
    }
    .gallery-main {
        aspect-ratio: 3/4;
    }
    .gm-product-info {
        padding-left: 0;
        padding-top: 24px;
    }
    .gm-product-title {
        font-size: 26px;
    }
    .gm-price--current {
        font-size: 28px;
    }
    .gm-price--old {
        font-size: 20px;
    }
    .gm-size-options {
        gap: 6px;
    }
    .gm-size-btn {
        min-width: 44px;
        height: 40px;
        padding: 0 12px;
        font-size: 12px;
    }
    .gm-qty-btn {
        width: 40px;
        height: 40px;
    }
    .gm-qty-input {
        width: 56px;
        height: 40px;
    }
    .gm-btn--lg {
        padding: 14px 24px;
        font-size: 12px;
    }
    .gm-sticky-bar-inner {
        grid-template-columns: 1fr 1.3fr 1.5fr;
    }
    .gm-sticky-btn span:not(.gm-sticky-count) {
        display: none;
    }
    .gm-sticky-btn i {
        font-size: 22px;
    }
    .gm-sticky-btn--buy,
    .gm-sticky-btn--add {
        font-size: 0;
        padding: 14px;
    }
    .gm-sticky-btn--buy::before {
        content: 'Buy Now';
        font-size: 12px;
    }
    .gm-sticky-btn--add::before {
        content: 'Add to Bag';
        font-size: 12px;
    }
}
@media (max-width: 480px) {
    .gm-product-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@push('js')
<script>
(function() {
    'use strict';

    // DOM elements
    const $ = window.jQuery;
    const $priceCurrent = $('#gm-price-current');
    const $priceOld = $('#gm-price-old');
    const $priceVal = $('#gm-price-val');
    const $variationId = $('#gm-variation-id');
    const $stickyVariations = $('.gm-sticky-variation');
    const $sizeBtns = $('.gm-size-btn');
    const $qtyInput = $('#gm-qty');
    const $qtyDecrease = $('.gm-qty-btn--decrease');
    const $qtyIncrease = $('.gm-qty-btn--increase');
    const $cartForm = $('#gm-cart-form');
    const $stickyBar = $('#gm-sticky-bar');
    const $stickyCount = $('#gm-sticky-count');
    const $galleryMain = $('.gallery-main-img');
    const $galleryMainLink = $('.gallery-main-link');
    const $thumbs = $('.gm-thumb');
    const $tabBtns = $('.gm-tab-btn');
    const $tabPanels = $('.gm-tab-panel');

    // Currency symbol
    const currencySymbol = '{{ $currencySymbol }}';

    // Variation data
    const variations = {};
    $('.gm-variation-option').each(function() {
        const $opt = $(this);
        variations[$opt.data('id')] = {
            price: parseFloat($opt.data('price')),
            label: $opt.data('label')
        };
    });

    // Gallery thumb switching
    $thumbs.on('click', function() {
        const $thumb = $(this);
        const index = $thumb.data('index');
        const $target = index === 0
            ? $($thumbs[0]).find('img')
            : $($thumbs[index]).find('img');

        if ($target.length) {
            const src = $target.attr('src');
            const href = $target.closest('button').data('full') || src;
            $galleryMain.attr('src', src);
            $galleryMainLink.attr('href', href);
            $thumbs.removeClass('active');
            $thumb.addClass('active');
        }
    });

    // Size selection
    function selectSize($btn) {
        const val = $btn.data('value');
        const varData = variations[val];

        $sizeBtns.removeClass('active').attr('aria-pressed', 'false');
        $btn.addClass('active').attr('aria-pressed', 'true');

        $variationId.val(val);
        $stickyVariations.val(val);

        if (varData) {
            const newPrice = varData.price;
            $priceCurrent.text(currencySymbol + ' ' + newPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $priceVal.val(newPrice);

            // Update old price if discounted
            // We'd need original price per variation; for now keep as-is
        }
    }

    $sizeBtns.on('click', function() {
        selectSize($(this));
    });

    // Keyboard navigation for size buttons
    $sizeBtns.on('keydown', function(e) {
        const $btns = $sizeBtns.filter(':visible');
        const index = $btns.index(this);
        let newIndex = index;

        if (e.key === 'ArrowRight') newIndex = (index + 1) % $btns.length;
        else if (e.key === 'ArrowLeft') newIndex = (index - 1 + $btns.length) % $btns.length;
        else if (e.key === 'Home') newIndex = 0;
        else if (e.key === 'End') newIndex = $btns.length - 1;
        else return;

        e.preventDefault();
        $btns.eq(newIndex).focus().click();
    });

    // Quantity controls
    function updateQty(delta) {
        let val = parseInt($qtyInput.val()) || 1;
        const max = parseInt($qtyInput.attr('max')) || 99;
        val = Math.max(1, Math.min(max, val + delta));
        $qtyInput.val(val);
        $('.gm-qty-input').val(val);
    }

    $qtyDecrease.on('click', () => updateQty(-1));
    $qtyIncrease.on('click', () => updateQty(1));
    $qtyInput.on('change', function() {
        let val = parseInt($(this).val()) || 1;
        const max = parseInt($(this).attr('max')) || 99;
        val = Math.max(1, Math.min(max, val));
        $(this).val(val);
        $('.gm-qty-input').val(val);
    });

    // Cart form AJAX
    $cartForm.on('submit', function(e) {
        e.preventDefault();

        const $form = $(this);
        const url = $form.attr('action');
        const method = $form.attr('method');
        const data = $form.serialize();

        $.ajax({
            url: url,
            method: method,
            data: data,
            dataType: 'json',
            beforeSend: () => {
                $form.find('button[type="submit"]').prop('disabled', true).addClass('loading');
            },
            success: function(res) {
                if (res.success) {
                    if (window.toastr) toastr.success(res.msg || 'Added to bag');
                    if (res.item) {
                        $stickyCount.text(res.item);
                        $('.cart-count, .gm-cart-badge').text(res.item);
                    }
                    if (res.view) {
                        $('#cart-dropdown').html(res.view);
                    }
                    if (res.url) {
                        window.location.href = res.url;
                    }
                } else {
                    if (window.toastr) toastr.error(res.msg || 'Unable to add item');
                }
            },
            error: function(xhr) {
                if (window.toastr) {
                    const errors = xhr.responseJSON?.errors;
                    if (errors) {
                        $.each(errors, function(_, msgs) {
                            $.each(msgs, function(_, msg) { toastr.error(msg); });
                        });
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            },
            complete: () => {
                $form.find('button[type="submit"]').prop('disabled', false).removeClass('loading');
            }
        });
    });

    // Sticky bar scroll visibility
    let lastScroll = 0;
    $(window).on('load scroll', function() {
        const scrollTop = $(window).scrollTop();
        const shouldShow = scrollTop > 260;
        $stickyBar.toggleClass('is-visible', shouldShow);
        lastScroll = scrollTop;
    });

    // Tabs
    $tabBtns.on('click', function() {
        const $btn = $(this);
        const target = $btn.attr('aria-controls');

        $tabBtns.removeClass('active').attr('aria-selected', 'false');
        $btn.addClass('active').attr('aria-selected', 'true');

        $tabPanels.removeClass('active').attr('hidden', true);
        $('#' + target).addClass('active').attr('hidden', false);
    });

    // Initialize first size for variable products
    if ($sizeBtns.length) {
        const $first = $sizeBtns.first();
        if (!$first.hasClass('active')) {
            selectSize($first);
        }
    }

    // Load related products
    function loadRelated() {
        const url = '{{ route("front.products.relativeProduct", [$product->id]) }}';
        $.getJSON(url, function(res) {
            if (res.success && res.html) {
                $('#gm-relative-products').html(res.html);
                // Remove slick if it was initialized (we use CSS grid now)
                if ($.fn.slick) {
                    $('.gm-product-grid.slick-initialized').slick('unslick');
                }
            }
        });
    }

    loadRelated();

})();
</script>
@endpush