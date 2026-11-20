@props([
    'label' => null,
    'placeholder' => 'Select an option',
    'options' => [],
    'error' => null,
    'help' => null,
    'disabled' => false,
    'size' => 'md',
    'id' => null,
    'name' => null,
    'value' => null,
    'required' => false,
    'multiple' => false,
])

<?php
$selectId = $id ?? 'gm-select-' . uniqid();
$classes = ['gm-select', "gm-select--{$size}"];
if ($error) $classes[] = 'gm-select--error';
if ($disabled) $classes[] = 'gm-select--disabled';
?>

<div {{ $attributes->merge(['class' => 'gm-form-field']) }}>
    @if($label)
        <label for="{{ $selectId }}" class="gm-label">{{ $label }} @if($required)<span class="gm-label__required" aria-hidden="true">*</span>@endif</label>
    @endif

    <select
        id="{{ $selectId }}"
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        class="{{ implode(' ', $classes) }}"
        @if($disabled) disabled @endif
        @if($multiple) multiple @endif
        @if($error) aria-invalid="true" aria-describedby="{{ $selectId }}-error" @endif
        {{ $attributes->except(['class', 'id', 'name', 'disabled', 'multiple']) }}
    >
        @if($placeholder && !$multiple)
            <option value="" disabled {{ is_null(old($name, $value)) ? 'selected' : '' }}>{{ $placeholder }}</option>
        @endif
        @foreach($options as $key => $label)
            <option value="{{ $key }}" {{ (old($name, $value) == $key) ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>

    @if($error)
        <p id="{{ $selectId }}-error" class="gm-error-text" role="alert">{{ $error }}</p>
    @elseif($help)
        <p id="{{ $selectId }}-help" class="gm-help-text">{{ $help }}</p>
    @endif
</div>