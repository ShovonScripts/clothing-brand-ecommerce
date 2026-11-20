<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'listView' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'listView' => false,
]); ?>
<?php foreach (array_filter(([
    'listView' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-product-grid'];
if ($listView) $classes[] = 'gm-product-grid--list';
$class = implode(' ', $classes);
?>

<div <?php echo e($attributes->merge(['class' => $class, 'role' => 'list'])); ?>>
    <?php echo e($slot); ?>

</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\product-grid.blade.php ENDPATH**/ ?>