@extends('frontend.app')

@section('title', 'Returns & Exchanges — GENTRY')

@section('content')
<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Returns & Exchanges'],
        ]"
    />

    <x-ui.section size="lg">
        <div class="gm-container">
            <div class="gm-page__header">
                <span class="gm-eyebrow">Client services</span>
                <h1 class="gm-page__title">Returns & Exchanges</h1>
                <p class="gm-page__subtitle">We want you to love what you wear. If something isn't right, you have 14 days from delivery to return or exchange it.</p>
            </div>

            <div class="gm-prose gm-prose--narrow">
                <h2>Eligibility</h2>
                <ul>
                    <li>Items must be unworn, unwashed and in their original condition.</li>
                    <li>Original tags and packaging must be intact.</li>
                    <li>Proof of purchase or order number is required.</li>
                </ul>

                <h2>How to start a return</h2>
                <ol>
                    <li>Contact client services with your order number and the item you'd like to return.</li>
                    <li>We will confirm eligibility and arrange a pickup where available.</li>
                    <li>Once the item is received and inspected, we will process your exchange or refund within 3–5 business days.</li>
                </ol>

                <h2>Refunds</h2>
                <p>Refunds are issued to the original payment method. Cash-on-delivery orders are refunded by bank transfer or store credit. Delivery charges are non-refundable unless the item was faulty or incorrect.</p>

                <h2>Exchanges</h2>
                <p>Need a different size or colour? We offer one free exchange per order, subject to stock availability. If your size is unavailable, we will issue a refund or store credit.</p>

                <h2>Faulty items</h2>
                <p>If a garment arrives damaged or develops a fault, contact us within 7 days with photos. We will repair, replace or refund it at no cost to you.</p>

                <p style="margin-top: 2.5em; color: var(--c-ink-500);"><em>Need help? Email <a href="mailto:{{ optional(\App\Models\Information::first())->owner_email }}">{{ optional(\App\Models\Information::first())->owner_email }}</a>.</em></p>
            </div>
        </div>
    </x-ui.section>
</main>
@endsection