@props([
    'logo' => null,
    'logoAlt' => 'GENTRY',
    'navigation' => [],
    'user' => null,
    'cartCount' => 0,
    'id' => 'mobile-nav',
])

<?php
$drawerId = $id;
$overlayId = $drawerId . '-overlay';
?>

<div
    id="{{ $overlayId }}"
    class="gm-drawer-overlay"
    data-gm-drawer-close
    aria-hidden="true"
></div>

<aside
    id="{{ $drawerId }}"
    class="gm-drawer gm-drawer--right"
    role="dialog"
    aria-modal="true"
    aria-label="Mobile menu"
>
    <div class="gm-drawer__header">
        <a href="{{ route('front.home') }}" class="gm-drawer__logo" aria-label="{{ $logoAlt }}">
            @if($logo)
                <img src="{{ $logo }}" alt="{{ $logoAlt }}">
            @else
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
            @endif
        </a>
        <button type="button" class="gm-drawer__close" aria-label="Close menu">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>

    <form action="{{ route('front.products.index') }}" class="gm-drawer__search" role="search">
        <div class="gm-drawer__search-form">
            <input
                type="search"
                name="q"
                class="gm-drawer__search-input"
                placeholder="Search the collection…"
                aria-label="Search products"
                value="{{ request('q') ?? '' }}"
            >
            <button type="submit" class="gm-drawer__search-submit" aria-label="Search">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button>
        </div>
    </form>

    <nav class="gm-drawer__nav" aria-label="Mobile navigation">
        <ul class="gm-drawer__nav-list">
            @foreach($navigation as $item)
                @if(isset($item['children']))
                    <li class="gm-drawer__nav-item gm-drawer__section">
                        <button type="button" class="gm-drawer__section-trigger" aria-expanded="false" aria-controls="{{ $drawerId }}-section-{{ $loop->index }}">
                            {{ $item['label'] }}
                            <span class="gm-drawer__section-icon" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </span>
                        </button>
                        <div class="gm-drawer__section-content" id="{{ $drawerId }}-section-{{ $loop->index }}" role="region">
                            <ul class="gm-drawer__sub-list">
                                @foreach($item['children'] as $child)
                                    <li>
                                        <a href="{{ $child['href'] }}" class="gm-drawer__sub-link">{{ $child['label'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @else
                    <li class="gm-drawer__nav-item">
                        <a href="{{ $item['href'] }}" class="gm-drawer__nav-link{{ isset($item['sale']) && $item['sale'] ? ' gm-drawer__nav-link--sale' : '' }}">{{ $item['label'] }}</a>
                    </li>
                @endif
            @endforeach

            @if($navigation->where('sale', true)->isEmpty())
                <li class="gm-drawer__nav-item">
                    <a href="{{ route('front.discountProduct') }}" class="gm-drawer__nav-link gm-drawer__nav-link--sale" style="color: var(--gm-accent)">Sale</a>
                </li>
            @endif

            <li class="gm-drawer__nav-item">
                <a href="{{ route('front.aboutUs') }}" class="gm-drawer__nav-link">Our story</a>
            </li>
            <li class="gm-drawer__nav-item">
                <a href="{{ route('front.contactUs') }}" class="gm-drawer__nav-link">Contact</a>
            </li>
        </ul>
    </nav>

    <div class="gm-drawer__actions">
        @if($user)
            <a href="{{ route('front.dashboard.index') }}" class="gm-btn gm-drawer__action-btn gm-drawer__action-btn--ghost">My account</a>
        @else
            <a href="{{ route('login') }}" class="gm-btn gm-drawer__action-btn gm-drawer__action-btn--ghost">Sign in</a>
        @endif
        <a href="{{ route('front.carts.index') }}" class="gm-btn gm-drawer__action-btn gm-drawer__action-btn--primary">View bag ({{ $cartCount }})</a>
    </div>
</aside>

@push('scripts')
<script>
    (function() {
        const drawerId = '{{ $drawerId }}';
        const overlayId = '{{ $overlayId }}';

        window.addEventListener('gm:open-drawer', function(e) {
            if (e.detail.id === drawerId) {
                const drawer = document.getElementById(drawerId);
                const overlay = document.getElementById(overlayId);
                if (drawer && overlay) {
                    drawer.classList.add('gm-drawer--open');
                    overlay.classList.add('gm-drawer-overlay--open');
                    document.body.style.overflow = 'hidden';
                }
            }
        });

        window.addEventListener('gm:close-drawer', function(e) {
            if (e.detail.id === overlayId) {
                const drawer = document.getElementById(drawerId);
                const overlay = document.getElementById(overlayId);
                if (drawer && overlay) {
                    drawer.classList.remove('gm-drawer--open');
                    overlay.classList.remove('gm-drawer-overlay--open');
                    document.body.style.overflow = '';
                }
            }
        });

        // Accordion sections
        document.querySelectorAll('.gm-drawer__section-trigger').forEach(trigger => {
            trigger.addEventListener('click', () => {
                const section = trigger.closest('.gm-drawer__section');
                if (!section) return;
                const isOpen = section.hasAttribute('open');
                if (isOpen) {
                    section.removeAttribute('open');
                    trigger.setAttribute('aria-expanded', 'false');
                } else {
                    section.setAttribute('open', '');
                    trigger.setAttribute('aria-expanded', 'true');
                }
            });
        });
    })();
</script>
@endpush