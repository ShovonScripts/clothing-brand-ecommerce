@props([
    'name' => null,
    'label' => null,
    'options' => [],
    'selected' => null,
    'type' => 'radio',
    'colorKey' => 'color',
    'size' => 'md',
    'onChange' => null,
])

<?php
$groupId = $attributes->get('id') ?? 'gm-swatch-group-' . uniqid();
?>

<div {{ $attributes->merge(['class' => 'gm-variant-swatch-group', 'id' => $groupId]) }}>
    @if($label)
        <span class="gm-variant-swatch-group__label">{{ $label }}</span>
    @endif

    <div class="gm-variant-swatch-group__swatches" role="radiogroup" aria-label="{{ $label }}">
        @foreach($options as $option)
            @php
                $value = $option['value'] ?? $option;
                $labelText = $option['label'] ?? $value;
                $color = $option[$colorKey] ?? null;
                $disabled = $option['disabled'] ?? false;
                $isSelected = $selected == $value;
            @endphp

            @if($type === 'radio')
                <x-ui.variant-swatch
                    :name="$name"
                    :value="$value"
                    :label="$labelText"
                    :selected="$isSelected"
                    :disabled="$disabled"
                    :color="$color"
                    :size="$size"
                    :onSelect="$onChange"
                    id="{{$groupId}}-{{$value}}"
                />
            @else
                <x-ui.chip
                    :selected="$isSelected"
                    :disabled="$disabled"
                    :size="$size"
                    :onSelect="$onChange"
                    wire:click="$dispatch('chip-select', { name: '{{ $name }}', value: '{{ $value }}' })"
                >
                    {{ $labelText }}
                </x-ui.chip>
            @endif
        @endforeach
    </div>

    @if($selected && $onChange)
        <span class="gm-variant-swatch-group__selected-value">
            Selected: {{ collect($options)->firstWhere('value', $selected)['label'] ?? $selected }}
        </span>
    @endif
</div>