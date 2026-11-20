@props([
    'id' => null,
    'open' => false,
    'size' => 'md',
    'title' => null,
    'closeable' => true,
    'onClose' => null,
])

<?php
$modalId = $id ?? 'gm-modal-' . uniqid();
$overlayId = $modalId . '-overlay';
$classes = ['gm-modal', "gm-modal--{$size}"];
if ($open) $classes[] = 'gm-modal--open';
?>

<div
    id="{{ $overlayId }}"
    class="gm-modal-overlay"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $modalId }}-title"
    {{ $attributes->merge(['wire:click.self' => '$dispatch("close-modal", { id: "'.$overlayId.'" })']) }}
>
    <div id="{{ $modalId }}" class="{{ implode(' ', $classes) }}">
        <div class="gm-modal__header">
            @if($title)
                <h2 id="{{ $modalId }}-title" class="gm-modal__title">{{ $title }}</h2>
            @endif
            @if($closeable)
                <button
                    type="button"
                    class="gm-modal__close"
                    @if($onClose) wire:click="{{ $onClose }}" @else wire:click="$dispatch('close-modal', { id: '{{ $overlayId }}' })" @endif
                    aria-label="Close"
                >
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            @endif
        </div>
        <div class="gm-modal__body">
            {{ $slot }}
        </div>
        @if($footer = $attributes->get('footer'))
            <div class="gm-modal__footer">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    (function() {
        const overlay = document.getElementById('{{ $overlayId }}');
        const modal = document.getElementById('{{ $modalId }}');
        if (!overlay || !modal) return;

        function close() {
            overlay.classList.add('gm-modal--closing');
            overlay.classList.remove('gm-modal--open');
            setTimeout(() => {
                overlay.classList.remove('gm-modal--closing');
                @if($onClose)
                    @this->dispatch('close-modal', ['id' => $overlayId])
                @endif
            }, 200);
        }

        function handleKeydown(e) {
            if (e.key === 'Escape') close();
        }

        @if($open)
            overlay.classList.add('gm-modal--open');
            document.addEventListener('keydown', handleKeydown);
            document.body.style.overflow = 'hidden';
        @endif

        window.addEventListener('gm:close-modal', function(e) {
            if (e.detail.id === '{{ $overlayId }}') close();
        });

        window.addEventListener('gm:open-modal', function(e) {
            if (e.detail.id === '{{ $overlayId }}') {
                overlay.classList.add('gm-modal--open');
                overlay.classList.remove('gm-modal--closing');
                document.addEventListener('keydown', handleKeydown);
                document.body.style.overflow = 'hidden';
            }
        });
    })();
</script>
@endpush