@props([
    'fields' => [],
    'columns' => 2,
])

<?php
$classes = ['gm-admin-form-row'];
if ($columns === 1) $classes[] = 'gm-admin-form-row--single';
elseif ($columns === 3) $classes[] = 'gm-admin-form-row--three';
elseif ($columns === 4) $classes[] = 'gm-admin-form-row--four';
$class = implode(' ', $classes);
?>

<div {{ $attributes->merge(['class' => $class]) }}>
    @foreach($fields as $field)
        @php
            $key = $field['key'] ?? '';
            $label = $field['label'] ?? ucfirst($key);
            $type = $field['type'] ?? 'text';
            $required = $field['required'] ?? false;
            $value = $field['value'] ?? old($key);
            $error = $field['error'] ?? $errors->first($key);
            $help = $field['help'] ?? null;
            $options = $field['options'] ?? [];
            $placeholder = $field['placeholder'] ?? '';
            $disabled = $field['disabled'] ?? false;
            $attributesStr = $field['attributes'] ?? [];
        @endphp

        <div class="gm-admin-form-row__field">
            <label for="{{ $key }}" class="gm-admin-form-row__label{{ $required ? ' gm-admin-form-row__label--required' : '' }}">
                {{ $label }}
            </label>

            @if($type === 'textarea')
                <textarea
                    id="{{ $key }}"
                    name="{{ $key }}"
                    class="gm-admin-form-row__textarea{{ $error ? ' gm-admin-form-row__textarea--error' : '' }}"
                    placeholder="{{ $placeholder }}"
                    @if($disabled) disabled @endif
                    {{ collect($attributesStr)->map(fn($v, $k) => "$k=\"$v\"")->implode(' ') }}
                >{{ $value }}</textarea>
            @elseif($type === 'select')
                <select
                    id="{{ $key }}"
                    name="{{ $key }}"
                    class="gm-admin-form-row__select{{ $error ? ' gm-admin-form-row__select--error' : '' }}"
                    @if($disabled) disabled @endif
                    {{ collect($attributesStr)->map(fn($v, $k) => "$k=\"$v\"")->implode(' ') }}
                >
                    @if($placeholder)
                        <option value="" disabled {{ is_null($value) ? 'selected' : '' }}>{{ $placeholder }}</option>
                    @endif
                    @foreach($options as $optKey => $optLabel)
                        <option value="{{ $optKey }}" {{ $value == $optKey ? 'selected' : '' }}>{{ $optLabel }}</option>
                    @endforeach
                </select>
            @elseif($type === 'checkbox')
                <div class="gm-checkbox">
                    <input
                        type="checkbox"
                        id="{{ $key }}"
                        name="{{ $key }}"
                        value="{{ $field['value'] ?? '1' }}"
                        class="gm-checkbox__input"
                        @if($value) checked @endif
                        @if($disabled) disabled @endif
                    >
                    <span class="gm-checkbox__box" aria-hidden="true"></span>
                    <label for="{{ $key }}" class="gm-checkbox__label">{{ $label }}</label>
                </div>
            @elseif($type === 'image')
                <div class="gm-admin-image-uploader">
                    <div class="gm-admin-image-uploader__dropzone {{ $value ? 'has-image' : '' }}" data-image-uploader>
                        <input
                            type="file"
                            name="{{ $key }}"
                            id="{{ $key }}"
                            accept="image/*"
                            class="gm-admin-image-uploader__input"
                            @if($disabled) disabled @endif
                        >
                        @if($value)
                            <img src="{{ $value }}" alt="" class="gm-admin-image-uploader__preview">
                            <button type="button" class="gm-admin-image-uploader__remove" aria-label="Remove image">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        @else
                            <div class="gm-admin-image-uploader__placeholder">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                <span>Click or drag to upload</span>
                            </div>
                        @endif
                    </div>
                    @if($help)
                        <p class="gm-admin-image-uploader__hint">{{ $help }}</p>
                    @endif
                </div>
            @else
                <input
                    type="{{ $type }}"
                    id="{{ $key }}"
                    name="{{ $key }}"
                    value="{{ $value }}"
                    class="gm-admin-form-row__input{{ $error ? ' gm-admin-form-row__input--error' : '' }}"
                    placeholder="{{ $placeholder }}"
                    @if($disabled) disabled @endif
                    @if($required) required @endif
                    {{ collect($attributesStr)->map(fn($v, $k) => "$k=\"$v\"")->implode(' ') }}
                >
            @endif

            @if($error)
                <p class="gm-admin-form-row__error">{{ $error }}</p>
            @elseif($help)
                <p class="gm-admin-form-row__help">{{ $help }}</p>
            @endif
        </div>
    @endforeach
</div>