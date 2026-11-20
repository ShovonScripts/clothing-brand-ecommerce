@extends('backend.app')

@section('content')
@php
$items = $items ?? new \Illuminate\Pagination\LengthAwarePaginator([], 0, 30);
$searchQuery = request('q', '');
$selectedParent = request('parent_id');
$selectedPopular = request('is_popular');
$categories = $categories ?? collect();
$parentCategories = $categories->whereNull('parent_id');
$currencySymbol = config('app.currency_symbol') ?? '৳';
@endphp

<div class="gm-admin-page">
    {{-- Page Header --}}
    <x-admin.page-header
        title="Categories"
        subtitle="Manage product categories and hierarchy"
        :count="$items->total()"
    >
        <x-slot name="breadcrumb">
            <x-admin.page-header-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Categories'],
            ]" />
        </x-slot>

        <x-slot name="actions">
            @can('category.create')
                <a href="{{ route('admin.categories.create') }}" class="gm-btn gm-btn--primary gm-btn--sm">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add Category
                </a>
            @endcan
        </x-slot>
    </x-admin.page-header>

    {{-- Filter Bar --}}
    <x-admin.filter-bar
        :filters="[
            'parent_id' => [
                'label' => 'Parent Category',
                'type' => 'select',
                'options' => \$parentCategories->map(fn(\$c) => ['value' => \$c->id, 'label' => \$c->name])->prepend(['value' => '', 'label' => 'All Categories'])->toArray(),
            ],
            'is_popular' => [
                'label' => 'Popular',
                'type' => 'select',
                'options' => [
                    ['value' => '', 'label' => 'All'],
                    ['value' => '1', 'label' => 'Popular'],
                    ['value' => '0', 'label' => 'Not Popular'],
                ],
            ],
        ]"
        :search="$searchQuery"
        searchPlaceholder="Search categories..."
        :onFilterChange="true"
    />

    {{-- Categories Table --}}
    <div class="gm-admin-table-wrapper" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;">
        @if($items->count())
            <x-admin.table
                :columns="[
                    ['key' => 'checkbox', 'label' => '', 'align' => 'center', 'width' => '40px', 'render' => 'renderCheckbox'],
                    ['key' => 'actions', 'label' => 'Action', 'align' => 'center', 'width' => '100px', 'render' => 'renderActions'],
                    ['key' => 'image', 'label' => 'Image', 'align' => 'center', 'width' => '60px', 'render' => 'renderImage'],
                    ['key' => 'name', 'label' => 'Name', 'align' => 'left', 'render' => 'renderName'],
                    ['key' => 'url', 'label' => 'Slug', 'align' => 'left'],
                    ['key' => 'parent', 'label' => 'Parent', 'align' => 'left', 'render' => 'renderParent'],
                    ['key' => 'is_popular', 'label' => 'Popular', 'align' => 'center', 'width' => '80px', 'render' => 'renderPopular'],
                    ['key' => 'products_count', 'label' => 'Products', 'align' => 'center', 'width' => '80px', 'render' => 'renderCount'],
                ]"
                :rows="$items"
                :actions="[
                    ['type' => 'edit', 'label' => 'Edit', 'icon' => '<svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7\"></path><path d=\"M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z\"></path></svg>', 'url' => fn(\$row) => route('admin.categories.edit', \$row->id)],
                    ['type' => 'delete', 'label' => 'Delete', 'icon' => '<svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><polyline points=\"3 6 5 6 21 6\"></polyline><path d=\"M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2\"></path></svg>', 'url' => fn(\$row) => route('admin.categories.destroy', \$row->id), 'attrs' => ['onclick' => 'return confirm(\"Are you sure?\")', 'class' => 'gm-admin-table__action-btn--delete']],
                ]"
                :emptyMessage="No categories found"
                striped
                hover
            />
        @else
            <x-ui.empty-state
                type="default"
                title="No categories yet"
                message="Create your first category to organize products."
                action="Add Category"
                :actionUrl="route('admin.categories.create')"
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
            window.location.href = '{{ route("admin.categories.index") }}?' + params.toString();
        });

        // Clear filters
        document.addEventListener('clear-filters', function() {
            window.location.href = '{{ route("admin.categories.index") }}';
        });

        // Pagination
        document.addEventListener('page-change', function(e) {
            const params = new URLSearchParams(window.location.search);
            params.set('page', e.detail.page);
            window.location.href = '{{ route("admin.categories.index") }}?' + params.toString();
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
                if (window.toastr) toastr.warning('No categories selected');
                return;
            }
            
            if (action === 'delete') {
                if (!confirm('Delete selected categories?')) return;
            }
            
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            ids.forEach(id => formData.append('ids[]', id));
            formData.append('action', action);
            
            fetch('{{ route("admin.categories.bulkAction") }}', { method: 'POST', body: formData, headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
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