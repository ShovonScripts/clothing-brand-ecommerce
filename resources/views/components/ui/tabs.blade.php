@props([
    'variant' => 'underline',
    'active' => 0,
    'onChange' => null,
])

<?php
$tabsId = 'gm-tabs-' . uniqid();
$tabs = [];
$panels = [];

$slotHtml = $slot->toHtml();
$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML('<div>' . $slotHtml . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
libxml_clear_errors();

$xpath = new DOMXPath($dom);
$tabItems = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' gm-tab ')]");
$panelItems = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' gm-tab-panel ')]");

foreach ($tabItems as $index => $tab) {
    $tabs[] = [
        'label' => trim($tab->textContent),
        'disabled' => $tab->hasAttribute('disabled'),
        'attributes' => [],
    ];
    foreach ($tab->attributes as $attr) {
        $tabs[$index]['attributes'][$attr->name] = $attr->value;
    }
}

foreach ($panelItems as $index => $panel) {
    $panels[] = [
        'content' => $dom->saveHTML($panel),
        'attributes' => [],
    ];
    foreach ($panel->attributes as $attr) {
        $panels[$index]['attributes'][$attr->name] = $attr->value;
    }
}
?>

<div {{ $attributes->merge(['class' => 'gm-tabs', 'data-gm-tabs' => '']) }}>
    <div
        class="gm-tabs__list {{ $variant === 'pill' ? 'gm-tabs__list--pill' : '' }}"
        role="tablist"
        aria-orientation="horizontal"
    >
        @foreach($tabs as $index => $tab)
            <button
                type="button"
                role="tab"
                id="{{ $tabsId }}-tab-{{ $index }}"
                class="gm-tabs__trigger{{ $index === $active ? ' gm-tabs__trigger--active' : '' }}{{ $tab['disabled'] ? ' gm-tabs__trigger--disabled' : '' }}"
                aria-selected="{{ $index === $active ? 'true' : 'false' }}"
                aria-controls="{{ $tabsId }}-panel-{{ $index }}"
                {{ $tab['disabled'] ? 'disabled' : '' }}
                @if($onChange) wire:click="$dispatch('tab-change', { index: {{ $index }} })" @endif
            >
                {{ $tab['label'] }}
            </button>
        @endforeach
    </div>

    @foreach($panels as $index => $panel)
        <div
            id="{{ $tabsId }}-panel-{{ $index }}"
            role="tabpanel"
            aria-labelledby="{{ $tabsId }}-tab-{{ $index }}"
            class="gm-tabs__panel"
            {{ $index === $active ? '' : 'hidden' }}
        >
            {!! $panel['content'] !!}
        </div>
    @endforeach
</div>

@push('scripts')
<script>
    (function() {
        const container = document.currentScript?.previousElementSibling;
        if (!container) return;

        const triggers = container.querySelectorAll('.gm-tabs__trigger');
        const panels = container.querySelectorAll('.gm-tabs__panel');

        triggers.forEach((trigger, index) => {
            trigger.addEventListener('click', () => {
                if (trigger.disabled) return;

                triggers.forEach(t => {
                    t.setAttribute('aria-selected', 'false');
                    t.classList.remove('gm-tabs__trigger--active');
                });
                panels.forEach(p => p.hidden = true);

                trigger.setAttribute('aria-selected', 'true');
                trigger.classList.add('gm-tabs__trigger--active');
                panels[index].hidden = false;
            });
        });
    })();
</script>
@endpush