@extends('frontend.app')

@section('title', 'My Orders — GENTRY')

@section('content')
<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Dashboard', 'url' => route('front.dashboard.index')],
            ['label' => 'Orders'],
        ]"
    />

    <x-ui.section size="md">
        <div class="gm-dashboard-layout">
            @include('frontend.dashboard.partials.sidebar')

            {{-- Main Content --}}
            <div class="gm-dashboard-main">
                <div class="gm-dashboard-header" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: var(--s-3); margin-bottom: var(--s-6);">
                    <div>
                        <h1 style="font-size: var(--t-2xl); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);">My Orders</h1>
                        <p style="color: var(--c-ink-500); margin: 0;">Track and manage your orders</p>
                    </div>
                    <a href="{{ route('front.products.index') }}" class="gm-btn gm-btn--primary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Continue Shopping
                    </a>
                </div>

                {{-- Orders Table. UserOrderController@index passes $items (this customer's
                     orders, paginated); it does not filter by status or date. --}}
                @php $statusLabels = getOrderStatus(); @endphp
                <div class="gm-orders-table-wrapper" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;">
                    @if($items->count())
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="border-bottom: 1px solid var(--c-line);">
                                        <th style="padding: var(--s-3) var(--s-4); text-align: left; font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500);">Order</th>
                                        <th style="padding: var(--s-3) var(--s-4); text-align: left; font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500);">Date</th>
                                        <th style="padding: var(--s-3) var(--s-4); text-align: left; font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500);">Status</th>
                                        <th style="padding: var(--s-3) var(--s-4); text-align: left; font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500);">Items</th>
                                        <th style="padding: var(--s-3) var(--s-4); text-align: right; font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500);">Total</th>
                                        <th style="padding: var(--s-3) var(--s-4); text-align: right; font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500);">Payment</th>
                                        <th style="padding: var(--s-3) var(--s-4); text-align: right; font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500);"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $order)
                                        <tr style="border-bottom: 1px solid var(--c-line); transition: background var(--d-fast);">
                                            <td style="padding: var(--s-3) var(--s-4); font-weight: 500; color: var(--c-ink-900); font-family: var(--f-display);">#{{ $order->invoice_no }}</td>
                                            <td style="padding: var(--s-3) var(--s-4); color: var(--c-ink-700);">{{ $order->date ? \Illuminate\Support\Carbon::parse($order->date)->format('M j, Y') : '—' }}</td>
                                            <td style="padding: var(--s-3) var(--s-4);">
                                                <x-ui.badge variant="neutral">{{ $statusLabels[$order->status] ?? ucfirst(str_replace('_', ' ', (string) $order->status)) }}</x-ui.badge>
                                            </td>
                                            <td style="padding: var(--s-3) var(--s-4); color: var(--c-ink-700);">{{ $order->details->count() }}</td>
                                            <td style="padding: var(--s-3) var(--s-4); text-align: right; font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900);">{{ priceFormate($order->final_amount) }}</td>
                                            <td style="padding: var(--s-3) var(--s-4); text-align: right; color: var(--c-ink-700);">{{ $order->payment_status ? ucfirst(str_replace('_', ' ', $order->payment_status)) : '—' }}</td>
                                            <td style="padding: var(--s-3) var(--s-4); text-align: right;">
                                                <a href="{{ route('front.orders.show', [$order->id]) }}" class="gm-btn gm-btn--ghost gm-btn--sm">View Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($items->hasPages())
                            <nav class="gm-pagination-wrapper" aria-label="Order pages" style="padding: var(--s-4) var(--s-5); border-top: 1px solid var(--c-line);">
                                {!! $items->links() !!}
                            </nav>
                        @endif
                    @else
                        <x-ui.empty-state
                            type="orders"
                            title="No orders found"
                            message="You haven't placed any orders yet."
                            action="Start Shopping"
                            :actionUrl="route('front.products.index')"
                        />
                    @endif
                </div>
            </div>
        </div>
    </x-ui.section>
</main>

