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

                {{-- Filters --}}
                <div class="gm-orders-filters" style="display: flex; align-items: center; gap: var(--s-3); flex-wrap: wrap; margin-bottom: var(--s-5); padding: var(--s-4); background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg);">
                    <div style="display: flex; align-items: center; gap: var(--s-2); flex: 1; min-width: 200px;">
                        <label for="order-status-filter" class="gm-label" style="margin: 0; font-size: var(--t-sm);">Filter by status:</label>
                        <x-ui.select
                            id="order-status-filter"
                            name="status"
                            :value="request('status')"
                            :options="[
                                '' => 'All Status',
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'on the way' => 'On the Way',
                                'on hold' => 'On Hold',
                                'complete' => 'Complete',
                                'cancelled' => 'Cancelled',
                            ]"
                            wire:change="$dispatch('filter-change', { status: \$event.target.value })"
                        />
                    </div>

                    <div style="display: flex; align-items: center; gap: var(--s-2);">
                        <label for="order-date-from" class="gm-label" style="margin: 0; font-size: var(--t-sm);">From:</label>
                        <x-ui.input
                            id="order-date-from"
                            name="date_from"
                            type="date"
                            :value="request('date_from')"
                            size="sm"
                            wire:change="$dispatch('filter-change', { date_from: \$event.target.value })"
                        />
                        <label for="order-date-to" class="gm-label" style="margin: 0; font-size: var(--t-sm);">To:</label>
                        <x-ui.input
                            id="order-date-to"
                            name="date_to"
                            type="date"
                            :value="request('date_to')"
                            size="sm"
                            wire:change="$dispatch('filter-change', { date_to: \$event.target.value })"
                        />
                    </div>
                </div>

                {{-- Orders Table --}}
                <div class="gm-orders-table-wrapper" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;">
                    @if($orders->count())
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
                                    @foreach($orders as $order)
                                        <tr style="border-bottom: 1px solid var(--c-line); transition: background var(--d-fast);" wire:key="order-{{ $order->id }}">
                                            <td style="padding: var(--s-3) var(--s-4); font-weight: 500; color: var(--c-ink-900); font-family: var(--f-display);">#{{ $order->invoice_no }}</td>
                                            <td style="padding: var(--s-3) var(--s-4); color: var(--c-ink-700);">{{ $order->date->format('M j, Y') }}</td>
                                            <td style="padding: var(--s-3) var(--s-4);">
                                                <x-ui.badge :variant="$order->status_badge_variant ?? 'neutral'">{{ ucfirst($order->status) }}</x-ui.badge>
                                            </td>
                                            <td style="padding: var(--s-3) var(--s-4); color: var(--c-ink-700);">{{ $order->details->count() }}</td>
                                            <td style="padding: var(--s-3) var(--s-4); text-align: right; font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900);">{{ $currencySymbol }} {{ number_format($order->final_amount, 2) }}</td>
                                            <td style="padding: var(--s-3) var(--s-4); text-align: right; color: var(--c-ink-700);">{{ ucfirst($order->payment_method ?? 'Cash') }}</td>
                                            <td style="padding: var(--s-3) var(--s-4); text-align: right;">
                                                <a href="{{ route('front.orders.show', [$order->id]) }}" class="gm-btn gm-btn--ghost gm-btn--sm">View Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="gm-pagination-wrapper" style="padding: var(--s-4) var(--s-5); border-top: 1px solid var(--c-line);">
                            <x-ui.pagination
                                :currentPage="$orders->currentPage()"
                                :lastPage="$orders->lastPage()"
                                :total="$orders->total()"
                                :perPage="$orders->perPage()"
                                :onPageChange="true"
                            />
                        </div>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Status filter
        document.addEventListener('filter-change', function(e) {
            const params = new URLSearchParams(window.location.search);
            if (e.detail.status !== undefined) {
                if (e.detail.status) {
                    params.set('status', e.detail.status);
                } else {
                    params.delete('status');
                }
            }
            if (e.detail.date_from !== undefined) {
                if (e.detail.date_from) {
                    params.set('date_from', e.detail.date_from);
                } else {
                    params.delete('date_from');
                }
            }
            if (e.detail.date_to !== undefined) {
                if (e.detail.date_to) {
                    params.set('date_to', e.detail.date_to);
                } else {
                    params.delete('date_to');
                }
            }
            params.set('page', '1');
            window.location.href = '{{ route("front.orders.index") }}?' + params.toString();
        });

        // Pagination
        document.addEventListener('page-change', function(e) {
            const params = new URLSearchParams(window.location.search);
            params.set('page', e.detail.page);
            window.location.href = '{{ route("front.orders.index") }}?' + params.toString();
        });
    });
</script>
@endpush