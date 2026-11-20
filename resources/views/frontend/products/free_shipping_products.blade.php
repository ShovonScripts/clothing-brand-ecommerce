@extends('frontend.app')

@section('title', 'Free Shipping — GENTRY')

@section('content')
{{-- Frontend\ProductController@free_shipping passes $items: a collection of products. --}}
<main class="main-wrapper">
    <x-ui.breadcrumb :items="[
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Free Shipping'],
    ]" />

    <x-ui.section size="md">
        <x-ui.section-header
            title="Free shipping"
            subtitle="Delivered at no extra cost"
            :count="$items->count()"
        />

        @if($items->count())
            <x-ui.product-grid>
                @foreach($items as $product)
                    @include('frontend.products.partials.card', ['product' => $product])
                @endforeach
            </x-ui.product-grid>
        @else
            <x-ui.empty-state
                type="search"
                title="No free-shipping pieces right now"
                message="Check back soon, or browse the full collection."
                action="Shop all"
                :actionUrl="route('front.products.index')"
            />
        @endif
    </x-ui.section>
</main>
@endsection
