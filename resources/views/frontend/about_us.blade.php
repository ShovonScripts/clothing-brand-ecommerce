@extends('frontend.app')

@section('title', 'Our Story — GENTRY')

@section('content')
<main class="main-wrapper">
    <div class="axil-breadcrumb-area">
        <div class="container-fluid">
            <ul class="axil-breadcrumb">
                <li class="axil-breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                <li class="separator"></li>
                <li class="axil-breadcrumb-item active" aria-current="page">Our story</li>
            </ul>
        </div>
    </div>

    <section class="container-fluid">
        <div class="gm-page-hero">
            <div class="gm-page-hero-media">
                <img src="{{ asset('sliders/mens-hero-2.jpg') }}" alt="The Gentry atelier" loading="lazy">
            </div>
            <div>
                <span class="gm-eyebrow">Est. 2018 — Designed for everyday</span>
                <h1>{{ $page && $page->title ? $page->title : 'Clothes for the life you actually live.' }}</h1>
                <p>GENTRY began with a simple frustration: menswear that looked good but never felt right, or felt right but never looked considered. We set out to build a wardrobe where both were true — refined enough for the room, relaxed enough for the day.</p>
                <a href="{{ route('front.products.index') }}" class="gm-btn" style="margin-top:14px">Shop the collection</a>
            </div>
        </div>
    </section>

    <section class="gm-page">
        <div class="container-fluid">
            <div class="gm-page-narrow gm-prose">
                @if($page && $page->body)
                    {!! $page->body !!}
                @else
                    <h2>Our approach</h2>
                    <p>We work with a small number of mills and makers who share our standards. Natural fibres, honest construction and a fit that is tested on real bodies — not just on a mannequin. Every piece is designed to work with the rest of the wardrobe, so getting dressed stays effortless.</p>
                    <h2>Considered by design</h2>
                    <p>We release fewer, better things. Instead of chasing every trend, we refine the essentials: the oxford shirt that breaks in beautifully, the trouser with the right break, the jacket that earns its place by the door. When we do introduce something new, it is because it earns its place.</p>
                    <blockquote>Good clothes should feel like a decision you made once, and then never had to think about again.</blockquote>
                    <h2>Made to last</h2>
                    <p>We believe in buying less and wearing more. Our garments are built to be repaired, re-worn and passed on. If something isn't right, our client services team is here to help — seven days a week.</p>
                @endif
            </div>
        </div>
    </section>
</main>
@endsection
