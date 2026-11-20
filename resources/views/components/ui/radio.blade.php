@props([
    'label' => null,
    'checked' => false,
    'disabled' => false,
    'id' => null,
    'name' => null,
    'value' => null,
    'error' => false,
])

<?php
$radioId = $id ?? 'gm-radio-' . uniqid();
?>

<div {{ $attributes->merge(['class' => 'gm-radio']) }}>
    <input
        type="radio"
        id="{{ $radioId }}"
        name="{{ $name }}"
        value="{{ $value }}"
        class="gm-radio__input"
        @if($checked) checked @endif
        @if($disabled) disabled @endif
        @if($error) aria-invalid="true" @endif
        {{ $attributes->except(['class', 'id', 'name', 'value', 'checked', 'disabled']) }}
    />
    <span class="gm-radio__box" aria-hidden="true"></span>
    @if($label)
        <label for="{{ $radioId }}" class="gm-radio__label">{{ $label }}</label>
    @endif
</div>