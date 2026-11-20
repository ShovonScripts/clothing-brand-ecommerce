@extends('backend.app')

@section('content')
@php
$categories = $categories ?? collect();
$parentCategories = $categories->whereNull('parent_id');
@endphp

<form method="POST" action="{{ route('admin.categories.store') }}" class="gm-admin-form" enctype="multipart/form-data" novalidate>
    @csrf

    {{-- Save Bar --}}
    <x-admin.save-bar
        :dirty="$wire.dirty ?? false"
        :saving="$wire.saving ?? false"
        onSave="submit"
        onCancel="goBack"
        saveText="Save Category"
        cancelText="Cancel"
    />

    <div class="gm-admin-form-layout" style="display: grid; grid-template-columns: 1fr 380px; gap: var(--s-8);">
        {{-- Main Form --}}
        <div class="gm-admin-form-main">
            <x-admin.form-row
                :fields="[
                    ['key' => 'name', 'label' => 'Category Name', 'type' => 'text', 'required' => true, 'placeholder' => 'Enter category name'],
                    ['key' => 'url', 'label' => 'Slug', 'type' => 'text', 'required' => true, 'placeholder' => 'Auto-generated from name'],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'parent_id', 'label' => 'Parent Category', 'type' => 'select', 'options' => \$parentCategories->pluck('name', 'id')->prepend(['', 'No Parent (Root Category)'])->toArray()],
                ]"
                :columns="1"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'is_popular', 'label' => 'Popular Category', 'type' => 'checkbox', 'value' => '1'],
                    ['key' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'value' => '1'],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'description', 'label' => 'Description', 'type' => 'textarea', 'rows' => 4, 'placeholder' => 'Category description...'],
                ]"
                :columns="1"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'meta_title', 'label' => 'Meta Title', 'type' => 'text', 'placeholder' => 'SEO title'],
                    ['key' => 'meta_keywords', 'label' => 'Meta Keywords', 'type' => 'text', 'placeholder' => 'Comma separated keywords'],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'meta_description', 'label' => 'Meta Description', 'type' => 'textarea', 'rows' => 3, 'placeholder' => 'SEO description...'],
                ]"
                :columns="1"
            />
        </div>

        {{-- Sidebar --}}
        <div class="gm-admin-form-sidebar">
            <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); position: sticky; top: calc(var(--header-h) + var(--s-4));">
                <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4); padding-bottom: var(--s-3); border-bottom: 1px solid var(--c-line);">Category Image</h3>

                <x-admin.image-uploader
                    name="image"
                    :label="'Category Image'"
                    :value="$mainImage ?? null"
                    help="Category banner image (recommended: 800x400px)"
                />

                <hr style="margin: var(--s-4) 0; border-color: var(--c-line);">

                <h3 style="font-size: var(--t-sm); font-weight: 600; color: var(--c-ink-900); margin: 0 0 var(--s-3); text-transform: uppercase; letter-spacing: var(--ls-wide);">SEO</h3>

                <x-admin.form-row
                    :fields="[
                        ['key' => 'meta_title', 'label' => 'Meta Title', 'type' => 'text', 'placeholder' => 'Auto-generated if empty'],
                        ['key' => 'meta_keywords', 'label' => 'Meta Keywords', 'type' => 'text', 'placeholder' => 'Comma separated'],
                    ]"
                />

                <x-admin.form-row
                    :fields="[
                        ['key' => 'meta_description', 'label' => 'Meta Description', 'type' => 'textarea', 'rows' => 3, 'placeholder' => 'Auto-generated if empty'],
                    ]"
                    :columns="1"
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

        // Image upload handlers
        document.addEventListener('image-upload', function(e) {
            const { key, files } = e.detail;
            if (files && files[0]) {
                const formData = new FormData();
                formData.append('image', files[0]);
                formData.append('_token', '{{ csrf_token() }}');

                fetch('{{ route("admin.upload.image") }}', {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        console.log('Image uploaded:', data.path);
                    }
                });
            }
        });

        document.addEventListener('image-remove', function(e) {
            const { key, index } = e.detail;
            console.log('Remove image:', key, index);
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