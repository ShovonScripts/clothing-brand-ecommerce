<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'status' => 'pending',
    'size' => 'md',
    'dot' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'status' => 'pending',
    'size' => 'md',
    'dot' => false,
]); ?>
<?php foreach (array_filter(([
    'status' => 'pending',
    'size' => 'md',
    'dot' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-admin-status-pill', "gm-admin-status-pill--{$status}", "gm-admin-status-pill--{$size}"];
if ($dot) $classes[] = 'gm-admin-status-pill--dot';
$class = implode(' ', $classes);
?>

<span <?php echo e($attributes->merge(['class' => $class, 'role' => 'status'])); ?>>
    <?php echo e(ucwords(str_replace(['-', '_'], ' ', $status))); ?>

</span><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\admin\status-pill.blade.php ENDPATH**/ ?>