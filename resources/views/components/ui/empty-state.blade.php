@props([
    'type' => 'default',
    'title' => null,
    'message' => null,
    'action' => null,
    'actionUrl' => null,
    'variant' => 'default',
    'icon' => null,
])

<?php
$classes = ['gm-empty-state', "gm-empty-state--{$variant}"];
if ($type !== 'default') $classes[] = "gm-empty-state--{$type}";
$class = implode(' ', $classes);

$icons = [
    'cart' => '<svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>',
    'wishlist' => '<svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>',
    'orders' => '<svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>',
    'search' => '<svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
    'account' => '<svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>',
    '404' => '<svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>',
    'default' => '<svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg>',
];

$defaultTitles = [
    'cart' => 'Your bag is empty',
    'wishlist' => 'Your wishlist is empty',
    'orders' => 'No orders yet',
    'search' => 'No results found',
    'account' => 'Welcome to your account',
    '404' => 'Page not found',
    'default' => 'Nothing here',
];

$defaultMessages = [
    'cart' => 'Looks like you haven\'t added anything yet. Start shopping to fill your bag.',
    'wishlist' => 'Save items you love for later. They\'ll appear here.',
    'orders' => 'When you place an order, it\'ll show up here.',
    'search' => 'Try adjusting your search or browse our collections.',
    'account' => 'Manage your orders, addresses, and preferences.',
    '404' => 'The page you\'re looking for doesn\'t exist or has been moved.',
    'default' => 'There\'s nothing to show at the moment.',
];

$title = $title ?? $defaultTitles[$type];
$message = $message ?? $defaultMessages[$type];
$iconSvg = $icon ?? $icons[$type] ?? $icons['default'];
?>

<div {{ $attributes->merge(['class' => $class, 'role' => 'status']) }}>
    <div class="gm-empty-state__icon" aria-hidden="true">{!! $iconSvg !!}</div>
    <h2 class="gm-empty-state__title">{{ $title }}</h2>
    <p class="gm-empty-state__message">{{ $message }}</p>

    @if($action && $actionUrl)
        <div class="gm-empty-state__action">
            <x-ui.button variant="primary" size="lg" href="{{ $actionUrl }}">{{ $action }}</x-ui.button>
        </div>
    @endif

    {{ $slot }}
</div>