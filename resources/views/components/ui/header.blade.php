@props([
    'announceLeft' => null,
    'announceMid' => null,
    'announceRight' => null,
    'logo' => null,
    'logoAlt' => 'GENTRY',
    'navigation' => [],
    'searchEnabled' => true,
    'cartCount' => 0,
    'user' => null,
])

<?php
$announceLeft = $announceLeft ?? ['Client services' => route('front.contactUs')];
$announceRight = $announceRight ?? [
    'phone' => ['label' => config('app.phone') ?? '+880 1234 567890', 'href' => route('front.contactUs')],
    'store' => ['label' => 'Store locator', 'href' => route('front.products.index')],
];
?>

<div class="gm-announce" role="region" aria-label="Announcements">
    <div class="gm-container gm-announce__inner">
        <div class="gm-announce__left">
            @foreach($announceLeft as $label => $url)
                <a href="{{ $url }}" class="gm-announce__link">{{ $label }}</a>
            @endforeach
        </div>
        <div class="gm-announce__mid">{{ $announceMid ?? 'Complimentary delivery on orders over ৳5,000 — easy 14-day returns' }}</div>
        <div class="gm-announce__right">
            @foreach($announceRight as $item)
                <a href="{{ $item['href'] }}" class="gm-announce__link">{{ $item['label'] }}</a>
            @endforeach
        </div>
    </div>
</div>

<header class="gm-header" id="gm-header" role="banner">
    <div class="gm-container gm-header__inner">
        <div class="gm-header__left">
            <button type="button" class="gm-icon-btn gm-menu-toggle" aria-label="Open menu" data-gm-drawer-open="mobile-nav">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </button>
            <a href="{{ route('front.home') }}" class="gm-logo" aria-label="{{ $logoAlt }}">
                @if($logo)
                    <img src="{{ $logo }}" alt="{{ $logoAlt }}">
                @else
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
                @endif
            </a>
        </div>

        <nav class="gm-header__center" aria-label="Main navigation">
            <ul class="gm-nav">
                @foreach($navigation as $item)
                    <li class="gm-nav__item">
                        @if(isset($item['children']))
                            <a href="{{ $item['href'] ?? '#' }}" class="gm-nav__link">{{ $item['label'] }}</a>
                            <ul class="gm-dropdown" role="menu">
                                @foreach($item['children'] as $child)
                                    <li class="gm-dropdown__item">
                                        <a href="{{ $child['href'] }}" class="gm-dropdown__link" role="menuitem">{{ $child['label'] }}</a>
                                    </li>
                                @endforeach
                                @if(isset($item['viewAll']))
                                    <li class="gm-dropdown__item">
                                        <a href="{{ $item['viewAll']['href'] }}" class="gm-dropdown__link gm-dropdown__link--view-all" role="menuitem">{{ $item['viewAll']['label'] }}</a>
                                    </li>
                                @endif
                            </ul>
                        @else
                            <a href="{{ $item['href'] }}" class="gm-nav__link{{ isset($item['sale']) && $item['sale'] ? ' gm-nav__link--sale' : '' }}">{{ $item['label'] }}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="gm-header__right">
            @if($searchEnabled)
                <button type="button" class="gm-icon-btn gm-search-trigger" aria-label="Search" data-gm-search-toggle>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </button>
            @endif

            @if($user)
                <a href="{{ route('front.dashboard.index') }}" class="gm-icon-btn gm-account-link" aria-label="My account">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </a>
            @else
                <a href="{{ route('login') }}" class="gm-icon-btn gm-account-link" aria-label="Sign in">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </a>
            @endif

            <a href="{{ route('front.carts.index') }}" class="gm-icon-btn gm-cart-link" aria-label="Shopping bag ({{ $cartCount }} items)">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                @if($cartCount > 0)
                    <span class="gm-cart-badge cart-count">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
    </div>

    @if($searchEnabled)
        <div class="gm-search-panel" id="gm-search-panel" role="search" aria-label="Site search">
            <div class="gm-container">
                <form action="{{ route('front.products.index') }}" class="gm-search-form" role="search">
                    <svg class="gm-search-form__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="search" name="q" class="gm-search-form__input" placeholder="Search shirts, tailoring, knitwear…" autocomplete="off" aria-label="Search products" value="{{ request('q') ?? '' }}">
                    <x-ui.button variant="primary" type="submit" class="gm-search-form__submit">Search</x-ui.button>
                </form>
            </div>
        </div>
    @endif
</header>

@push('scripts')
<script>
    (function() {
        // Search panel toggle
        const searchBtn = document.querySelector('[data-gm-search-toggle]');
        const searchPanel = document.getElementById('gm-search-panel');
        if (searchBtn && searchPanel) {
            searchBtn.addEventListener('click', () => {
                searchPanel.classList.toggle('gm-search-panel--open');
                const input = searchPanel.querySelector('input');
                if (searchPanel.classList.contains('gm-search-panel--open') && input) input.focus();
            });
        }

        // Header scroll effect
        const header = document.getElementById('gm-header');
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 100) {
                header.classList.add('gm-header--scrolled');
            } else {
                header.classList.remove('gm-header--scrolled');
            }
            lastScroll = currentScroll;
        }, { passive: true });
    })();
</script>
@endpush