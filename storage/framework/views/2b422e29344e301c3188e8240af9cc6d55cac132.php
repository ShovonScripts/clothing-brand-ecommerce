<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'type' => 'default',
    'title' => null,
    'message' => null,
    'action' => null,
    'actionUrl' => null,
    'variant' => 'default',
    'icon' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'type' => 'default',
    'title' => null,
    'message' => null,
    'action' => null,
    'actionUrl' => null,
    'variant' => 'default',
    'icon' => null,
]); ?>
<?php foreach (array_filter(([
    'type' => 'default',
    'title' => null,
    'message' => null,
    'action' => null,
    'actionUrl' => null,
    'variant' => 'default',
    'icon' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

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

<div <?php echo e($attributes->merge(['class' => $class, 'role' => 'status'])); ?>>
    <div class="gm-empty-state__icon" aria-hidden="true"><?php echo $iconSvg; ?></div>
    <h2 class="gm-empty-state__title"><?php echo e($title); ?></h2>
    <p class="gm-empty-state__message"><?php echo e($message); ?></p>

    <?php if($action && $actionUrl): ?>
        <div class="gm-empty-state__action">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','size' => 'lg','href' => ''.e($actionUrl).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','href' => ''.e($actionUrl).'']); ?><?php echo e($action); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div>
    <?php endif; ?>

    <?php echo e($slot); ?>

</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\empty-state.blade.php ENDPATH**/ ?>