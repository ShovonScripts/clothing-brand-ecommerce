<!DOCTYPE html>
<html lang="en">
@php $info = \App\Models\Information::first(); @endphp
<head>
    <meta charset="utf-8" />
    <title>{{ $info->site_name ?? 'GENTRY' }} — Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="GENTRY Admin Panel" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Bodoni+Moda:opsz,wght@6..96,400;6..96,500;6..96,600&display=swap" rel="stylesheet">

    @vite(['resources/scss/admin.scss', 'resources/js/app.js'])

    @stack('css')
</head>

<body class="gm-admin-body" data-layout="detached">
    {{-- Topbar --}}
    <header class="gm-admin-header" role="banner">
        <div class="gm-container gm-admin-header__inner">
            <a href="{{ route('admin.dashboard') }}" class="gm-admin-header__logo" aria-label="GENTRY Admin">
                <img src="{{ asset('images/logo.png') }}" alt="{{ $info->site_name ?? 'GENTRY' }}" height="32">
            </a>

            <nav class="gm-admin-header__nav" aria-label="Admin navigation">
                <ul class="gm-admin-header__nav-list">
                    <li>
                        <a href="{{ route('front.home') }}" target="_blank" class="gm-admin-header__nav-link">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span>View Store</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="gm-admin-header__actions">
                <div class="gm-admin-header__user-dropdown">
                    <button type="button" class="gm-admin-header__user-trigger" aria-expanded="false" aria-haspopup="true" data-gm-dropdown-toggle>
                        <span class="gm-admin-header__user-avatar">{{ strtoupper(auth()->user()->first_name[0] ?? 'A') }}</span>
                        <span class="gm-admin-header__user-name">{{ auth()->user()->first_name ?? 'Admin' }}</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <div class="gm-admin-header__user-menu" role="menu" data-gm-dropdown-menu>
                        <div class="gm-admin-header__user-menu-header">
                            <strong>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</strong>
                            <small>{{ auth()->user()->email }}</small>
                        </div>
                        <a href="{{ route('admin.profile') }}" class="gm-admin-header__user-menu-item" role="menuitem">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            <span>My Account</span>
                        </a>
                        <a href="{{ route('admin.password') }}" class="gm-admin-header__user-menu-item" role="menuitem">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            <span>Change Password</span>
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="gm-admin-header__user-menu-item" role="menuitem">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            <span>Settings</span>
                        </a>
                        <hr class="gm-admin-header__user-menu-divider">
                        <form action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <button type="submit" form="logout-form" class="gm-admin-header__user-menu-item gm-admin-header__user-menu-item--danger" role="menuitem">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                            <span>Logout</span>
                        </button>
                    </div>
                </div>
            </div>

            <button type="button" class="gm-admin-header__menu-toggle" aria-label="Toggle menu" data-gm-drawer-open="admin-sidebar">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </button>
        </div>
    </header>

    {{-- Sidebar Drawer --}}
    <div class="gm-drawer-overlay" id="admin-sidebar-overlay" data-gm-drawer-close></div>
    <aside class="gm-drawer gm-drawer--left gm-admin-sidebar" id="admin-sidebar" role="dialog" aria-label="Admin navigation">
        <div class="gm-admin-sidebar__header">
            <a href="{{ route('admin.dashboard') }}" class="gm-admin-sidebar__logo" aria-label="GENTRY Admin">
                <img src="{{ asset('images/logo.png') }}" alt="{{ $info->site_name ?? 'GENTRY' }}" height="36">
            </a>
            <button type="button" class="gm-drawer__close" aria-label="Close sidebar" data-gm-drawer-close>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <div class="gm-admin-sidebar__user">
            <div class="gm-admin-sidebar__user-avatar">{{ strtoupper(auth()->user()->first_name[0] ?? 'A') }}</div>
            <div class="gm-admin-sidebar__user-name">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
            <div class="gm-admin-sidebar__user-role">{{ auth()->user()->roles->first()?->name ?? 'Administrator' }}</div>
        </div>

        <nav class="gm-admin-sidebar__nav" aria-label="Admin navigation">
            @include('backend.partials.navbar')
        </nav>

        <div class="gm-admin-sidebar__footer">
            <div class="gm-admin-sidebar__version">v1.0.0</div>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="gm-admin-wrapper">
        <main class="gm-admin-main" role="main">
            @yield('content')
        </main>

        <footer class="gm-admin-footer">
            <div class="gm-container">
                <p>&copy; {{ date('Y') }} {{ $info->site_name ?? 'GENTRY' }}. All rights reserved.</p>
            </div>
        </footer>
    </div>

    @include('backend.partials.js')

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-expand active sidebar group
            const activeLink = document.querySelector('.gm-admin-sidebar__nav .active');
            if (activeLink) {
                const parent = activeLink.closest('.gm-admin-sidebar__submenu');
                if (parent) {
                    parent.setAttribute('open', '');
                    const trigger = parent.previousElementSibling;
                    if (trigger) trigger.setAttribute('aria-expanded', 'true');
                }
                activeLink.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }

            // Sidebar toggle
            const sidebarToggle = document.querySelector('[data-gm-drawer-open="admin-sidebar"]');
            const overlay = document.getElementById('admin-sidebar-overlay');
            const sidebar = document.getElementById('admin-sidebar');
            
            if (sidebarToggle && sidebar && overlay) {
                sidebarToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('gm-drawer--open');
                    overlay.classList.toggle('gm-drawer-overlay--open');
                    document.body.style.overflow = sidebar.classList.contains('gm-drawer--open') ? 'hidden' : '';
                });
                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('gm-drawer--open');
                    overlay.classList.remove('gm-drawer-overlay--open');
                    document.body.style.overflow = '';
                });
            }

            // User dropdown
            const userTrigger = document.querySelector('[data-gm-dropdown-toggle]');
            const userMenu = document.querySelector('[data-gm-dropdown-menu]');
            if (userTrigger && userMenu) {
                userTrigger.addEventListener('click', (e) => {
                    e.stopPropagation();
                    userMenu.classList.toggle('gm-admin-header__user-menu--open');
                    userTrigger.setAttribute('aria-expanded', userMenu.classList.contains('gm-admin-header__user-menu--open'));
                });
                document.addEventListener('click', (e) => {
                    if (!userTrigger.contains(e.target) && !userMenu.contains(e.target)) {
                        userMenu.classList.remove('gm-admin-header__user-menu--open');
                        userTrigger.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
    </script>
    @endpush
</body>
</html>