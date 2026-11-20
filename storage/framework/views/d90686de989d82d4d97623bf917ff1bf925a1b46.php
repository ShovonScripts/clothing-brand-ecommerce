<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'status' => 'in-stock',
    'quantity' => null,
    'variant' => 'default',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'status' => 'in-stock',
    'quantity' => null,
    'variant' => 'default',
]); ?>
<?php foreach (array_filter(([
    'status' => 'in-stock',
    'quantity' => null,
    'variant' => 'default',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-stock-badge'];

$statusConfig = [
    'in-stock' => ['label' => 'In Stock', 'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>'],
    'low-stock' => ['label' => 'Low Stock', 'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>'],
    'out-of-stock' => ['label' => 'Out of Stock', 'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>'],
    'pre-order' => ['label' => 'Pre-order', 'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>'],
];

$config = $statusConfig[$status] ?? $statusConfig['in-stock'];
$classes[] = "gm-stock-badge--{$status}";

if ($variant === 'card') $classes[] = 'gm-stock-badge--card';
if ($variant === 'pdp') $classes[] = 'gm-stock-badge--pdp';
if ($variant === 'dot') $classes[] = 'gm-stock-badge--dot';
?>

<span <?php echo e($attributes->merge(['class' => implode(' ', $classes), 'role' => 'status'])); ?>>
    <span class="gm-stock-badge__icon" aria-hidden="true"><?php echo $config['icon']; ?></span>
    <span class="gm-stock-badge__label"><?php echo e($config['label']); ?></span>
    <?php if($quantity !== null && $status !== 'out-of-stock'): ?>
        <span class="gm-stock-badge__quantity">(<?php echo e($quantity); ?>)</span>
    <?php endif; ?>
</span><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\stock-badge.blade.php ENDPATH**/ ?>