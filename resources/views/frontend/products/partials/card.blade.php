{{--
    One product card in the new design. Expects $product (App\Models\Product).
    Used by the shop listing (index_data), the discount AJAX partial and the
    free-shipping page.

    Single-variation products get an "Add to bag" quick-add form; the submit is
    handled by the global `form.gm-quick-add` handler in frontend/partials/js.
--}}
@php
    $data = getProductInfo($product);
    $hasDiscount = $data['discount_amount'] > 0 && $data['old_price'] > 0;
    $isSingle = ($product->type ?? 'single') === 'single';
    $variationId = optional($product->variation)->id;
@endphp

<x-ui.product-card
    role="listitem"
    :image="getImage('products', $product->image)"
    :name="$product->name"
    :price="$data['price']"
    :originalPrice="$hasDiscount ? $data['old_price'] : null"
    :category="optional($product->category)->name"
    :badges="$hasDiscount ? [['variant' => 'sale', 'label' => 'Sale']] : []"
    :href="route('front.products.show', [$product->id])"
>
    <x-slot name="actions">
        @if($isSingle && $variationId)
            <form class="gm-quick-add" method="POST" action="{{ route('front.carts.storeCart') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="variation_id" value="{{ $variationId }}">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="is_stock" value="{{ $product->is_stock }}">
                <x-ui.button type="submit" variant="primary" size="sm" full>Add to bag</x-ui.button>
            </form>
        @else
            <x-ui.button :href="route('front.products.show', [$product->id])" variant="secondary" size="sm" full>Select options</x-ui.button>
        @endif
    </x-slot>
</x-ui.product-card>
