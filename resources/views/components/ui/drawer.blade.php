@props([
    'id' => null,
    'open' => false,
    'position' => 'right',
    'title' => null,
    'closeable' => true,
])

<?php
$drawerId = $id ?? 'gm-drawer-' . uniqid();
$overlayId = $drawerId . '-overlay';
$classes = ['gm-drawer', "gm-drawer--{$position}"];
if ($open) $classes[] = 'gm-drawer--open';
?>

{{--
    Open with any element carrying data-gm-open="{{ drawer id }}", or by
    dispatching window event `gm:open-drawer` with detail.id = drawer or overlay id.
    Closes on the X button, an overlay click, Escape, or `gm:close-drawer`.
--}}
<div
    id="{{ $overlayId }}"
    class="gm-drawer-overlay @if($open) gm-drawer--open @endif"
    aria-hidden="true"
    data-gm-overlay-for="{{ $drawerId }}"
></div>

<aside
    id="{{ $drawerId }}"
    {{ $attributes->merge(['class' => implode(' ', $classes)]) }}
    role="dialog"
    aria-modal="true"
    @if($title) aria-labelledby="{{ $drawerId }}-title" @endif
    data-gm-drawer
>
    <div class="gm-drawer__header">
        @if($title)
            <h2 id="{{ $drawerId }}-title" class="gm-drawer__title">{{ $title }}</h2>
        @endif
        @if($closeable)
            <button type="button" class="gm-drawer__close" data-gm-close aria-label="Close">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        @endif
    </div>
    <div class="gm-drawer__body">
        {{ $slot }}
    </div>
    @isset($footer)
        <div class="gm-drawer__footer">
            {{ $footer }}
        </div>
    @endisset
</aside>
