@extends('frontend.app')

@section('title', 'Combo Offers — GENTRY')

@section('content')
{{-- Frontend\ProductController@comboProducts passes $items: a paginator of Combo
     models; each combo points at one product through ->product. --}}
@php
    $combos = $items->filter(fn ($combo) => $combo->product);
@endphp
<main class="main-wrapper">
    <x-ui.breadcrumb :items="[
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Combo Offers'],
    ]" />

    <x-ui.section size="md">
        <x-ui.section-header
            title="Combo offers"
            subtitle="Bundles put together for you"
            :count="$items->total()"
        />

        @if($combos->count())
            <x-ui.product-grid>
                @foreach($combos as $combo)
                    @include('frontend.products.partials.card', ['product' => $combo->product])
                @endforeach
            </x-ui.product-grid>

            @if($items->hasPages())
                <nav class="gm-pagination-wrapper" aria-label="Combo pages">
                    {!! $items->links() !!}
                </nav>
            @endif
        @else
            <x-ui.empty-state
                type="search"
                title="No combo offers right now"
                message="Check back soon, or browse the full collection."
                action="Shop all"
                :actionUrl="route('front.products.index')"
            />
        @endif
    </x-ui.section>
</main>
@endsection
