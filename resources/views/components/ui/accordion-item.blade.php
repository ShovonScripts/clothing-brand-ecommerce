@props([
    'open' => false,
])

@php
    $itemId = 'gm-accordion-item-' . uniqid();
@endphp

<details {{ $attributes->merge(['class' => 'gm-accordion__item']) }} id="{{ $itemId }}" @if($open) open @endif>
    <summary class="gm-accordion__trigger" aria-controls="{{ $itemId }}-content">
        {{ $trigger ?? '' }}
        <span class="gm-accordion__icon" aria-hidden="true">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
        </span>
    </summary>
    <div class="gm-accordion__content" id="{{ $itemId }}-content" role="region">
        <div class="gm-accordion__content-inner">
            {{ $content ?? $slot }}
        </div>
    </div>
</details>
