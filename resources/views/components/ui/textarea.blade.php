@props([
    'label' => null,
    'placeholder' => null,
    'error' => null,
    'help' => null,
    'disabled' => false,
    'readonly' => false,
    'size' => 'md',
    'rows' => 4,
    'id' => null,
    'name' => null,
    'value' => null,
    'required' => false,
])

<?php
$textareaId = $id ?? 'gm-textarea-' . uniqid();
$classes = ['gm-textarea', "gm-textarea--{$size}"];
if ($error) $classes[] = 'gm-textarea--error';
if ($disabled) $classes[] = 'gm-textarea--disabled';
if ($readonly) $classes[] = 'gm-textarea--readonly';
?>

<div {{ $attributes->merge(['class' => 'gm-form-field']) }}>
    @if($label)
        <label for="{{ $textareaId }}" class="gm-label">{{ $label }} @if($required)<span class="gm-label__required" aria-hidden="true">*</span>@endif</label>
    @endif

    <textarea
        id="{{ $textareaId }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        class="{{ implode(' ', $classes) }}"
        placeholder="{{ $placeholder }}"
        @if($disabled) disabled @endif
        @if($readonly) readonly @endif
        @if($error) aria-invalid="true" aria-describedby="{{ $textareaId }}-error" @endif
        {{ $attributes->except(['class', 'id', 'name', 'rows', 'placeholder', 'disabled', 'readonly']) }}
    >{{ old($name, $value) }}</textarea>

    @if($error)
        <p id="{{ $textareaId }}-error" class="gm-error-text" role="alert">{{ $error }}</p>
    @elseif($help)
        <p id="{{ $textareaId }}-help" class="gm-help-text">{{ $help }}</p>
    @endif
</div>