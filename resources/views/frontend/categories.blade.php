@extends('frontend.app')

@section('title', 'Collections — GENTRY')

@section('content')
<main class="main-wrapper">
    <div class="axil-breadcrumb-area">
        <div class="container-fluid">
            <ul class="axil-breadcrumb">
                <li class="axil-breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                <li class="separator"></li>
                <li class="axil-breadcrumb-item active" aria-current="page">Collections</li>
            </ul>
        </div>
    </div>

    <section class="gm-section">
        <div class="container-fluid">
            <div class="gm-section-head">
                <div>
                    <span class="gm-eyebrow">The wardrobe</span>
                    <h1 class="gm-title">Shop by category</h1>
                    <p class="gm-subtitle">Every piece in its place. Explore the full range of menswear, from shirting to tailoring and everyday essentials.</p>
                </div>
                <a href="{{ route('front.products.index') }}" class="gm-link">Shop all <i class="fas fa-arrow-right"></i></a>
            </div>

            @if($cats->count())
            <div class="gm-cats">
                @foreach($cats as $cat)
                <a class="gm-cat" href="{{ route('front.products.index') }}?category_id={{ $cat->id }}">
                    <img src="{{ getImage('categories', $cat->image) }}" alt="{{ $cat->name }}" loading="lazy">
                    <div class="gm-cat-label">
                        <h3>{{ $cat->name }}</h3>
                        <span><i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    @if(isset($subs) && $subs->count())
    <section class="gm-section gm-section--tight" style="padding-top:0">
        <div class="container-fluid">
            <div class="gm-section-head">
                <div>
                    <span class="gm-eyebrow">More to explore</span>
                    <h2 class="gm-title">Featured sub-collections</h2>
                </div>
            </div>
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
        </div>
    </section>
    @endif
</main>
@endsection
