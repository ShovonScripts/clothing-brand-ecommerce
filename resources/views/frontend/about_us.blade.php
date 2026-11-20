@extends('frontend.app')

@section('title', 'Our Story — GENTRY')

@section('content')
<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Our Story'],
        ]"
    />

    <x-ui.section size="xl">
        <div class="gm-page-hero">
            <div class="gm-page-hero-media">
                <img src="{{ asset('sliders/mens-hero-2.jpg') }}" alt="The Gentry atelier" loading="lazy">
            </div>
            <div class="gm-page-hero-content">
                <span class="gm-eyebrow">Est. 2018 — Designed for everyday</span>
                <h1>{{ $page && $page->title ? $page->title : 'Clothes for the life you actually live.' }}</h1>
                <p>GENTRY began with a simple frustration: menswear that looked good but never felt right, or felt right but never looked considered. We set out to build a wardrobe where both were true — refined enough for the room, relaxed enough for the day.</p>
                <x-ui.button variant="primary" size="lg" href="{{ route('front.products.index') }}">Shop the collection</x-ui.button>
            </div>
        </div>
    </x-ui.section>

    <x-ui.section size="lg">
        <div class="gm-container">
            <div class="gm-prose gm-prose--narrow">
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
    </x-ui.section>

    <x-ui.section size="lg" background="bg">
        <div class="gm-container">
            <div class="gm-page__header">
                <span class="gm-eyebrow">Our promise</span>
                <h2 class="gm-page__title">What we stand for</h2>
                <p class="gm-page__subtitle">Four principles that guide everything we make</p>
            </div>
            <x-ui.grid :columns="4" :gap="4" :autoFit="true" :minWidth="220">
                <article class="gm-value" style="text-align: center; padding: var(--s-4);">
                    <div class="gm-value-icon" style="width: 56px; height: 56px; margin: 0 auto var(--s-4); border-radius: 50%; background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; color: var(--c-accent);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    </div>
                    <h3 class="gm-value-title" style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); margin: 0 0 var(--s-2);">Free delivery</h3>
                    <p class="gm-value-text" style="color: var(--c-ink-700); margin: 0;">On orders over {{ $currencySymbol ?? '৳' }}5,000</p>
                </article>
                <article class="gm-value" style="text-align: center; padding: var(--s-4);">
                    <div class="gm-value-icon" style="width: 56px; height: 56px; margin: 0 auto var(--s-4); border-radius: 50%; background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; color: var(--c-accent);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                    </div>
                    <h3 class="gm-value-title" style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); margin: 0 0 var(--s-2);">Easy returns</h3>
                    <p class="gm-value-text" style="color: var(--c-ink-700); margin: 0;">14 days, no questions</p>
                </article>
                <article class="gm-value" style="text-align: center; padding: var(--s-4);">
                    <div class="gm-value-icon" style="width: 56px; height: 56px; margin: 0 auto var(--s-4); border-radius: 50%; background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; color: var(--c-accent);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="2"></rect><line x1="2" y1="12" x2="22" y2="12"></line></svg>
                    </div>
                    <h3 class="gm-value-title" style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); margin: 0 0 var(--s-2);">Secure payment</h3>
                    <p class="gm-value-text" style="color: var(--c-ink-700); margin: 0;">Trusted & encrypted</p>
                </article>
                <article class="gm-value" style="text-align: center; padding: var(--s-4);">
                    <div class="gm-value-icon" style="width: 56px; height: 56px; margin: 0 auto var(--s-4); border-radius: 50%; background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; color: var(--c-accent);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                    </div>
                    <h3 class="gm-value-title" style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); margin: 0 0 var(--s-2);">Support</h3>
                    <p class="gm-value-text" style="color: var(--c-ink-700); margin: 0;">Mon–Fri, 9–6</p>
                </article>
            </x-ui.grid>
        </div>
    </x-ui.section>
</main>
@endsection