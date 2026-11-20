@props([
    'label' => '',
    'value' => '',
    'icon' => null,
    'variant' => 'default',
    'trend' => null,
    'trendLabel' => null,
])

<?php
$classes = ['gm-stat-card', "gm-stat-card--{$variant}"];
$class = implode(' ', $classes);

$variantColors = [
    'default' => 'var(--c-ink-900)',
    'success' => 'var(--c-success)',
    'warn' => 'var(--c-warn)',
    'danger' => 'var(--c-danger)',
    'info' => 'var(--c-info)',
];
$iconColor = $variantColors[$variant] ?? $variantColors['default'];
?>

<div {{ $attributes->merge(['class' => $class]) }}>
    <div class="gm-stat-card__icon" style="width: 48px; height: 48px; border-radius: var(--r-md); background: {{ $iconColor }}15; display: flex; align-items: center; justify-content: center; color: {{ $iconColor }}; margin-bottom: var(--s-3);">
        {!! $icon !!}
    </div>
    <div class="gm-stat-card__value" style="font-size: var(--t-2xl); font-weight: 600; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1); line-height: 1;">{{ $value }}</div>
    <div class="gm-stat-card__label" style="font-size: var(--t-sm); color: var(--c-ink-500); margin: 0;">{{ $label }}</div>

    @if($trend !== null)
        <div class="gm-stat-card__trend" style="display: inline-flex; align-items: center; gap: var(--s-1); margin-top: var(--s-2); font-size: var(--t-xs); font-weight: 500; {{ $trend >= 0 ? 'color: var(--c-success);' : 'color: var(--c-danger);' }}">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                @if($trend >= 0)
                    <polyline points="23 6 13.5 15.5 8.5 10.5"></polyline>
                @else
                    <polyline points="1 18 10.5 8.5 15.5 13.5"></polyline>
                @endif
            </svg>
            <span>{{ abs($trend) }}%</span>
            @if($trendLabel)
                <span style="color: var(--c-ink-500);">{{ $trendLabel }}</span>
            @endif
        </div>
    @endif
</div>