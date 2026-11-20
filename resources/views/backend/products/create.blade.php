@extends('backend.app')

@section('content')
@php
$categories = $categories ?? collect();
$brands = $brands ?? collect();
$types = $types ?? collect();
$colors = $colors ?? collect();
$sizes = $sizes ?? collect();
$defaultCategory = old('category_id') ?? ($categories->first()?->id ?? '');
$defaultBrand = old('brand_id') ?? ($brands->first()?->id ?? '');
$defaultType = old('type') ?? ($types->first()?->id ?? '');
$defaultColor = old('color_id') ?? ($colors->first()?->id ?? '');
$defaultSize = old('size_id') ?? ($sizes->first()?->id ?? '');
@endphp

<form method="POST" action="{{ route('admin.products.store') }}" class="gm-admin-form" enctype="multipart/form-data" novalidate>
    @csrf

    {{-- Save Bar --}}
    <x-admin.save-bar
        :dirty="$wire.dirty ?? false"
        :saving="$wire.saving ?? false"
        onSave="submit"
        onCancel="goBack"
        saveText="Save Product"
        cancelText="Cancel"
    />

    <div class="gm-admin-form-layout" style="display: grid; grid-template-columns: 1fr 380px; gap: var(--s-8);">
        {{-- Main Form --}}
        <div class="gm-admin-form-main">
            <x-admin.form-row
                :fields="[
                    ['key' => 'name', 'label' => 'Product Name', 'type' => 'text', 'required' => true, 'placeholder' => 'Enter product name'],
                    ['key' => 'sku', 'label' => 'SKU', 'type' => 'text', 'placeholder' => 'Auto-generated if empty'],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'slug', 'label' => 'URL Slug', 'type' => 'text', 'placeholder' => 'Auto-generated from name'],
                    ['key' => 'type', 'label' => 'Product Type', 'type' => 'select', 'required' => true, 'options' => \$types->pluck('name', 'id')->prepend(['', 'Select Type'])->toArray()],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'category_id', 'label' => 'Category', 'type' => 'select', 'required' => true, 'options' => \$categories->pluck('name', 'id')->prepend(['', 'Select Category'])->toArray()],
                    ['key' => 'brand_id', 'label' => 'Brand', 'type' => 'select', 'options' => \$brands->pluck('name', 'id')->prepend(['', 'Select Brand'])->toArray()],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'purchase_price', 'label' => 'Purchase Price', 'type' => 'number', 'step' => '0.01', 'min' => '0', 'placeholder' => '0.00'],
                    ['key' => 'sell_price', 'label' => 'Sell Price', 'type' => 'number', 'step' => '0.01', 'min' => '0', 'required' => true, 'placeholder' => '0.00'],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'discount', 'label' => 'Discount (%)', 'type' => 'number', 'step' => '0.1', 'min' => '0', 'max' => '100', 'placeholder' => '0'],
                    ['key' => 'discount_type', 'label' => 'Discount Type', 'type' => 'select', 'options' => [['value' => 'percent', 'label' => 'Percentage'], ['value' => 'fixed', 'label' => 'Fixed Amount']]],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'description', 'label' => 'Description', 'type' => 'textarea', 'rows' => 6, 'placeholder' => 'Product description...'],
                ]"
                :columns="1"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'short_description', 'label' => 'Short Description', 'type' => 'textarea', 'rows' => 3, 'placeholder' => 'Brief summary for listings...'],
                    ['key' => 'meta_title', 'label' => 'Meta Title', 'type' => 'text', 'placeholder' => 'SEO title'],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'meta_description', 'label' => 'Meta Description', 'type' => 'textarea', 'rows' => 3, 'placeholder' => 'SEO description...'],
                    ['key' => 'meta_keywords', 'label' => 'Meta Keywords', 'type' => 'text', 'placeholder' => 'Comma separated keywords'],
                ]"
            />
        </div>

        {{-- Sidebar --}}
        <div class="gm-admin-form-sidebar">
            <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); position: sticky; top: calc(var(--header-h) + var(--s-4));">
                <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4); padding-bottom: var(--s-3); border-bottom: 1px solid var(--c-line);">Product Settings</h3>

                <x-admin.form-row
                    :fields="[
                        ['key' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'value' => '1'],
                        ['key' => 'is_featured', 'label' => 'Featured', 'type' => 'checkbox', 'value' => '1'],
                    ]"
                />

                <x-admin.form-row
                    :fields="[
                        ['key' => 'is_recommended', 'label' => 'Recommended', 'type' => 'checkbox', 'value' => '1'],
                        ['key' => 'is_free_shipping', 'label' => 'Free Shipping', 'type' => 'checkbox', 'value' => '1'],
                    ]"
                />

                <x-admin.form-row
                    :fields="[
                        ['key' => 'is_stock', 'label' => 'Track Stock', 'type' => 'checkbox', 'value' => '1'],
                        ['key' => 'stock', 'label' => 'Stock Quantity', 'type' => 'number', 'min' => '0', 'placeholder' => '0'],
                    ]"
                />

                <x-admin.form-row
                    :fields="[
                        ['key' => 'low_stock_threshold', 'label' => 'Low Stock Alert', 'type' => 'number', 'min' => '0', 'placeholder' => '5'],
                        ['key' => 'weight', 'label' => 'Weight (kg)', 'type' => 'number', 'step' => '0.01', 'min' => '0', 'placeholder' => '0'],
                    ]"
                />

                <x-admin.form-row
                    :fields="[
                        ['key' => 'color_id', 'label' => 'Default Color', 'type' => 'select', 'options' => \$colors->pluck('name', 'id')->prepend(['', 'Select Color'])->toArray()],
                        ['key' => 'size_id', 'label' => 'Default Size', 'type' => 'select', 'options' => \$sizes->pluck('title', 'id')->prepend(['', 'Select Size'])->toArray()],
                    ]"
                />

                <hr style="margin: var(--s-4) 0; border-color: var(--c-line);">

                <h4 style="font-size: var(--t-sm); font-weight: 600; color: var(--c-ink-900); margin: 0 0 var(--s-3); text-transform: uppercase; letter-spacing: var(--ls-wide);">Images</h4>

                <x-admin.image-uploader
                    name="image"
                    :label="'Main Image'"
                    :value="$mainImage ?? null"
                    help="Main product image (recommended: 800x800px)"
                />

                <x-admin.image-uploader
                    name="gallery_images[]"
                    :label="'Gallery Images'"
                    :value="$galleryImages ?? []"
                    multiple
                    help="Additional product images"
                />

                <hr style="margin: var(--s-4) 0; border-color: var(--c-line);">

                <h4 style="font-size: var(--t-sm); font-weight: 600; color: var(--c-ink-900); margin: 0 0 var(--s-3); text-transform: uppercase; letter-spacing: var(--ls-wide);">SEO</h4>

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
                        // Update the preview
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