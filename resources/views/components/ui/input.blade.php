@props([
    'type' => 'text',
    'label' => null,
    'placeholder' => null,
    'error' => null,
    'help' => null,
    'icon' => null,
    'iconPosition' => 'left',
    'disabled' => false,
    'readonly' => false,
    'size' => 'md',
    'id' => null,
    'name' => null,
    'value' => null,
    'required' => false,
])

<?php
$inputId = $id ?? 'gm-input-' . uniqid();
$wrapperClasses = ['gm-input-wrapper'];
$inputClasses = ['gm-input', "gm-input--{$size}"];
if ($error) $inputClasses[] = 'gm-input--error';
if ($disabled) $inputClasses[] = 'gm-input--disabled';
if ($readonly) $inputClasses[] = 'gm-input--readonly';
if ($icon) {
    $wrapperClasses[] = 'gm-input-wrapper--with-icon';
    $inputClasses[] = $iconPosition === 'left' ? 'gm-input--with-icon-start' : 'gm-input--with-icon-end';
}
?>

<div {{ $attributes->merge(['class' => implode(' ', $wrapperClasses)]) }}>
    @if($label)
        <label for="{{ $inputId }}" class="gm-label">{{ $label }} @if($required)<span class="gm-label__required" aria-hidden="true">*</span>@endif</label>
    @endif

    @if($icon && $iconPosition === 'left')
        <span class="gm-input-icon gm-input-icon--start" aria-hidden="true">{{ $icon }}</span>
    @endif

    <input
        type="{{ $type }}"
        id="{{ $inputId }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        class="{{ implode(' ', $inputClasses) }}"
        placeholder="{{ $placeholder }}"
        @if($disabled) disabled @endif
        @if($readonly) readonly @endif
        @if($error) aria-invalid="true" aria-describedby="{{ $inputId }}-error" @endif
        {{ $attributes->except(['class', 'id', 'name', 'value', 'placeholder', 'disabled', 'readonly']) }}
    />

    @if($icon && $iconPosition === 'right')
        <span class="gm-input-icon gm-input-icon--end" aria-hidden="true">{{ $icon }}</span>
    @endif

    @if($error)
        <p id="{{ $inputId }}-error" class="gm-error-text" role="alert">{{ $error }}</p>
    @elseif($help)
        <p id="{{ $inputId }}-help" class="gm-help-text">{{ $help }}</p>
    @endif
</div>