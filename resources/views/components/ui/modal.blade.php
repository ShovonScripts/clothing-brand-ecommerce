@props([
    'id' => null,
    'open' => false,
    'size' => 'md',
    'title' => null,
    'closeable' => true,
])

<?php
$modalId = $id ?? 'gm-modal-' . uniqid();
$overlayId = $modalId . '-overlay';
$classes = ['gm-modal', "gm-modal--{$size}"];
?>

{{--
    Open with any element carrying data-gm-open="{{ modal id }}", or by
    dispatching window event `gm:open-modal` with detail.id = modal or overlay id.
    Closes on the X button, an overlay click, Escape, or `gm:close-modal`.
--}}
<div
    id="{{ $overlayId }}"
    class="gm-modal-overlay @if($open) gm-modal--open @endif"
    data-gm-modal="{{ $modalId }}"
    role="dialog"
    aria-modal="true"
    @if($title) aria-labelledby="{{ $modalId }}-title" @endif
>
    <div id="{{ $modalId }}" {{ $attributes->merge(['class' => implode(' ', $classes)]) }}>
        <div class="gm-modal__header">
            @if($title)
                <h2 id="{{ $modalId }}-title" class="gm-modal__title">{{ $title }}</h2>
            @endif
            @if($closeable)
                <button type="button" class="gm-modal__close" data-gm-close aria-label="Close">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            @endif
        </div>
        <div class="gm-modal__body">
            {{ $slot }}
        </div>
        @isset($footer)
            <div class="gm-modal__footer">
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>
