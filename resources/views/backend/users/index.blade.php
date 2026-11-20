@extends('backend.app')

@section('content')
@php
$items = $items ?? new \Illuminate\Pagination\LengthAwarePaginator([], 0, 30);
$searchQuery = request('q', '');
$selectedRole = request('role');
$selectedStatus = request('status');
$roles = $roles ?? collect();
@endphp

<div class="gm-admin-page">
    {{-- Page Header --}}
    <x-admin.page-header
        title="Users"
        subtitle="Manage admin users and permissions"
        :count="$items->total()"
    >
        <x-slot name="breadcrumb">
            <x-admin.page-header-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Users'],
            ]" />
        </x-slot>

        <x-slot name="actions">
            @can('user.create')
                <a href="{{ route('admin.users.create') }}" class="gm-btn gm-btn--primary gm-btn--sm">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add User
                </a>
            @endcan
        </x-slot>
    </x-admin.page-header>

    {{-- Filter Bar --}}
    <x-admin.filter-bar
        :filters="[
            'role' => [
                'label' => 'Role',
                'type' => 'select',
                'options' => \$roles->map(fn(\$r) => ['value' => \$r->name, 'label' => ucfirst(\$r->name)])->prepend(['value' => '', 'label' => 'All Roles'])->toArray(),
            ],
            'status' => [
                'label' => 'Status',
                'type' => 'select',
                'options' => [
                    ['value' => '', 'label' => 'All'],
                    ['value' => '1', 'label' => 'Active'],
                    ['value' => '0', 'label' => 'Inactive'],
                ],
            ],
        ]"
        :search="$searchQuery"
        searchPlaceholder="Search by name, email, username..."
        :onFilterChange="true"
    />

    {{-- Users Table --}}
    <div class="gm-admin-table-wrapper" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;">
        @if($items->count())
            <x-admin.table
                :columns="[
                    ['key' => 'checkbox', 'label' => '', 'align' => 'center', 'width' => '40px', 'render' => 'renderCheckbox'],
                    ['key' => 'actions', 'label' => 'Action', 'align' => 'center', 'width' => '100px', 'render' => 'renderActions'],
                    ['key' => 'name', 'label' => 'Name', 'align' => 'left', 'render' => 'renderName'],
                    ['key' => 'email', 'label' => 'Email', 'align' => 'left'],
                    ['key' => 'username', 'label' => 'Username', 'align' => 'left'],
                    ['key' => 'business_name', 'label' => 'Business', 'align' => 'left'],
                    ['key' => 'roles', 'label' => 'Role', 'align' => 'center', 'width' => '120px', 'render' => 'renderRoles'],
                    ['key' => 'status', 'label' => 'Status', 'align' => 'center', 'width' => '100px', 'render' => 'renderStatus'],
                ]"
                :rows="$items"
                :actions="[
                    ['type' => 'edit', 'label' => 'Edit', 'icon' => '<svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7\"></path><path d=\"M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z\"></path></svg>', 'url' => fn(\$row) => route('admin.users.edit', \$row->id)],
                    ['type' => 'delete', 'label' => 'Delete', 'icon' => '<svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><polyline points=\"3 6 5 6 21 6\"></polyline><path d=\"M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2\"></path></svg>', 'url' => fn(\$row) => route('admin.users.destroy', \$row->id), 'attrs' => ['onclick' => 'return confirm(\"Are you sure?\")', 'class' => 'gm-admin-table__action-btn--delete']],
                ]"
                :emptyMessage="No users found"
                striped
                hover
            />
        @else
            <x-ui.empty-state
                type="default"
                title="No users found"
                message="Add your first admin user to get started."
                action="Add User"
                :actionUrl="route('admin.users.create')"
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
            window.location.href = '{{ route("admin.users.index") }}?' + params.toString();
        });

        // Clear filters
        document.addEventListener('clear-filters', function() {
            window.location.href = '{{ route("admin.users.index") }}';
        });

        // Pagination
        document.addEventListener('page-change', function(e) {
            const params = new URLSearchParams(window.location.search);
            params.set('page', e.detail.page);
            window.location.href = '{{ route("admin.users.index") }}?' + params.toString();
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
                if (window.toastr) toastr.warning('No users selected');
                return;
            }
            
            if (action === 'delete') {
                if (!confirm('Delete selected users?')) return;
            }
            
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            ids.forEach(id => formData.append('ids[]', id));
            formData.append('action', action);
            
            fetch('{{ route("admin.users.bulkAction") }}', { method: 'POST', body: formData, headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
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