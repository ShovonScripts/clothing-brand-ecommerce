@extends('backend.app')

@section('content')
@php
$currencySymbol = config('app.currency_symbol') ?? '৳';
$items = $items ?? new \Illuminate\Pagination\LengthAwarePaginator([], 0, 30);
$searchQuery = request('q', '');
$selectedStatus = request('status');
$selectedCourier = request('courier_id');
$selectedUser = request('assign_user_id');
$dateFrom = request('date_from');
$dateTo = request('date_to');
$orderStatuses = getOrderStatus() ?? [];
$couriers = $couriers ?? collect();
$assignUsers = $assignUsers ?? collect();
@endphp

<div class="gm-admin-page">
    {{-- Page Header --}}
    <x-admin.page-header
        title="Orders"
        subtitle="Manage and track customer orders"
        :count="$items->total()"
    >
        <x-slot name="breadcrumb">
            <x-admin.page-header-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Orders'],
            ]" />
        </x-slot>

        <x-slot name="actions">
            @can('order.create')
                <a href="{{ route('admin.orders.create') }}" class="gm-btn gm-btn--primary gm-btn--sm">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    New Order
                </a>
            @endcan
            <a href="{{ route('admin.orderExport') }}" class="gm-btn gm-btn--ghost gm-btn--sm">Export</a>
        </x-slot>
    </x-admin.page-header>

    {{-- Filter Bar --}}
    <x-admin.filter-bar
        :filters="[
            'status' => [
                'label' => 'Status',
                'type' => 'select',
                'options' => array_merge([['value' => '', 'label' => 'All Status']], collect($orderStatuses)->map(fn(\$v, \$k) => ['value' => \$k, 'label' => ucfirst(str_replace('_', ' ', \$k))])->toArray()),
            ],
            'courier_id' => [
                'label' => 'Courier',
                'type' => 'select',
                'options' => \$couriers->map(fn(\$c) => ['value' => \$c->id, 'label' => \$c->name])->prepend(['value' => '', 'label' => 'All Couriers'])->toArray(),
            ],
            'assign_user_id' => [
                'label' => 'Assigned To',
                'type' => 'select',
                'options' => \$assignUsers->map(fn(\$u) => ['value' => \$u->id, 'label' => \$u->name])->prepend(['value' => '', 'label' => 'All Users'])->toArray(),
            ],
            'date_from' => [
                'label' => 'From',
                'type' => 'date',
            ],
            'date_to' => [
                'label' => 'To',
                'type' => 'date',
            ],
        ]"
        :search="$searchQuery"
        searchPlaceholder="Search by invoice, customer, SKU..."
        :onFilterChange="true"
    />

    {{-- Orders Table --}}
    <div class="gm-admin-table-wrapper" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;">
        @if($items->count())
            <x-admin.table
                :columns="[
                    ['key' => 'checkbox', 'label' => '', 'align' => 'center', 'width' => '40px', 'render' => 'renderCheckbox'],
                    ['key' => 'actions', 'label' => 'Action', 'align' => 'center', 'width' => '120px', 'render' => 'renderActions'],
                    ['key' => 'invoice_no', 'label' => 'Invoice', 'align' => 'left', 'render' => 'renderInvoice'],
                    ['key' => 'created_at', 'label' => 'Date', 'align' => 'left', 'render' => 'renderDate'],
                    ['key' => 'customer', 'label' => 'Customer', 'align' => 'left', 'render' => 'renderCustomer'],
                    ['key' => 'skus', 'label' => 'SKUs', 'align' => 'left', 'render' => 'renderSkus'],
                    ['key' => 'status', 'label' => 'Status', 'align' => 'center', 'render' => 'renderStatus'],
                    ['key' => 'view', 'label' => 'View', 'align' => 'center', 'width' => '80px', 'render' => 'renderView'],
                    ['key' => 'assigned_user', 'label' => 'Assigned', 'align' => 'left', 'render' => 'renderAssigned'],
                    ['key' => 'courier', 'label' => 'Courier', 'align' => 'left', 'render' => 'renderCourier'],
                    ['key' => 'final_amount', 'label' => 'Amount', 'align' => 'right', 'render' => 'renderAmount'],
                ]"
                :rows="$items"
                :actions="[
                    ['type' => 'view', 'label' => 'View', 'icon' => '<svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M1 12s4-8 11-8 11 8 11-8\"></path><circle cx=\"12\" cy=\"12\" r=\"3\"></circle></svg>', 'url' => fn(\$row) => route('admin.orders.show', \$row->id)],
                    ['type' => 'edit', 'label' => 'Edit', 'icon' => '<svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7\"></path><path d=\"M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z\"></path></svg>', 'url' => fn(\$row) => route('admin.orders.edit', \$row->id)],
                    ['type' => 'print', 'label' => 'Print', 'icon' => '<svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><polyline points=\"6 9 6 2 18 2 18 9\"></polyline><path d=\"M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2\"></path><rect x=\"6\" y=\"14\" width=\"12\" height=\"8\"></rect></svg>', 'url' => fn(\$row) => route('admin.orders.print', \$row->id), 'attrs' => ['target' => '_blank']],
                ]"
                :emptyMessage="No orders found"
                striped
                hover
            />
        @else
            <x-ui.empty-state
                type="default"
                title="No orders found"
                message="Orders will appear here when customers place them."
                action="View Storefront"
                :actionUrl="route('front.home')"
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
            } else if (key === 'date_from' || key === 'date_to') {
                if (value) params.set(key, value);
                else params.delete(key);
            } else {
                if (value) params.set(key, value);
                else params.delete(key);
            }
            params.set('page', '1');
            window.location.href = '{{ route("admin.orders.index") }}?' + params.toString();
        });

        // Clear filters
        document.addEventListener('clear-filters', function() {
            window.location.href = '{{ route("admin.orders.index") }}';
        });

        // Pagination
        document.addEventListener('page-change', function(e) {
            const params = new URLSearchParams(window.location.search);
            params.set('page', e.detail.page);
            window.location.href = '{{ route("admin.orders.index") }}?' + params.toString();
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
                if (window.toastr) toastr.warning('No orders selected');
                return;
            }
            
            if (action === 'delete') {
                if (!confirm('Delete selected orders?')) return;
            }
            
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            ids.forEach(id => formData.append('ids[]', id));
            
            const url = action === 'delete' 
                ? '{{ route("admin.orders.bulkDelete") }}'
                : '{{ route("admin.orders.bulkUpdate") }}';
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