@props([
    'id' => null,
    'open' => false,
    'position' => 'right',
    'title' => null,
    'closeable' => true,
    'onClose' => null,
])

<?php
$drawerId = $id ?? 'gm-drawer-' . uniqid();
$overlayId = $drawerId . '-overlay';
$classes = ['gm-drawer', "gm-drawer--{$position}"];
if ($open) $classes[] = 'gm-drawer--open';
?>

<div
    id="{{ $overlayId }}"
    class="gm-drawer-overlay"
    aria-hidden="true"
    {{ $attributes->merge(['wire:click.self' => '$dispatch("close-drawer", { id: "'.$overlayId.'" })']) }}
></div>

<aside
    id="{{ $drawerId }}"
    class="{{ implode(' ', $classes) }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $drawerId }}-title"
>
    <div class="gm-drawer__header">
        @if($title)
            <h2 id="{{ $drawerId }}-title" class="gm-drawer__title">{{ $title }}</h2>
        @endif
        @if($closeable)
            <button
                type="button"
                class="gm-drawer__close"
                @if($onClose) wire:click="{{ $onClose }}" @else wire:click="$dispatch('close-drawer', { id: '{{ $overlayId }}' })" @endif
                aria-label="Close"
            >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        @endif
    </div>
    <div class="gm-drawer__body">
        {{ $slot }}
    </div>
    @if($attributes->has('footer'))
        <div class="gm-drawer__footer">
            {{ $attributes->get('footer') }}
        </div>
    @endif
</aside>

@push('scripts')
<script>
    (function() {
        const overlay = document.getElementById('{{ $overlayId }}');
        const drawer = document.getElementById('{{ $drawerId }}');
        if (!overlay || !drawer) return;

        function close() {
            overlay.classList.add('gm-drawer--closing');
            overlay.classList.remove('gm-drawer--open');
            drawer.classList.add('gm-drawer--closing');
            drawer.classList.remove('gm-drawer--open');
            setTimeout(() => {
                overlay.classList.remove('gm-drawer--closing');
                drawer.classList.remove('gm-drawer--closing');
                @if($onClose)
                    @this->dispatch('close-drawer', ['id' => $overlayId])
                @endif
            }, 200);
        }

        function handleKeydown(e) {
            if (e.key === 'Escape') close();
        }

        @if($open)
            overlay.classList.add('gm-drawer--open');
            drawer.classList.add('gm-drawer--open');
            document.addEventListener('keydown', handleKeydown);
            document.body.style.overflow = 'hidden';
        @endif

        window.addEventListener('gm:close-drawer', function(e) {
            if (e.detail.id === '{{ $overlayId }}') close();
        });

        window.addEventListener('gm:open-drawer', function(e) {
            if (e.detail.id === '{{ $overlayId }}') {
                overlay.classList.add('gm-drawer--open');
                drawer.classList.add('gm-drawer--open');
                overlay.classList.remove('gm-drawer--closing');
                drawer.classList.remove('gm-drawer--closing');
                document.addEventListener('keydown', handleKeydown);
                document.body.style.overflow = 'hidden';
            }
        });
    })();
</script>
@endpush