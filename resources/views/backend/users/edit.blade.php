@extends('backend.app')

@section('content')
@php
$roles = $roles ?? collect();
$permissions = $permissions ?? collect();
$user = $user ?? null;
$mainImage = $user->image ?? null;
$currentPermissions = $user->permissions ? $user->permissions->pluck('id')->toArray() : [];
@endphp

<form method="POST" action="{{ route('admin.users.update', [$user->id]) }}" class="gm-admin-form" enctype="multipart/form-data" novalidate>
    @csrf
    @method('PATCH')

    {{-- Save Bar --}}
    <x-admin.save-bar
        :dirty="$wire.dirty ?? false"
        :saving="$wire.saving ?? false"
        onSave="submit"
        onCancel="goBack"
        saveText="Update User"
        cancelText="Cancel"
    />

    <div class="gm-admin-form-layout" style="display: grid; grid-template-columns: 1fr 380px; gap: var(--s-8);">
        {{-- Main Form --}}
        <div class="gm-admin-form-main">
            <x-admin.form-row
                :fields="[
                    ['key' => 'first_name', 'label' => 'First Name', 'type' => 'text', 'required' => true, 'placeholder' => 'First name', 'value' => \$user->first_name],
                    ['key' => 'last_name', 'label' => 'Last Name', 'type' => 'text', 'required' => true, 'placeholder' => 'Last name', 'value' => \$user->last_name],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true, 'placeholder' => 'user@example.com', 'value' => \$user->email],
                    ['key' => 'username', 'label' => 'Username', 'type' => 'text', 'required' => true, 'placeholder' => 'username', 'value' => \$user->username],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'business_name', 'label' => 'Business Name', 'type' => 'text', 'placeholder' => 'Business name (optional)', 'value' => \$user->business_name],
                    ['key' => 'mobile', 'label' => 'Phone', 'type' => 'tel', 'placeholder' => '01XXXXXXXXX', 'value' => \$user->mobile],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'password', 'label' => 'New Password', 'type' => 'password', 'placeholder' => 'Leave blank to keep current', 'autocomplete' => 'new-password'],
                    ['key' => 'password_confirmation', 'label' => 'Confirm Password', 'type' => 'password', 'placeholder' => 'Re-enter password', 'autocomplete' => 'new-password'],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'role', 'label' => 'Role', 'type' => 'select', 'required' => true, 'options' => \$roles->pluck('name', 'id')->prepend(['', 'Select Role'])->toArray(), 'value' => \$user->roles->first()?->id],
                ]"
                :columns="1"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'permissions', 'label' => 'Permissions', 'type' => 'select', 'options' => \$permissions->pluck('name', 'id')->toArray(), 'attributes' => ['multiple' => 'multiple'], 'value' => \$currentPermissions],
                ]"
                :columns="1"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'status', 'label' => 'Active', 'type' => 'checkbox', 'value' => '1', 'checked' => \$user->status],
                    ['key' => 'email_verified', 'label' => 'Email Verified', 'type' => 'checkbox', 'value' => '1', 'checked' => \$user->email_verified_at],
                ]"
            />
        </div>

        {{-- Sidebar --}}
        <div class="gm-admin-form-sidebar">
            <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); position: sticky; top: calc(var(--header-h) + var(--s-4));">
                <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4); padding-bottom: var(--s-3); border-bottom: 1px solid var(--c-line);">User Settings</h3>

                <x-admin.form-row
                    :fields="[
                        ['key' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'value' => '1', 'checked' => \$user->is_active ?? true],
                        ['key' => 'email_verified', 'label' => 'Email Verified', 'type' => 'checkbox', 'value' => '1', 'checked' => \$user->email_verified_at],
                    ]"
                />

                <hr style="margin: var(--s-4) 0; border-color: var(--c-line);">

                <h3 style="font-size: var(--t-sm); font-weight: 600; color: var(--c-ink-900); margin: 0 0 var(--s-3); text-transform: uppercase; letter-spacing: var(--ls-wide);">Profile Image</h3>

                <x-admin.image-uploader
                    name="image"
                    :label="'Profile Image'"
                    :value="$mainImage"
                    help="User profile image (recommended: 200x200px)"
                />

                <hr style="margin: var(--s-4) 0; border-color: var(--c-line);">

                <h3 style="font-size: var(--t-sm); font-weight: 600; color: var(--c-ink-900); margin: 0 0 var(--s-3); text-transform: uppercase; letter-spacing: var(--ls-wide);">Permissions</h3>

                <div style="display: flex; flex-direction: column; gap: var(--s-2);">
                    @foreach($permissions->groupBy('group') as $group => $perms)
                        <div style="padding: var(--s-3); background: var(--c-bg-2); border-radius: var(--r-md);">
                            <h5 style="font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500); margin: 0 0 var(--s-2);">{{ ucfirst($group) }}</h5>
                            <div style="display: flex; flex-wrap: wrap; gap: var(--s-2);">
                                @foreach($perms as $perm)
                                    <label style="display: flex; align-items: center; gap: var(--s-1); font-size: var(--t-xs); color: var(--c-ink-700); cursor: pointer;">
                                        <input type="checkbox" name="permissions[]" value="{{ $perm->id }}" class="gm-checkbox__input" @if(in_array($perm->id, $currentPermissions)) checked @endif>
                                        <span class="gm-checkbox__box" aria-hidden="true"></span>
                                        <span class="gm-checkbox__label">{{ $perm->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.gm-admin-form');
        if (!form) return;

        let isDirty = false;
        const inputs = form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('change', () => { isDirty = true; });
            input.addEventListener('input', () => { isDirty = true; });
        });

        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('gm-btn--loading');
            }
        });

        // Go back handler
        window.goBack = function() {
            if (isDirty && !confirm('You have unsaved changes. Leave anyway?')) {
                return;
            }
            window.history.back();
        };
    });
</script>
@endpush