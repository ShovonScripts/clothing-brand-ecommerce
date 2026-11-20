@props([
    'title' => null,
    'subtitle' => null,
    'action' => null,
    'actionUrl' => null,
    'count' => null,
    'centered' => false,
    'minimal' => false,
])

<?php
$classes = ['gm-section-header'];
if ($centered) $classes[] = 'gm-section-header--centered';
if ($minimal) $classes[] = 'gm-section-header--minimal';
$class = implode(' ', $classes);
?>

<div {{ $attributes->merge(['class' => $class]) }}>
    <div class="gm-section-header__content">
        @if($title)
            <h2 class="gm-section-header__title">{{ $title }}</h2>
        @endif

        @if($subtitle)
            <p class="gm-section-header__subtitle">{{ $subtitle }}</p>
        @endif

        @if($count !== null)
            <span class="gm-section-header__count">{{ $count }} items</span>
        @endif
    </div>

    @if($action && $actionUrl)
        <div class="gm-section-header__actions">
            <a href="{{ $actionUrl }}" class="gm-section-header__link gm-section-header__view-all">
                {{ $action }}
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </a>
        </div>
    @endif
</div>