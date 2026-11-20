@extends('backend.app')

@section('content')
@php
$currencySymbol = config('app.currency_symbol') ?? '৳';
$stats = $stats ?? [
    'total_orders' => 0,
    'total_revenue' => 0,
    'pending_orders' => 0,
    'total_products' => 0,
    'low_stock_products' => 0,
    'total_customers' => 0,
];
$recentOrders = $recentOrders ?? collect();
$topProducts = $topProducts ?? collect();
@endphp

<div class="gm-admin-page">
    {{-- Page Header --}}
    <x-admin.page-header
        title="Dashboard"
        subtitle="Welcome back, {{ auth()->user()->first_name }}! Here's what's happening with your store."
    >
        <x-slot name="breadcrumb">
            <x-admin.page-header-breadcrumb :items="[
                ['label' => 'Dashboard'],
            ]" />
        </x-slot>

        <x-slot name="actions">
            @can('product.create')
                <a href="{{ route('admin.products.create') }}" class="gm-btn gm-btn--primary gm-btn--sm">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add Product
                </a>
            @endcan
            @can('order.create')
                <a href="{{ route('admin.orders.create') }}" class="gm-btn gm-btn--secondary gm-btn--sm">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    New Order
                </a>
            @endcan
        </x-slot>
    </x-admin.page-header>

    {{-- Stats Cards --}}
    <x-ui.grid :columns="4" :gap="4" :autoFit="true" :minWidth="220" style="margin-bottom: var(--s-6);">
        <x-admin.stat-card
            label="Total Orders"
            :value="$stats['total_orders']"
            variant="primary"
            :icon="'<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z\"></path><polyline points=\"3.27 6.96 12 12.01 20.73 6.96\"></polyline><line x1=\"12\" y1=\"22.08\" x2=\"12\" y2=\"12\"></line></svg>'"
        />

        <x-admin.stat-card
            label="Total Revenue"
            :value="'{{ $currencySymbol }} ' . number_format($stats['total_revenue'], 0)"
            variant="success"
            :icon="'<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><line x1=\"12\" y1=\"1\" x2=\"12\" y2=\"23\"></line><path d=\"M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6\"></path></svg>'"
        />

        <x-admin.stat-card
            label="Pending Orders"
            :value="$stats['pending_orders']"
            variant="warn"
            :icon="'<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><circle cx=\"12\" cy=\"12\" r=\"10\"></circle><polyline points=\"12 6 12 12 16 14\"></polyline></svg>'"
        />

        <x-admin.stat-card
            label="Products"
            :value="$stats['total_products']"
            variant="info"
            :icon="'<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z\"></path><polyline points=\"3.27 6.96 12 12.01 20.73 6.96\"></polyline><line x1=\"12\" y1=\"22.08\" x2=\"12\" y2=\"12\"></line></svg>'"
        />
    </x-ui.grid>

    {{-- Quick Actions --}}
    <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); margin-bottom: var(--s-6);">
        <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4);">Quick Actions</h3>
        <x-ui.grid :columns="4" :gap="3" :autoFit="true" :minWidth="180">
            @can('product.create')
                <a href="{{ route('admin.products.create') }}" class="gm-admin-quick-action" style="display: flex; flex-direction: column; align-items: center; gap: var(--s-2); padding: var(--s-5); background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); text-decoration: none; color: var(--c-ink-900); transition: all var(--d-fast) var(--e-out);">
                    <div style="width: 48px; height: 48px; border-radius: var(--r-md); background: var(--c-accent-bg); display: flex; align-items: center; justify-content: center; color: var(--c-accent);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    </div>
                    <span style="font-weight: 500; text-align: center;">Add Product</span>
                </a>
            @endcan

            @can('order.create')
                <a href="{{ route('admin.orders.create') }}" class="gm-admin-quick-action" style="display: flex; flex-direction: column; align-items: center; gap: var(--s-2); padding: var(--s-5); background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); text-decoration: none; color: var(--c-ink-900); transition: all var(--d-fast) var(--e-out);">
                    <div style="width: 48px; height: 48px; border-radius: var(--r-md); background: var(--c-info-bg); display: flex; align-items: center; justify-content: center; color: var(--c-info);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                    </div>
                    <span style="font-weight: 500; text-align: center;">New Order</span>
                </a>
            @endcan

            <a href="{{ route('admin.products.index') }}" class="gm-admin-quick-action" style="display: flex; flex-direction: column; align-items: center; gap: var(--s-2); padding: var(--s-5); background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); text-decoration: none; color: var(--c-ink-900); transition: all var(--d-fast) var(--e-out);">
                <div style="width: 48px; height: 48px; border-radius: var(--r-md); background: var(--c-warn-bg); display: flex; align-items: center; justify-content: center; color: var(--c-warn);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                </div>
                <span style="font-weight: 500; text-align: center;">All Products</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="gm-admin-quick-action" style="display: flex; flex-direction: column; align-items: center; gap: var(--s-2); padding: var(--s-5); background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); text-decoration: none; color: var(--c-ink-900); transition: all var(--d-fast) var(--e-out);">
                <div style="width: 48px; height: 48px; border-radius: var(--r-md); background: var(--c-success-bg); display: flex; align-items: center; justify-content: center; color: var(--c-success);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                </div>
                <span style="font-weight: 500; text-align: center;">All Orders</span>
            </a>
        </x-ui.grid>
    </div>

    {{-- Recent Orders & Top Products --}}
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--s-6);">
        {{-- Recent Orders --}}
        <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;">
            <div style="display: flex; align-items: center; justify-content: space-between; padding: var(--s-4) var(--s-5); border-bottom: 1px solid var(--c-line);">
                <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0;">Recent Orders</h3>
                <a href="{{ route('admin.orders.index') }}" class="gm-link gm-link--sm" style="color: var(--c-accent); font-size: var(--t-sm); font-weight: 500; text-transform: uppercase; letter-spacing: var(--ls-wide);">View All</a>
            </div>

            @if($recentOrders->count())
                <div style="overflow-x: auto;">
                    <table class="gm-admin-table gm-admin-table--hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Invoice</th>
                                <th>Customer</th>
                                <th style="width: 120px;">Date</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 100px; text-align: right;">Amount</th>
                                <th style="width: 60px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders->take(10) as $order)
                                <tr>
                                    <td style="font-weight: 500; font-family: var(--f-display);">#{{ $order->invoice_no }}</td>
                                    <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                    <td style="font-size: var(--t-sm); color: var(--c-ink-500);">{{ $order->created_at->format('M j, Y') }}</td>
                                    <td>
                                        <x-admin.status-pill :status="{{$order->status}}" size="sm" />
                                    </td>
                                    <td style="text-align: right; font-weight: 500; font-family: var(--f-display);">{{ $currencySymbol }} {{ number_format($order->final_amount ?? 0, 0) }}</td>
                                    <td style="text-align: right;">
                                        <a href="{{ route('admin.orders.show', [$order->id]) }}" class="gm-btn gm-btn--ghost gm-btn--xs">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="padding: var(--s-8); text-align: center;">
                    <x-ui.empty-state type="orders" variant="simple" title="No recent orders" message="Orders will appear here." action="View Orders" :actionUrl="route('admin.orders.index')" />
                </div>
            @endif
        </div>

        {{-- Top Products --}}
        <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;">
            <div style="display: flex; align-items: center; justify-content: space-between; padding: var(--s-4) var(--s-5); border-bottom: 1px solid var(--c-line);">
                <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0;">Top Selling Products</h3>
                <a href="{{ route('admin.products.index') }}" class="gm-link gm-link--sm" style="color: var(--c-accent); font-size: var(--t-sm); font-weight: 500; text-transform: uppercase; letter-spacing: var(--ls-wide);">View All</a>
            </div>

            @if($topProducts->count())
                <div style="overflow-x: auto;">
                    <table class="gm-admin-table gm-admin-table--hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th style="width: 100px;">Stock</th>
                                <th style="width: 120px;">Sold</th>
                                <th style="width: 120px;">Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topProducts->take(10) as $product)
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: var(--s-3);">
                                            @if($product->image)
                                                <img src="{{ getImage('products', $product->image) }}" alt="" style="width: 40px; height: 40px; object-fit: cover; border-radius: var(--r-sm);">
                                            @else
                                                <div style="width: 40px; height: 40px; border-radius: var(--r-sm); background: var(--c-bg-2);"></div>
                                            @endif
                                            <div>
                                                <div style="font-weight: 500; color: var(--c-ink-900); font-size: var(--t-sm);">{{ $product->name }}</div>
                                                <div style="font-size: var(--t-xs); color: var(--c-ink-500);">{{ $product->sku }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="font-size: var(--t-sm);">{{ $product->stock }}</td>
                                    <td style="font-size: var(--t-sm); font-weight: 500;">{{ $product->total_sold ?? 0 }}</td>
                                    <td style="font-size: var(--t-sm); font-weight: 500; font-family: var(--f-display); color: var(--c-accent);">{{ $currencySymbol }} {{ number_format($product->total_revenue ?? 0, 0) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="padding: var(--s-8); text-align: center;">
                    <x-ui.empty-state type="default" variant="simple" title="No product data" message="Sales data will appear here." />
                </div>
            @endif
        </div>
    </div>

    {{-- Low Stock Alert --}}
    @if(isset($lowStockProducts) && $lowStockProducts->count())
        <div style="background: var(--c-danger-bg); border: 1px solid var(--c-danger); border-radius: var(--r-lg); padding: var(--s-5); margin-top: var(--s-6);">
            <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: var(--s-4);">
                <div>
                    <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-danger); margin: 0 0 var(--s-1);">Low Stock Alert</h3>
                    <p style="color: var(--c-ink-700); margin: 0;">{{ $lowStockProducts->count() }} product{{ $lowStockProducts->count() !== 1 ? 's' : '' }} below threshold</p>
                </div>
                <a href="{{ route('admin.products.index') }}?stock=low" class="gm-btn gm-btn--danger gm-btn--sm">View All</a>
            </div>

            <div style="margin-top: var(--s-4); overflow-x: auto;">
                <table class="gm-admin-table gm-admin-table--hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th style="width: 100px;">Current Stock</th>
                            <th style="width: 120px;">Threshold</th>
                            <th style="width: 100px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lowStockProducts->take(10) as $product)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: var(--s-3);">
                                        @if($product->image)
                                            <img src="{{ getImage('products', $product->image) }}" alt="" style="width: 36px; height: 36px; object-fit: cover; border-radius: var(--r-sm);">
                                        @else
                                            <div style="width: 36px; height: 36px; border-radius: var(--r-sm); background: var(--c-bg-2);"></div>
                                        @endif
                                        <div>
                                            <div style="font-weight: 500; color: var(--c-ink-900); font-size: var(--t-sm);">{{ $product->name }}</div>
                                            <div style="font-size: var(--t-xs); color: var(--c-ink-500);">{{ $product->sku }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-weight: 500; font-family: var(--f-display); color: var(--c-danger);">{{ $product->stock }}</td>
                                <td style="font-size: var(--t-sm); color: var(--c-ink-500);">{{ $product->low_stock_threshold ?? 5 }}</td>
                                <td>
                                    <x-admin.status-pill :status="'out-of-stock'" size="sm" @if($product->stock > 0) :status="'low-stock'" @endif />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection