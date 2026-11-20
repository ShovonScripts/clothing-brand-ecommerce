@extends('frontend.app')

@section('title', 'Terms & Conditions — GENTRY')

@section('content')
<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Terms & Conditions'],
        ]"
    />

    <x-ui.section size="lg">
        <div class="gm-container">
            <div class="gm-page__header">
                <span class="gm-eyebrow">Legal</span>
                <h1 class="gm-page__title">Terms & Conditions</h1>
            </div>

            <div class="gm-prose gm-prose--narrow">
                @if($page && $page->body)
                    {!! $page->body !!}
                @else
                    <p>These terms govern your use of the GENTRY website and the purchase of products from it. By placing an order you agree to these terms.</p>

                    <h2>Orders</h2>
                    <p>All orders are subject to acceptance and stock availability. We reserve the right to decline or cancel an order where there is an error in pricing, availability or payment. If we cancel an order, we will refund any payment received.</p>

                    <h2>Pricing</h2>
                    <p>Prices are shown in the currency selected at checkout and include applicable taxes where required. Delivery charges are shown before you confirm your order.</p>

                    <h2>Delivery</h2>
                    <p>We aim to dispatch orders within one business day. Delivery estimates are indicative and not guaranteed. Risk passes to you on delivery.</p>

                    <h2>Returns</h2>
                    <p>Our returns policy forms part of these terms. Please review it before ordering.</p>

                    <h2>Intellectual property</h2>
                    <p>All content on this site — including text, images, logos and designs — is owned by or licensed to GENTRY and may not be reproduced without permission.</p>

                    <h2>Contact</h2>
                    <p>Questions about these terms? Email <a href="mailto:{{ optional(\App\Models\Information::first())->owner_email }}">{{ optional(\App\Models\Information::first())->owner_email }}</a>.</p>
                @endif
            </div>
        </div>
    </x-ui.section>
</main>
@endsection