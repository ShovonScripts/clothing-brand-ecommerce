@props([
    'variant' => 'neutral',
    'size' => 'md',
    'dot' => false,
    'removable' => false,
    'onRemove' => null,
])

<?php
$classes = ['gm-badge', "gm-badge--{$variant}", "gm-badge--{$size}"];
if ($dot) $classes[] = 'gm-badge--dot';
?>

<span {{ $attributes->merge(['class' => implode(' ', $classes), 'role' => 'status']) }}>
    {{ $slot }}
    @if($removable)
        <button
            type="button"
            class="gm-badge__remove"
            aria-label="Remove"
        >
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    @endif
</span>