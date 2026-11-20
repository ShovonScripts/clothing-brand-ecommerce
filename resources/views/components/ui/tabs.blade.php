@props([
    'labels' => [],
    'active' => 0,
    'variant' => 'underline',
])

{{--
    Usage:
        <x-ui.tabs :labels="['Description', 'Reviews (3)']">
            <div data-gm-tab-panel> ... </div>
            <div data-gm-tab-panel> ... </div>
        </x-ui.tabs>

    One [data-gm-tab-panel] child per label, in the same order. Switching is
    handled by resources/js/ui.js; without JS every panel stays visible.
--}}
@php
    $tabsId = 'gm-tabs-' . uniqid();
@endphp

<div {{ $attributes->merge(['class' => 'gm-tabs']) }} id="{{ $tabsId }}" data-gm-tabs data-gm-active="{{ (int) $active }}">
    <div class="gm-tabs__list {{ $variant === 'pill' ? 'gm-tabs__list--pill' : '' }}" role="tablist" aria-orientation="horizontal">
        @foreach($labels as $index => $label)
            <button
                type="button"
                role="tab"
                id="{{ $tabsId }}-tab-{{ $index }}"
                class="gm-tabs__trigger {{ $index === (int) $active ? 'gm-tabs__trigger--active' : '' }}"
                aria-selected="{{ $index === (int) $active ? 'true' : 'false' }}"
                aria-controls="{{ $tabsId }}-panel-{{ $index }}"
                tabindex="{{ $index === (int) $active ? '0' : '-1' }}"
                data-gm-tab="{{ $index }}"
            >{{ $label }}</button>
        @endforeach
    </div>

    {{ $slot }}
</div>
