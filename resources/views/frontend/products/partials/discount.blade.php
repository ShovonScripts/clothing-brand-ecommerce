{{--
    AJAX fragment for the Sale page. Rendered by Frontend\ProductController@discountProduct
    and returned as JSON {html}; receives $items (a paginator of discounted products).
--}}
@if($items->count())
    <x-ui.product-grid>
        @foreach($items as $product)
            @include('frontend.products.partials.card', ['product' => $product])
        @endforeach
    </x-ui.product-grid>

    @if($items->hasPages())
        <nav class="gm-pagination-wrapper" aria-label="Sale pages">
            {!! $items->links() !!}
        </nav>
    @endif
@else
    <x-ui.empty-state
        type="search"
        title="No sale pieces right now"
        message="Check back soon, or browse the full collection."
        action="Shop all"
        :actionUrl="route('front.products.index')"
    />
@endif
