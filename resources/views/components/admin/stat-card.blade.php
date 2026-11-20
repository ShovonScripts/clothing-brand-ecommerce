@props([
    'label' => '',
    'value' => '',
    'icon' => null,
    'variant' => 'default',
    'trend' => null,
    'trendLabel' => null,
])

<?php
$classes = ['gm-admin-stat-card', "gm-admin-stat-card--{$variant}"];
$class = implode(' ', $classes);
?>

<div {{ $attributes->merge(['class' => $class]) }}>
    @if($icon)
        <div class="gm-admin-stat-card__icon">{!! $icon !!}</div>
    @endif
    <div class="gm-admin-stat-card__value">{{ $value }}</div>
    <div class="gm-admin-stat-card__label">{{ $label }}</div>

    @if($trend !== null)
        <div class="gm-admin-stat-card__trend gm-admin-stat-card__trend--{{ $trend >= 0 ? 'up' : 'down' }}">
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