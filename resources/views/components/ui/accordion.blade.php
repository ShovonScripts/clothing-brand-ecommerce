@props([
    'allowMultiple' => false,
    'borderless' => false,
])

<?php
$accordionId = 'gm-accordion-' . uniqid();
$items = [];

$slotHtml = $slot->toHtml();
$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML('<div>' . $slotHtml . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
libxml_clear_errors();

$xpath = new DOMXPath($dom);
$itemElements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' gm-accordion-item ')]");

foreach ($itemElements as $index => $item) {
    $trigger = $xpath->query(".//*[contains(concat(' ', normalize-space(@class), ' '), ' gm-accordion-trigger ')]", $item)->item(0);
    $content = $xpath->query(".//*[contains(concat(' ', normalize-space(@class), ' '), ' gm-accordion-content ')]", $item)->item(0);
    $open = $item->hasAttribute('open');

    $items[] = [
        'trigger' => $trigger ? trim($trigger->textContent) : '',
        'content' => $content ? $dom->saveHTML($content) : '',
        'open' => $open,
    ];
}
?>

<div {{ $attributes->merge(['class' => 'gm-accordion' . ($borderless ? ' gm-accordion--borderless' : ''), 'data-gm-accordion' => '', 'data-gm-allow-multiple' => $allowMultiple ? 'true' : 'false']) }}>
    @foreach($items as $index => $item)
        <details class="gm-accordion__item" {{ $item['open'] ? 'open' : '' }} id="{{ $accordionId }}-item-{{ $index }}">
            <summary class="gm-accordion__trigger" aria-controls="{{ $accordionId }}-content-{{ $index }}">
                {{ $item['trigger'] }}
                <span class="gm-accordion__icon" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </summary>
            <div class="gm-accordion__content" id="{{ $accordionId }}-content-{{ $index }}" role="region">
                <div class="gm-accordion__content-inner">
                    {!! $item['content'] !!}
                </div>
            </div>
        </details>
    @endforeach
</div>

@push('scripts')
<script>
    (function() {
        const accordion = document.currentScript?.previousElementSibling;
        if (!accordion) return;

        const allowMultiple = accordion.dataset.gmAllowMultiple === 'true';
        const items = accordion.querySelectorAll('.gm-accordion__item');

        items.forEach(item => {
            const summary = item.querySelector('.gm-accordion__trigger');
            if (!summary) return;

            summary.addEventListener('click', (e) => {
                if (!allowMultiple) {
                    items.forEach(other => {
                        if (other !== item && other.open) {
                            other.removeAttribute('open');
                        }
                    });
                }
            });
        });
    })();
</script>
@endpush