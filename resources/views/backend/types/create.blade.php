@extends('backend.app')

@section('content')
<form method="POST" action="{{ route('admin.types.store') }}" class="gm-admin-form" enctype="multipart/form-data" novalidate>
    @csrf

    {{-- Save Bar --}}
    <x-admin.save-bar
        :dirty="$wire.dirty ?? false"
        :saving="$wire.saving ?? false"
        onSave="submit"
        onCancel="goBack"
        saveText="Save Brand"
        cancelText="Cancel"
    />

    <div class="gm-admin-form-layout" style="display: grid; grid-template-columns: 1fr 380px; gap: var(--s-8);">
        {{-- Main Form --}}
        <div class="gm-admin-form-main">
            <x-admin.form-row
                :fields="[
                    ['key' => 'name', 'label' => 'Brand Name', 'type' => 'text', 'required' => true, 'placeholder' => 'Enter brand name'],
                ]"
                :columns="1"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'description', 'label' => 'Description', 'type' => 'textarea', 'rows' => 4, 'placeholder' => 'Brand description...'],
                ]"
                :columns="1"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'is_top', 'label' => 'Top Brand', 'type' => 'checkbox', 'value' => '1'],
                    ['key' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'value' => '1', 'checked' => true],
                ]"
            />
        </div>

        {{-- Sidebar --}}
        <div class="gm-admin-form-sidebar">
            <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); position: sticky; top: calc(var(--header-h) + var(--s-4));">
                <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4); padding-bottom: var(--s-3); border-bottom: 1px solid var(--c-line);">Brand Logo</h3>

                <x-admin.image-uploader
                    name="image"
                    :label="'Brand Logo'"
                    :value="$mainImage ?? null"
                    help="Brand logo (recommended: 200x200px, transparent background)"
                />
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