@extends('frontend.app')

@section('title', 'FAQ — GENTRY')

@section('content')
@php
$info = \App\Models\Information::first();
$currencySymbol = match($info->currency) {
    'BDT' => '৳',
    'Dollar' => '$',
    'Euro' => '€',
    'Rupee' => '₹',
    default => ''
};
@endphp
<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'FAQ'],
        ]"
    />

    <x-ui.section size="lg">
        <div class="gm-container">
            <div class="gm-page__header">
                <span class="gm-eyebrow">Good to know</span>
                <h1 class="gm-page__title">Frequently Asked Questions</h1>
                <p class="gm-page__subtitle">Everything you need to know about ordering, fit, delivery and returns.</p>
            </div>

            <div class="gm-faq" style="max-width: 800px; margin: 0 auto;">
                <x-ui.accordion allowMultiple>
                    <x-ui.accordion-item open>
                        <x-slot name="trigger">How do I choose the right size?</x-slot>
                        <x-slot name="content">
                            <p>Each product page includes a size guide with chest, waist and length measurements. If you are between sizes, we recommend sizing up for a relaxed fit or staying true to size for a tailored fit. Our client services team is happy to advise — just send us your usual size and the piece you're considering.</p>
                        </x-slot>
                    </x-ui.accordion-item>

                    <x-ui.accordion-item>
                        <x-slot name="trigger">When will my order arrive?</x-slot>
                        <x-slot name="content">
                            <p>Orders placed before 3pm are dispatched the same business day. Delivery within the city typically takes 1–2 business days, and 2–4 business days elsewhere. You will receive a tracking link by SMS as soon as your order leaves our studio.</p>
                        </x-slot>
                    </x-ui.accordion-item>

                    <x-ui.accordion-item>
                        <x-slot name="trigger">What is your returns policy?</x-slot>
                        <x-slot name="content">
                            <p>You may return unworn, unwashed items with original tags within 14 days of delivery for an exchange or refund. Sale items are eligible for exchange or store credit. To start a return, contact client services with your order number and we will arrange a pickup.</p>
                        </x-slot>
                    </x-ui.accordion-item>

                    <x-ui.accordion-item>
                        <x-slot name="trigger">Do you offer free delivery?</x-slot>
                        <x-slot name="content">
                            <p>Yes. Delivery is complimentary on orders over {{ $currencySymbol ?? '৳' }}5,000. Below that, a flat delivery fee applies and is shown at checkout before you confirm your order.</p>
                        </x-slot>
                    </x-ui.accordion-item>

                    <x-ui.accordion-item>
                        <x-slot name="trigger">Which payment methods do you accept?</x-slot>
                        <x-slot name="content">
                            <p>We accept cash on delivery, bKash and major cards. All online payments are processed over an encrypted connection. You can choose your preferred method at checkout.</p>
                        </x-slot>
                    </x-ui.accordion-item>

                    <x-ui.accordion-item>
                        <x-slot name="trigger">How should I care for my garments?</x-slot>
                        <x-slot name="content">
                            <p>Wash at a low temperature, inside out, and line dry where possible. Tailoring should be dry cleaned sparingly. Knitwear should be folded rather than hung. Care instructions are printed on the inside label of every piece.</p>
                        </x-slot>
                    </x-ui.accordion-item>

                    <x-ui.accordion-item>
                        <x-slot name="trigger">Can I modify or cancel my order?</x-slot>
                        <x-slot name="content">
                            <p>If your order hasn't shipped yet, contact us immediately and we'll do our best to update or cancel it. Once dispatched, changes cannot be made — you'll need to follow our returns process instead.</p>
                        </x-slot>
                    </x-ui.accordion-item>

                    <x-ui.accordion-item>
                        <x-slot name="trigger">Do you ship internationally?</x-slot>
                        <x-slot name="content">
                            <p>Currently we deliver within Bangladesh only. We're working on international shipping — sign up for our newsletter to be the first to know when it launches.</p>
                        </x-slot>
                    </x-ui.accordion-item>
                </x-ui.accordion>
            </div>

            <div style="margin-top: var(--s-8); text-align: center;">
                <p style="color: var(--c-ink-500); margin: 0 0 var(--s-4);">Still have questions?</p>
                <x-ui.button variant="ghost" size="md" href="{{ route('front.contactUs') }}">Contact Client Services</x-ui.button>
            </div>
        </div>
    </x-ui.section>
</main>
@endsection