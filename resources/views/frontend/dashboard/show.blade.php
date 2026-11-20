@extends('frontend.app')

@php
    // Frontend\UserOrderController@show passes $item: one of this customer's orders.
    $order = $item;
    $placedAt = $order->created_at ?: ($order->date ? \Illuminate\Support\Carbon::parse($order->date) : null);
    $statusLabels = getOrderStatus();
    $status = (string) $order->status;
    // Real statuses (see getOrderStatus()): pending, processing, on_the_way, on_hold, complete, cancell
    $steps = [
        ['key' => 'placed', 'label' => 'Order placed', 'done' => true],
        ['key' => 'processing', 'label' => 'Processing', 'done' => in_array($status, ['processing', 'on_the_way', 'on_hold', 'complete'], true)],
        ['key' => 'on_the_way', 'label' => 'On the way', 'done' => in_array($status, ['on_the_way', 'complete'], true)],
        ['key' => 'complete', 'label' => 'Delivered', 'done' => $status === 'complete'],
    ];
    $payment = $order->payments->first();
    $details = $order->details()->with('product')->get();
@endphp

@section('title', 'Order #' . $order->invoice_no . ' — GENTRY')

@section('content')
<main class="main-wrapper">
    <x-ui.breadcrumb :items="[
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Orders', 'url' => route('front.orders.index')],
        ['label' => '#' . $order->invoice_no],
    ]" />

    <x-ui.section size="md">
        <div class="gm-dashboard-layout">
            @include('frontend.dashboard.partials.sidebar')

            <div class="gm-dashboard-main">
                <header class="gm-order-head">
                    <div>
                        <h1 class="gm-order-head__title">Order #{{ $order->invoice_no }}</h1>
                        @if($placedAt)
                            <p class="gm-order-head__meta">Placed on {{ $placedAt->format('F j, Y') }}</p>
                        @endif
                    </div>
                    <div class="gm-order-head__actions">
                        <x-ui.badge variant="neutral" size="lg">{{ $statusLabels[$status] ?? ucfirst(str_replace('_', ' ', $status)) }}</x-ui.badge>
                        <a href="{{ route('front.orders.index') }}" class="gm-btn gm-btn--ghost gm-btn--sm">Back to orders</a>
                    </div>
                </header>

                <div class="gm-order-grid">
                    <section class="gm-order-card" aria-labelledby="gm-order-items">
                        <h2 id="gm-order-items" class="gm-order-card__title">Items ({{ $details->count() }})</h2>
                        @foreach($details as $line)
                            @php $product = $line->product; @endphp
                            <div class="gm-order-line">
                                <a href="{{ $product ? route('front.products.show', [$product->id]) : '#' }}" class="gm-order-line__image">
                                    @if($product && $product->image)
                                        <img src="{{ getImage('products', $product->image) }}" alt="" width="80" height="80" loading="lazy">
                                    @endif
                                </a>
                                <div class="gm-order-line__info">
                                    <p class="gm-order-line__name">{{ $product->name ?? 'Product no longer available' }}</p>
                                    <p class="gm-order-line__meta">Qty: {{ $line->quantity }} · {{ priceFormate($line->unit_price) }} each</p>
                                </div>
                                <p class="gm-order-line__total">{{ priceFormate($line->unit_price * $line->quantity) }}</p>
                            </div>
                        @endforeach
                    </section>

                    <section class="gm-order-card" aria-labelledby="gm-order-summary">
                        <h2 id="gm-order-summary" class="gm-order-card__title">Summary</h2>
                        {{-- Stored by CheckoutController: amount − discount + shipping_charge = final_amount --}}
                        <dl class="gm-order-totals">
                            <div><dt>Subtotal</dt><dd>{{ priceFormate($order->amount) }}</dd></div>
                            @if($order->discount > 0)
                                <div><dt>Discount</dt><dd>−{{ priceFormate($order->discount) }}</dd></div>
                            @endif
                            <div><dt>Delivery</dt><dd>{{ $order->shipping_charge > 0 ? priceFormate($order->shipping_charge) : 'Free' }}</dd></div>
                            <div class="gm-order-totals__total"><dt>Total</dt><dd>{{ priceFormate($order->final_amount) }}</dd></div>
                        </dl>

                        <h3 class="gm-order-card__subtitle">Payment</h3>
                        <p class="gm-order-card__text">
                            {{ $payment ? ucfirst($payment->method) : 'Cash on delivery' }}
                            @if($order->payment_status)
                                · {{ ucfirst(str_replace('_', ' ', $order->payment_status)) }}
                            @endif
                        </p>
                        @if($payment && $payment->tnx_id)
                            <p class="gm-order-card__text gm-order-card__text--muted">Transaction: {{ $payment->tnx_id }}</p>
                        @endif
                    </section>
                </div>

                <div class="gm-order-grid gm-order-grid--even">
                    <section class="gm-order-card" aria-labelledby="gm-order-address">
                        <h2 id="gm-order-address" class="gm-order-card__title">Delivery address</h2>
                        <address class="gm-order-card__text" style="font-style: normal;">
                            <strong>{{ trim($order->first_name . ' ' . $order->last_name) }}</strong><br>
                            {{ $order->shipping_address }}<br>
                            {{ $order->mobile }}
                            @if($order->email)<br>{{ $order->email }}@endif
                        </address>
                    </section>

                    <section class="gm-order-card" aria-labelledby="gm-order-progress">
                        <h2 id="gm-order-progress" class="gm-order-card__title">Progress</h2>
                        @if($status === 'cancell')
                            <p class="gm-order-card__text">This order was cancelled.</p>
                        @else
                            <ol class="gm-order-steps">
                                @foreach($steps as $step)
                                    <li class="gm-order-steps__item {{ $step['done'] ? 'is-done' : '' }}">{{ $step['label'] }}</li>
                                @endforeach
                            </ol>
                            @if($status === 'on_hold')
                                <p class="gm-order-card__text gm-order-card__text--muted">This order is on hold. We'll be in touch.</p>
                            @endif
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </x-ui.section>
</main>
@endsection
