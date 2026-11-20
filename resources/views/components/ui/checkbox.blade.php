@props([
    'label' => null,
    'checked' => false,
    'disabled' => false,
    'id' => null,
    'name' => null,
    'value' => '1',
    'error' => false,
])

<?php
$checkboxId = $id ?? 'gm-checkbox-' . uniqid();
?>

<div {{ $attributes->merge(['class' => 'gm-checkbox']) }}>
    <input
        type="checkbox"
        id="{{ $checkboxId }}"
        name="{{ $name }}"
        value="{{ $value }}"
        class="gm-checkbox__input"
        @if($checked) checked @endif
        @if($disabled) disabled @endif
        @if($error) aria-invalid="true" @endif
        {{ $attributes->except(['class', 'id', 'name', 'value', 'checked', 'disabled']) }}
    />
    <span class="gm-checkbox__box" aria-hidden="true"></span>
    @if($label)
        <label for="{{ $checkboxId }}" class="gm-checkbox__label">{{ $label }}</label>
    @endif
</div>