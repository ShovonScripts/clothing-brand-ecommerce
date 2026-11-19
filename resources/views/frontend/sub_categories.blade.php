@extends('frontend.app')

@section('title', 'Collection — GENTRY')

@section('content')
@php $parent = $subs->first() ? optional($subs->first())->parent : null; @endphp
<main class="main-wrapper">
    <div class="axil-breadcrumb-area">
        <div class="container-fluid">
            <ul class="axil-breadcrumb">
                <li class="axil-breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                <li class="separator"></li>
                <li class="axil-breadcrumb-item"><a href="{{ route('front.categories') }}">Collections</a></li>
                <li class="separator"></li>
                <li class="axil-breadcrumb-item active" aria-current="page">{{ $parent ? $parent->name : 'Collection' }}</li>
            </ul>
        </div>
    </div>

    <section class="gm-section">
        <div class="container-fluid">
            <div class="gm-section-head">
                <div>
                    <span class="gm-eyebrow">Collection</span>
                    <h1 class="gm-title">{{ $parent ? $parent->name : 'Collection' }}</h1>
                    <p class="gm-subtitle">Refine your wardrobe with pieces designed to be worn together, season after season.</p>
                </div>
                @if($parent)
                <a href="{{ route('front.products.index') }}?category_id={{ $parent->id }}" class="gm-link">Shop all {{ $parent->name }} <i class="fas fa-arrow-right"></i></a>
                @endif
            </div>

            @if($subs->count())
            <div class="gm-cats">
                @foreach($subs as $sub)
                <a class="gm-cat" href="{{ route('front.products.index') }}?category_id={{ $sub->parent_id }}&sub_category_id={{ $sub->id }}">
                    <img src="{{ getImage('categories', $sub->image) }}" alt="{{ $sub->name }}" loading="lazy">
                    <div class="gm-cat-label">
                        <h3>{{ $sub->name }}</h3>
                        <span><i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="alert alert-light" style="border-radius:0">New pieces are arriving in this collection soon.</div>
            @endif
        </div>
    </section>
</main>
@endsection
