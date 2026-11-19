@php
    $data = getProductInfo($product);
    $info = \App\Models\Information::first();
    $hasDiscount = ($data['discount_amount'] > 0 && $data['old_price'] > 0);
    $categoryName = optional($product->category)->name;
    $isSingle = ($product->type ?? 'single') === 'single';
    $variationId = optional($product->variation)->id;
@endphp

<article class="gm-card">
    <div class="gm-card-media">
        <a href="{{ route('front.products.show', [$product->id]) }}" aria-label="{{ $product->name }}">
            <img src="{{ getImage('products', $product->image) }}" alt="{{ $product->name }}" loading="lazy">
        </a>

        @if($hasDiscount)
        <span class="gm-card-badge gm-card-badge--sale">
            {{ $product->discount_type == 'fixed' ? 'Sale' : rtrim(rtrim(number_format((float) $product->discount, 1), '0'), '.') . '% off' }}
        </span>
        @elseif($product->created_at && $product->created_at->gt(now()->subDays(30)))
        <span class="gm-card-badge">New</span>
        @endif

        @auth
        <a href="{{ route('front.wishlist.index') }}" class="gm-card-wish" aria-label="Save {{ $product->name }}"><i class="far fa-heart"></i></a>
        @else
        <a href="{{ route('login') }}" class="gm-card-wish" aria-label="Sign in to save {{ $product->name }}"><i class="far fa-heart"></i></a>
        @endauth

        <div class="gm-card-quick">
            @if($isSingle && $variationId)
            <form class="gm-quick-add" method="POST" action="{{ route('front.carts.storeCart') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="variation_id" value="{{ $variationId }}">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="is_stock" value="{{ $product->is_stock }}">
                <button type="submit" class="gm-btn"><i class="fas fa-shopping-bag"></i> Add to bag</button>
            </form>
            @else
            <a href="{{ route('front.products.show', [$product->id]) }}" class="gm-btn"><i class="fas fa-sliders-h"></i> Select options</a>
            @endif
        </div>
    </div>

    <div class="gm-card-body">
        <div class="gm-card-meta">{{ $categoryName ?: 'Gentry' }}</div>
        <h3 class="gm-card-name">
            <a href="{{ route('front.products.show', [$product->id]) }}">{{ \Illuminate\Support\Str::limit($product->name, 46) }}</a>
        </h3>
        <div class="gm-card-price">
            <span class="{{ $hasDiscount ? 'gm-price-sale' : '' }}">{{ priceFormate($data['price']) }}</span>
            @if($hasDiscount)
            <del>{{ priceFormate($data['old_price']) }}</del>
            @endif
        </div>
    </div>
</article>
