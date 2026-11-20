@extends('frontend.app')

@section('title', 'Order #' . $order->invoice_no . ' — GENTRY')

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

$statusVariants = [
    'pending' => 'warn',
    'processing' => 'info',
    'on the way' => 'info',
    'on hold' => 'warn',
    'complete' => 'success',
    'cancelled' => 'danger',
];
$statusVariant = $statusVariants[$order->status] ?? 'neutral';
@endphp

<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Dashboard', 'url' => route('front.dashboard.index')],
            ['label' => 'Orders', 'url' => route('front.orders.index')],
            ['label' => '#' . $order->invoice_no],
        ]"
    />

    <x-ui.section size="md">
        <div class="gm-dashboard-layout" style="display: grid; grid-template-columns: 280px 1fr; gap: var(--s-8);">
            {{-- Sidebar --}}
            <aside class="gm-dashboard-sidebar" style="position: sticky; top: calc(var(--header-h) + var(--s-4));">
                <div class="gm-dashboard-profile" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); margin-bottom: var(--s-4); text-align: center;">
                    <div class="gm-dashboard-avatar" style="width: 80px; height: 80px; border-radius: 50%; background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--s-3); color: var(--c-accent); font-size: var(--t-2xl); font-weight: 500; font-family: var(--f-display);">
                        {{ strtoupper(auth()->user()->first_name[0] ?? 'U') }}
                    </div>
                    <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>
                    <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: 0;">Member since {{ auth()->user()->created_at->format('F Y') }}</p>
                </div>

                <nav class="gm-dashboard-nav" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;" aria-label="Dashboard navigation">
                    <a href="{{ route('front.dashboard.index') }}" class="gm-dashboard-nav-item {{ request()->routeIs('front.dashboard.index') ? 'active' : '' }}" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); font-weight: 500; text-decoration: none; border-bottom: 1px solid var(--c-line); transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('front.orders.index') }}" class="gm-dashboard-nav-item {{ request()->routeIs('front.orders*') ? 'active' : '' }}" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); font-weight: 500; text-decoration: none; border-bottom: 1px solid var(--c-line); transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                        <span>Orders</span>
                    </a>
                    <a href="{{ route('front.wishlist.index') }}" class="gm-dashboard-nav-item {{ request()->routeIs('front.wishlist*') ? 'active' : '' }}" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); font-weight: 500; text-decoration: none; border-bottom: 1px solid var(--c-line); transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                        <span>Wishlist</span>
                    </a>
                    <a href="{{ route('front.account_details.index') }}" class="gm-dashboard-nav-item {{ request()->routeIs('front.account_details*') ? 'active' : '' }}" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); font-weight: 500; text-decoration: none; border-bottom: 1px solid var(--c-line); transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        <span>Account Details</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <button type="submit" form="logout-form" class="gm-dashboard-nav-item gm-dashboard-nav-item--logout" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-danger); font-size: var(--t-sm); font-weight: 500; background: none; border: none; width: 100%; text-align: left; cursor: pointer; transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span>Logout</span>
                    </button>
                </nav>
            </aside>

            {{-- Main Content --}}
            <div class="gm-dashboard-main">
                <div class="gm-dashboard-header" style="display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: var(--s-3); margin-bottom: var(--s-6);">
                    <div>
                        <h1 style="font-size: var(--t-2xl); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);">Order #{{ $order->invoice_no }}</h1>
                        <p style="color: var(--c-ink-500); margin: 0;">Placed on {{ $order->date->format('F j, Y') }}</p>
                    </div>
                    <div style="display: flex; align-items: center; gap: var(--s-3); flex-wrap: wrap;">
                        <x-ui.badge :variant="$statusVariant" size="lg">{{ ucfirst($order->status) }}</x-ui.badge>
                        <a href="{{ route('front.orders.index') }}" class="gm-btn gm-btn--ghost gm-btn--sm">Back to Orders</a>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 380px; gap: var(--s-6);">
                    {{-- Order Items --}}
                    <div class="gm-order-detail-items" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;">
                        <div class="gm-order-detail-header" style="padding: var(--s-4) var(--s-5); border-bottom: 1px solid var(--c-line);">
                            <h2 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0;">Order Items ({{ $order->details->count() }})</h2>
                        </div>

                        <div class="gm-order-detail-list">
                            @foreach($order->details as $item)
                                @php
                                    $lineTotal = $item->unit_price * $item->quantity;
                                @endphp
                                <div class="gm-order-detail-item" style="display: grid; grid-template-columns: 80px 1fr auto; gap: var(--s-4); align-items: center; padding: var(--s-4) var(--s-5); border-bottom: 1px solid var(--c-line);">
                                    <a href="{{ route('front.products.show', [$item->product->id ?? $item->product_id]) }}" class="gm-order-detail-image" style="width: 80px; aspect-ratio: 1; border-radius: var(--r-md); overflow: hidden; background: var(--c-bg-2);">
                                        @if($item->product->image ?? $item->image)
                                            <img src="{{ getImage('products', $item->product->image ?? $item->image) }}" alt="{{ $item->product->name ?? $item->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <div class="gm-skeleton gm-skeleton--box" aria-hidden="true"></div>
                                        @endif
                                    </a>

                                    <div class="gm-order-detail-info" style="min-width: 0;">
                                        <a href="{{ route('front.products.show', [$item->product->id ?? $item->product_id]) }}" class="gm-order-detail-link" style="text-decoration: none; color: inherit;">
                                            <h3 class="gm-order-detail-name" style="font-size: var(--t-md); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1); line-height: var(--lh-tight);">{{ $item->product->name ?? $item->name }}</h3>
                                        </a>
                                        @if($item->productsize ?? $item->size)
                                            <p class="gm-order-detail-variant" style="font-size: var(--t-sm); color: var(--c-ink-500); margin: 0;">{{ $item->productsize->title ?? $item->size }}</p>
                                        @endif
                                        <p class="gm-order-detail-qty" style="font-size: var(--t-sm); color: var(--c-ink-500); margin: var(--s-1) 0 0;">Qty: {{ $item->quantity }}</p>
                                    </div>

                                    <div class="gm-order-detail-price" style="text-align: right;">
                                        <p style="font-size: var(--t-md); font-weight: 600; font-family: var(--f-display); color: var(--c-ink-900); margin: 0;">{{ $currencySymbol }} {{ number_format($lineTotal, 2) }}</p>
                                        <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: var(--s-1) 0 0;">{{ $currencySymbol }} {{ number_format($item->unit_price, 2) }} each</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Order Summary --}}
                    <div class="gm-order-detail-summary">
                        <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); position: sticky; top: calc(var(--header-h) + var(--s-4));">
                            <h2 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4); padding-bottom: var(--s-4); border-bottom: 1px solid var(--c-line);">Order Summary</h2>

                            <div style="display: flex; flex-direction: column; gap: var(--s-3);">
                                <div style="display: flex; justify-content: space-between; color: var(--c-ink-700);">
                                    <span>Subtotal ({{ $order->details->count() }} items)</span>
                                    <span style="font-weight: 500; font-family: var(--f-display);">{{ $currencySymbol }} {{ number_format($order->amount ?? $order->details->sum(fn($i) => $i->unit_price * $i->quantity), 2) }}</span>
                                </div>

                                @if(($order->discount ?? 0) > 0)
                                    <div style="display: flex; justify-content: space-between; color: var(--c-success);">
                                        <span>Discount</span>
                                        <span style="font-weight: 500; font-family: var(--f-display);">-{{ $currencySymbol }} {{ number_format($order->discount, 2) }}</span>
                                    </div>
                                @endif

                                <div style="display: flex; justify-content: space-between; color: var(--c-ink-700);">
                                    <span>Shipping</span>
                                    <span style="font-weight: 500; font-family: var(--f-display);">{{ $currencySymbol }} {{ number_format($order->shipping_charge ?? 0, 2) }}</span>
                                </div>

                                @if(($order->tax ?? 0) > 0)
                                    <div style="display: flex; justify-content: space-between; color: var(--c-ink-700);">
                                        <span>Tax</span>
                                        <span style="font-weight: 500; font-family: var(--f-display);">{{ $currencySymbol }} {{ number_format($order->tax, 2) }}</span>
                                    </div>
                                @endif
                            </div>

                            <div style="margin-top: var(--s-3); padding-top: var(--s-3); border-top: 2px solid var(--c-line);">
                                <div style="display: flex; justify-content: space-between; font-size: var(--t-xl); font-weight: 600; font-family: var(--f-display); color: var(--c-ink-900);">
                                    <span>Total</span>
                                    <span>{{ $currencySymbol }} {{ number_format($order->final_amount, 2) }}</span>
                                </div>
                            </div>

                            <div style="margin-top: var(--s-5); padding-top: var(--s-4); border-top: 1px solid var(--c-line);">
                                <h3 style="font-size: var(--t-md); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-3);">Payment Method</h3>
                                <p style="color: var(--c-ink-700); margin: 0;">{{ ucfirst($order->payment_method ?? 'Cash on Delivery') }}</p>
                                @if($order->payment_method && $order->payment_method !== 'cash')
                                    <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: var(--s-1) 0 0;">Transaction: {{ $order->tnx_id ?? 'N/A' }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Shipping Address --}}
                <div style="margin-top: var(--s-6); display: grid; grid-template-columns: 1fr 1fr; gap: var(--s-6);">
                    <div class="gm-order-detail-section" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5);">
                        <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4); padding-bottom: var(--s-3); border-bottom: 1px solid var(--c-line);">Shipping Address</h3>
                        <address style="font-style: normal; color: var(--c-ink-700); line-height: var(--lh-loose);">
                            <p style="margin: 0 0 var(--s-1); font-weight: 500;">{{ $order->first_name }} {{ $order->last_name }}</p>
                            <p style="margin: 0 0 var(--s-1);">{{ $order->shipping_address }}</p>
                            <p style="margin: 0 0 var(--s-1);">{{ $order->mobile }}</p>
                            @if($order->email)
                                <p style="margin: 0;">{{ $order->email }}</p>
                            @endif
                        </address>
                    </div>

                    <div class="gm-order-detail-section" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5);">
                        <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4); padding-bottom: var(--s-3); border-bottom: 1px solid var(--c-line);">Order Timeline</h3>
                        <div class="gm-order-timeline" style="position: relative; padding-inline-start: var(--s-5);">
                            <div style="position: absolute; inset-inline-start: var(--s-1); top: 0; bottom: 0; width: 2px; background: var(--c-line);"></div>

                            <div class="gm-order-timeline-item" style="position: relative; padding-bottom: var(--s-5);">
                                <div style="position: absolute; inset-inline-start: -var(--s-5); top: 0; width: 12px; height: 12px; border-radius: 50%; background: var(--c-accent); border: 3px solid var(--c-bg); box-shadow: 0 0 0 2px var(--c-accent);"></div>
                                <div class="gm-order-timeline-content" style="color: var(--c-ink-700);">
                                    <p style="font-weight: 500; margin: 0 0 var(--s-1);">Order Placed</p>
                                    <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: 0;">{{ $order->date->format('F j, Y \a\t g:i A') }}</p>
                                </div>
                            </div>

                            @if(in_array($order->status, ['processing', 'on the way', 'on hold', 'complete']))
                                <div class="gm-order-timeline-item" style="position: relative; padding-bottom: var(--s-5);">
                                    <div style="position: absolute; inset-inline-start: -var(--s-5); top: 0; width: 12px; height: 12px; border-radius: 50%; background: var(--c-info); border: 3px solid var(--c-bg); box-shadow: 0 0 0 2px var(--c-info);"></div>
                                    <div class="gm-order-timeline-content" style="color: var(--c-ink-700);">
                                        <p style="font-weight: 500; margin: 0 0 var(--s-1);">Processing</p>
                                        <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: 0;">Your order is being prepared</p>
                                    </div>
                                </div>
                            @endif

                            @if(in_array($order->status, ['on the way', 'complete']))
                                <div class="gm-order-timeline-item" style="position: relative; padding-bottom: var(--s-5);">
                                    <div style="position: absolute; inset-inline-start: -var(--s-5); top: 0; width: 12px; height: 12px; border-radius: 50%; background: var(--c-warn); border: 3px solid var(--c-bg); box-shadow: 0 0 0 2px var(--c-warn);"></div>
                                    <div class="gm-order-timeline-content" style="color: var(--c-ink-700);">
                                        <p style="font-weight: 500; margin: 0 0 var(--s-1);">Shipped</p>
                                        <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: 0;">Your order is on the way</p>
                                    </div>
                                </div>
                            @endif

                            @if($order->status === 'complete')
                                <div class="gm-order-timeline-item" style="position: relative;">
                                    <div style="position: absolute; inset-inline-start: -var(--s-5); top: 0; width: 12px; height: 12px; border-radius: 50%; background: var(--c-success); border: 3px solid var(--c-bg); box-shadow: 0 0 0 2px var(--c-success);"></div>
                                    <div class="gm-order-timeline-content" style="color: var(--c-ink-700);">
                                        <p style="font-weight: 500; margin: 0 0 var(--s-1);">Delivered</p>
                                        <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: 0;">Order completed</p>
                                    </div>
                                </div>
                            @endif

                            @if($order->status === 'cancelled')
                                <div class="gm-order-timeline-item" style="position: relative;">
                                    <div style="position: absolute; inset-inline-start: -var(--s-5); top: 0; width: 12px; height: 12px; border-radius: 50%; background: var(--c-danger); border: 3px solid var(--c-bg); box-shadow: 0 0 0 2px var(--c-danger);"></div>
                                    <div class="gm-order-timeline-content" style="color: var(--c-ink-700);">
                                        <p style="font-weight: 500; margin: 0 0 var(--s-1);">Cancelled</p>
                                        <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: 0;">Order was cancelled</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Invoice Download --}}
                <div style="margin-top: var(--s-6); text-align: center;">
                    <a href="{{ route('front.orders.invoice', [$order->id]) }}" target="_blank" class="gm-btn gm-btn--ghost">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        Download Invoice
                    </a>
                </div>
            </div>
        </div>
    </x-ui.section>
</main>
@endsection