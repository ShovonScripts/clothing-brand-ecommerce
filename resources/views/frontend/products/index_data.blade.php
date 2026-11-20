{{--
    AJAX fragment for the shop page. Rendered by Frontend\ProductController@index
    when the request is AJAX; receives $items (a paginator of products).
    Injected into #gm-shop-products by the script in frontend/products/index.blade.php.
--}}
<p class="gm-listing-results" data-gm-result-count>
    {{ $items->total() }} {{ \Illuminate\Support\Str::plural('product', $items->total()) }} found
</p>

@if($items->count())
    <x-ui.product-grid>
        @foreach($items as $product)
            @include('frontend.products.partials.card', ['product' => $product])
        @endforeach
    </x-ui.product-grid>

    @if($items->hasPages())
        <nav class="gm-pagination-wrapper" aria-label="Product pages" data-gm-shop-pagination>
            {!! $items->appends(request()->except('page'))->links() !!}
        </nav>
    @endif
@else
    <x-ui.empty-state
        type="search"
        title="No products found"
        message="Try removing a filter or browse the full collection."
    />
@endif
