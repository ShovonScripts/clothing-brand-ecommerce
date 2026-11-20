@props([
    'selected' => false,
    'removable' => false,
    'disabled' => false,
    'size' => 'md',
    'onSelect' => null,
    'onRemove' => null,
])

<?php
$classes = ['gm-chip', "gm-chip--{$size}"];
if ($selected) $classes[] = 'gm-chip--selected';
if ($disabled) $classes[] = 'gm-chip--disabled';
?>

@if($onSelect)
    <button
        type="button"
        class="{{ implode(' ', $classes) }}"
        @if($disabled) disabled @endif
        wire:click="{{ $onSelect }}"
        {{ $attributes->except(['class', 'disabled']) }}
    >
        {{ $slot }}
        @if($removable)
            <button
                type="button"
                class="gm-chip__remove"
                wire:click.stop="{{ $onRemove }}"
                aria-label="Remove"
            >
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        @endif
    </button>
@else
    <span class="{{ implode(' ', $classes) }}" {{ $attributes }}>
        {{ $slot }}
        @if($removable)
            <button
                type="button"
                class="gm-chip__remove"
                @if($onRemove) wire:click.stop="{{ $onRemove }}" @endif
                aria-label="Remove"
            >
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        @endif
    </span>
@endif