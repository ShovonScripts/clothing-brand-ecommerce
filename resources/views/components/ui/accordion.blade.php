@props([
    'allowMultiple' => false,
    'borderless' => false,
])

{{--
    Usage:
        <x-ui.accordion allowMultiple>
            <x-ui.accordion-item open>
                <x-slot name="trigger">Question</x-slot>
                <x-slot name="content">Answer</x-slot>
            </x-ui.accordion-item>
        </x-ui.accordion>

    Items are native <details> elements, so they open and close without JS.
    resources/js/ui.js only adds "one open at a time" when allowMultiple is off.
--}}
<div {{ $attributes->merge(['class' => 'gm-accordion' . ($borderless ? ' gm-accordion--borderless' : '')]) }}
     data-gm-accordion
     data-gm-allow-multiple="{{ $allowMultiple ? 'true' : 'false' }}">
    {{ $slot }}
</div>
