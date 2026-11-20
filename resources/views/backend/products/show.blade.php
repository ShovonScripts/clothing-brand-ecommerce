@extends('backend.app')

@section('content')
@php
$product = $product ?? null;
$currencySymbol = config('app.currency_symbol') ?? '৳';
$statusVariants = [
    'active' => 'success',
    'inactive' => 'danger',
    'draft' => 'warn',
    'pending' => 'warn',
    'processing' => 'info',
    'on the way' => 'info',
    'on hold' => 'warn',
    'complete' => 'success',
    'delivered' => 'success',
    'cancelled' => 'danger',
    'in-stock' => 'success',
    'low-stock' => 'warn',
    'out-of-stock' => 'danger',
];
$status = $product->is_active ? 'active' : 'inactive';
$statusVariant = $statusVariants[$status] ?? 'default';
$stockStatus = $product->stock <= 0 ? 'out-of-stock' : ($product->stock <= ($product->low_stock_threshold ?? 5) ? 'low-stock' : 'in-stock');
$stockVariant = $statusVariants[$stockStatus] ?? 'default';
@endphp

<div class="gm-admin-page">
    {{-- Page Header --}}
    <x-admin.page-header
        title="{{ $product->name ?? 'Product Details' }}"
        subtitle="View product information"
    >
        <x-slot name="breadcrumb">
            <x-admin.page-header-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Products', 'url' => route('admin.products.index')],
                ['label' => $product->name ?? 'Details'],
            ]" />
        </x-slot>

        <x-slot name="actions">
            @can('product.edit')
                <a href="{{ route('admin.products.edit', [$product->id]) }}" class="gm-btn gm-btn--secondary gm-btn--sm">Edit</a>
            @endcan
            <a href="{{ route('admin.products.index') }}" class="gm-btn gm-btn--ghost gm-btn--sm">Back to List</a>
        </x-slot>
    </x-admin.page-header>

    <div style="display: grid; grid-template-columns: 1fr 380px; gap: var(--s-8);">
        {{-- Main Content --}}
        <div class="gm-admin-detail-main">
            {{-- Product Images --}}
            <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden; margin-bottom: var(--s-5);">
                <div style="display: grid; grid-template-columns: 300px 1fr; gap: 0; min-height: 300px;">
                    @if($product->image)
                        <div style="background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; padding: var(--s-6);">
                            <img src="{{ getImage('products', $product->image) }}" alt="{{ $product->name }}" style="max-width: 100%; max-height: 300px; object-fit: contain;">
                        </div>
                    @else
                        <div style="background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; padding: var(--s-6);">
                            <x-ui.skeleton variant="box" style="width: 100%; height: 300px;" />
                        </div>
                    @endif

                    <div style="padding: var(--s-5); overflow-y: auto; max-height: 300px;">
                        @if($product->gallery_images && $product->gallery_images->count())
                            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: var(--s-2);">
                                @foreach($product->gallery_images as $image)
                                    <div style="aspect-ratio: 1; border-radius: var(--r-md); overflow: hidden; background: var(--c-bg-2);">
                                        <img src="{{ getImage('products', $image) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Product Info Grid --}}
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: var(--s-4); margin-bottom: var(--s-5);">
                <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5);">
                    <h3 style="font-size: var(--t-sm); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500); margin: 0 0 var(--s-3);">Basic Information</h3>
                    <dl style="display: grid; grid-template-columns: auto 1fr; gap: var(--s-2) var(--s-4); margin: 0;">
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">SKU</dt>
                        <dd style="margin: 0; font-weight: 500; color: var(--c-ink-900);">{{ $product->sku }}</dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Type</dt>
                        <dd style="margin: 0; color: var(--c-ink-700);">{{ $product->type }}</dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Category</dt>
                        <dd style="margin: 0; color: var(--c-ink-700);">{{ $product->category->name ?? 'N/A' }}</dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Brand</dt>
                        <dd style="margin: 0; color: var(--c-ink-700);">{{ $product->brand->name ?? 'N/A' }}</dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Created</dt>
                        <dd style="margin: 0; color: var(--c-ink-700);">{{ $product->created_at->format('M j, Y g:i A') }}</dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Updated</dt>
                        <dd style="margin: 0; color: var(--c-ink-700);">{{ $product->updated_at->format('M j, Y g:i A') }}</dd>
                    </dl>
                </div>

                <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5);">
                    <h3 style="font-size: var(--t-sm); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500); margin: 0 0 var(--s-3);">Pricing</h3>
                    <dl style="display: grid; grid-template-columns: auto 1fr; gap: var(--s-2) var(--s-4); margin: 0;">
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Purchase Price</dt>
                        <dd style="margin: 0; font-weight: 500; color: var(--c-ink-900); font-family: var(--f-display);">{{ $currencySymbol }} {{ number_format($product->purchase_price, 2) }}</dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Sell Price</dt>
                        <dd style="margin: 0; font-weight: 500; color: var(--c-ink-900); font-family: var(--f-display);">{{ $currencySymbol }} {{ number_format($product->sell_price, 2) }}</dd>
                        @if($product->discount > 0)
                            <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Discount</dt>
                            <dd style="margin: 0; color: var(--c-success); font-weight: 500;">{{ $product->discount_type == 'percent' ? $product->discount . '%' : $currencySymbol . number_format($product->discount, 2) }} ({{ $product->discount_type }})</dd>
                            <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">After Discount</dt>
                            <dd style="margin: 0; font-weight: 600; color: var(--c-accent); font-family: var(--f-display);">{{ $currencySymbol }} {{ number_format($product->after_discount ?? ($product->sell_price - $product->discount_amount), 2) }}</dd>
                        @endif
                    </dl>
                </div>

                <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5);">
                    <h3 style="font-size: var(--t-sm); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500); margin: 0 0 var(--s-3);">Stock & Variants</h3>
                    <dl style="display: grid; grid-template-columns: auto 1fr; gap: var(--s-2) var(--s-4); margin: 0;">
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Stock Status</dt>
                        <dd style="margin: 0;">
                            <x-admin.status-pill :status="{{$stockStatus}}" />
                        </dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Quantity</dt>
                        <dd style="margin: 0; font-weight: 500; color: var(--c-ink-900); font-family: var(--f-display);">{{ $product->stock }}</dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Low Stock Alert</dt>
                        <dd style="margin: 0; color: var(--c-ink-700);">{{ $product->low_stock_threshold ?? 5 }}</dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Track Stock</dt>
                        <dd style="margin: 0;">{{ $product->is_stock ? 'Yes' : 'No' }}</dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Free Shipping</dt>
                        <dd style="margin: 0;">{{ $product->is_free_shipping ? 'Yes' : 'No' }}</dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Weight</dt>
                        <dd style="margin: 0; color: var(--c-ink-700);">{{ $product->weight }} kg</dd>
                    </dl>
                </div>

                <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5);">
                    <h3 style="font-size: var(--t-sm); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500); margin: 0 0 var(--s-3);">Status & Features</h3>
                    <dl style="display: grid; grid-template-columns: auto 1fr; gap: var(--s-2) var(--s-4); margin: 0;">
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Status</dt>
                        <dd style="margin: 0;">
                            <x-admin.status-pill :status="{{$status}}" />
                        </dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Featured</dt>
                        <dd style="margin: 0;">{{ $product->is_featured ? 'Yes' : 'No' }}</dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Recommended</dt>
                        <dd style="margin: 0;">{{ $product->is_recommended ? 'Yes' : 'No' }}</dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Free Shipping</dt>
                        <dd style="margin: 0;">{{ $product->is_free_shipping ? 'Yes' : 'No' }}</dd>
                    </dl>
                </div>

                <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5);">
                    <h3 style="font-size: var(--t-sm); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500); margin: 0 0 var(--s-3);">Default Variants</h3>
                    <dl style="display: grid; grid-template-columns: auto 1fr; gap: var(--s-2) var(--s-4); margin: 0;">
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Default Color</dt>
                        <dd style="margin: 0; color: var(--c-ink-700);">{{ $product->color->name ?? 'N/A' }}</dd>
                        <dt style="color: var(--c-ink-500); font-size: var(--t-sm);">Default Size</dt>
                        <dd style="margin: 0; color: var(--c-ink-700);">{{ $product->size->title ?? 'N/A' }}</dd>
                    </dl>
                </div>
            </div>

            {{-- Description --}}
            @if($product->description)
                <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); margin-bottom: var(--s-5);">
                    <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-3);">Description</h3>
                    <div class="gm-prose" style="font-size: var(--t-md); line-height: var(--lh-loose);">
                        {!! $product->description !!}
                    </div>
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="gm-admin-detail-sidebar">
            <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); position: sticky; top: calc(var(--header-h) + var(--s-4));">
                <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4); padding-bottom: var(--s-3); border-bottom: 1px solid var(--c-line);">Quick Actions</h3>

                <div style="display: flex; flex-direction: column; gap: var(--s-2);">
                    @can('product.edit')
                        <a href="{{ route('admin.products.edit', [$product->id]) }}" class="gm-btn gm-btn--secondary gm-btn--sm gm-btn--full">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            Edit Product
                        </a>
                    @endcan

                    <a href="{{ route('front.products.show', [$product->id]) }}" target="_blank" class="gm-btn gm-btn--ghost gm-btn--sm gm-btn--full">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                        View on Storefront
                    </a>

                    <hr style="margin: var(--s-2) 0; border-color: var(--c-line);">

                    <button type="button" class="gm-btn gm-btn--ghost gm-btn--sm gm-btn--full gm-btn--danger"
                            onclick="if(confirm('Delete this product?')) window.location.href='{{ route('admin.products.destroy', [$product->id]) }}'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        Delete Product
                    </button>
                </div>
            </div>

            {{-- Variation Count --}}
            @if($product->variations && $product->variations->count())
                <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); margin-top: var(--s-5);">
                    <h3 style="font-size: var(--t-sm); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500); margin: 0 0 var(--s-3);">Variations ({{ $product->variations->count() }})</h3>
                    <div style="display: flex; flex-direction: column; gap: var(--s-2);">
                        @foreach($product->variations->take(10) as $variation)
                            <div style="display: flex; align-items: center; justify-content: space-between; padding: var(--s-2); background: var(--c-bg-2); border-radius: var(--r-md);">
                                <div>
                                    <div style="font-weight: 500; color: var(--c-ink-900); font-size: var(--t-sm);">{{ $variation->size->title ?? $variation->color->name ?? 'Variant' }}</div>
                                    <div style="font-size: var(--t-xs); color: var(--c-ink-500);">Stock: {{ $variation->is_stock ?? 0 }}</div>
                                </div>
                                <a href="{{ route('admin.variations.edit', [$variation->id]) }}" class="gm-btn gm-btn--ghost gm-btn--sm gm-btn--xs">Edit</a>
                            </div>
                        @endforeach
                        @if($product->variations->count() > 10)
                            <a href="{{ route('admin.variations.index', ['product_id' => $product->id]) }}" class="gm-btn gm-btn--ghost gm-btn--sm gm-btn--full">View All</a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection