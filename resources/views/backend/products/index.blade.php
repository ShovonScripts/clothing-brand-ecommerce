@extends('backend.app')

@section('content')
@php
$currencySymbol = config('app.currency_symbol') ?? '৳';
$items = $items ?? new \Illuminate\Pagination\LengthAwarePaginator([], 0, 30);
$searchQuery = request('q', '');
$selectedCategory = request('category_id');
$selectedBrand = request('brand_id');
$selectedStatus = request('status');
@endphp

<div class="gm-admin-page">
    {{-- Page Header --}}
    <x-admin.page-header
        title="Products"
        subtitle="Manage your product catalog"
        :count="$items->total()"
    >
        <x-slot name="breadcrumb">
            <x-admin.page-header-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Products'],
            ]" />
        </x-slot>

        <x-slot name="actions">
            @can('product.create')
                <x-ui.button variant="primary" size="sm" href="{{ route('admin.products.create') }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add Product
                </x-ui.button>
            @endcan
            <a href="{{ route('admin.productExport') }}" class="gm-btn gm-btn--ghost gm-btn--sm">Export</a>
        </x-slot>
    </x-admin.page-header>

    {{-- Filter Bar --}}
    <x-admin.filter-bar
        :filters="[
            'category_id' => [
                'label' => 'Category',
                'type' => 'select',
                'options' => \$categories->map(fn(\$c) => ['value' => \$c->id, 'label' => \$c->name])->prepend(['value' => '', 'label' => 'All Categories'])->toArray(),
            ],
            'brand_id' => [
                'label' => 'Brand',
                'type' => 'select',
                'options' => \$brands->map(fn(\$b) => ['value' => \$b->id, 'label' => \$b->name])->prepend(['value' => '', 'label' => 'All Brands'])->toArray(),
            ],
            'status' => [
                'label' => 'Status',
                'type' => 'select',
                'options' => [
                    ['value' => '', 'label' => 'All Status'],
                    ['value' => 'active', 'label' => 'Active'],
                    ['value' => 'inactive', 'label' => 'Inactive'],
                    ['value' => 'draft', 'label' => 'Draft'],
                ],
            ],
        ]"
        :search="$searchQuery"
        searchPlaceholder="Search products..."
        :onFilterChange="true"
    />

    {{-- Product Table --}}
    <div class="gm-admin-table-wrapper" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;">
        @if($items->count())
            <x-admin.table
                :columns="[
                    ['key' => 'actions', 'label' => 'Action', 'align' => 'center', 'width' => '70px', 'render' => 'renderActions'],
                    ['key' => 'checkbox', 'label' => '', 'align' => 'center', 'width' => '40px', 'render' => 'renderCheckbox'],
                    ['key' => 'image', 'label' => 'Image', 'align' => 'center', 'width' => '80px', 'render' => 'renderImage'],
                    ['key' => 'name', 'label' => 'Product', 'align' => 'left', 'render' => 'renderName'],
                    ['key' => 'sku', 'label' => 'SKU', 'align' => 'left'],
                    ['key' => 'type', 'label' => 'Type', 'align' => 'center', 'render' => 'renderType'],
                    ['key' => 'category', 'label' => 'Category', 'align' => 'left'],
                    ['key' => 'brand', 'label' => 'Brand', 'align' => 'left'],
                    ['key' => 'purchase_price', 'label' => 'Cost', 'align' => 'right', 'render' => 'renderCost'],
                    ['key' => 'sell_price', 'label' => 'Price', 'align' => 'right', 'render' => 'renderPrice'],
                    ['key' => 'stock', 'label' => 'Stock', 'align' => 'center', 'render' => 'renderStock'],
                    ['key' => 'recommended', 'label' => 'Recommended', 'align' => 'center', 'render' => 'renderRecommended'],
                ]"
                :rows="$items"
                :actions="[
                    ['type' => 'view', 'label' => 'View', 'icon' => '<svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M1 12s4-8 11-8 11 8 11-8\"></path><circle cx=\"12\" cy=\"12\" r=\"3\"></circle></svg>', 'url' => fn(\$row) => route('admin.products.show', \$row->id)],
                    ['type' => 'edit', 'label' => 'Edit', 'icon' => '<svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7\"></path><path d=\"M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z\"></path></svg>', 'url' => fn(\$row) => route('admin.products.edit', \$row->id)],
                    ['type' => 'delete', 'label' => 'Delete', 'icon' => '<svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><polyline points=\"3 6 5 6 21 6\"></polyline><path d=\"M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2\"></path></svg>', 'url' => fn(\$row) => route('admin.products.destroy', \$row->id), 'attrs' => ['onclick' => 'return confirm(\"Are you sure?\")', 'class' => 'gm-admin-table__action-btn--delete']],
                ]"
                :emptyMessage="No products found"
                striped
                hover
            />
        @else
            <x-ui.empty-state
                type="search"
                title="No products found"
                message="Get started by adding your first product."
                action="Add Product"
                :actionUrl="route('admin.products.create')"
            />
        @endif
    </div>

    {{-- Pagination --}}
    @if($items->count())
        <div class="gm-pagination-wrapper" style="margin-top: var(--s-5);">
            <x-ui.pagination
                :currentPage="$items->currentPage()"
                :lastPage="$items->lastPage()"
                :total="$items->total()"
                :perPage="$items->perPage()"
                :onPageChange="true"
            />
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search form submission
        const searchForm = document.querySelector('form[action*="products"]');
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const params = new URLSearchParams();
                for (const [key, value] of formData.entries()) {
                    if (value) params.set(key, value);
                }
                window.location.href = '{{ route("admin.products.index") }}?' + params.toString();
            });
        }

        // Filter change handler
        document.addEventListener('filter-change', function(e) {
            const params = new URLSearchParams(window.location.search);
            const key = e.detail.key;
            const value = e.detail.value;
            
            if (key === 'search') {
                if (value) params.set('q', value);
                else params.delete('q');
            } else {
                if (value) params.set(key, value);
                else params.delete(key);
            }
            params.set('page', '1');
            window.location.href = '{{ route("admin.products.index") }}?' + params.toString();
        });

        // Clear filters
        document.addEventListener('clear-filters', function() {
            window.location.href = '{{ route("admin.products.index") }}';
        });

        // Pagination
        document.addEventListener('page-change', function(e) {
            const params = new URLSearchParams(window.location.search);
            params.set('page', e.detail.page);
            window.location.href = '{{ route("admin.products.index") }}?' + params.toString();
        });

        // Checkbox handling
        document.addEventListener('change', function(e) {
            if (e.target.matches('.check_all')) {
                const checkboxes = document.querySelectorAll('input[name="ids[]"]');
                checkboxes.forEach(cb => cb.checked = e.target.checked);
            }
        });

        // Bulk actions
        document.addEventListener('bulk-action', function(e) {
            const action = e.detail.action;
            const ids = Array.from(document.querySelectorAll('input[name="ids[]"]:checked')).map(cb => cb.value);
            
            if (!ids.length) {
                if (window.toastr) toastr.warning('No items selected');
                return;
            }
            
            if (action === 'delete') {
                if (!confirm('Delete selected items?')) return;
            }
            
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            ids.forEach(id => formData.append('ids[]', id));
            
            const url = action === 'delete' 
                ? '{{ route("admin.products.bulkDelete") }}'
                : '{{ route("admin.products.bulkUpdate") }}';
            formData.append('action', action);
            
            fetch(url, { method: 'POST', body: formData, headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (window.toastr) toastr.success(data.msg);
                    window.location.reload();
                } else {
                    if (window.toastr) toastr.error(data.msg || 'Failed');
                }
            });
        });
    });
</script>
@endpush