@extends('frontend.app')

@section('title', 'Careers — GENTRY')

@section('content')
@php
$info = \App\Models\Information::first();
$items = $items ?? collect();
@endphp
<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Careers'],
        ]"
    />

    <x-ui.section size="lg">
        <div class="gm-container">
            <div class="gm-page__header">
                <span class="gm-eyebrow">Join us</span>
                <h1 class="gm-page__title">Careers at GENTRY</h1>
                <p class="gm-page__subtitle">We're a small team building something lasting. If you care about craft, detail and doing things properly, we'd like to hear from you.</p>
            </div>

            <div class="gm-career-grid">
                @foreach($items as $item)
                    <article class="gm-career-card">
                        <div class="gm-career-media">
                            @if($item->image)
                                <img src="{{ getImage('career', $item->image) }}" alt="{{ $item->title }}" loading="lazy">
                            @else
                                <div class="gm-skeleton gm-skeleton--box" aria-hidden="true"></div>
                            @endif
                        </div>
                        <div class="gm-career-content">
                            <h2 class="gm-career-title">{{ $item->title }}</h2>
                            <div class="gm-career-description gm-prose" style="font-size: var(--t-md); max-width: none;">
                                {!! $item->description !!}
                            </div>
                        </div>
                    </article>
                @endforeach

                @if($items->isEmpty())
                    <div class="gm-empty-state gm-empty-state--default" style="grid-column: 1 / -1;">
                        <x-ui.empty-state
                            type="default"
                            title="No open positions"
                            message="We're not currently hiring, but we're always interested in meeting talented people. Check back soon or send us your portfolio."
                            action="Contact Us"
                            :actionUrl="route('front.contactUs')"
                        />
                    </div>
                @endif
            </div>
        </div>
    </x-ui.section>
</main>
@endsection