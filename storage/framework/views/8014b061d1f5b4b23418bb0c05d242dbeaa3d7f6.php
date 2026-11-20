<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'columns' => 4,
    'gap' => 4,
    'autoFit' => false,
    'minWidth' => 240,
    'listView' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'columns' => 4,
    'gap' => 4,
    'autoFit' => false,
    'minWidth' => 240,
    'listView' => false,
]); ?>
<?php foreach (array_filter(([
    'columns' => 4,
    'gap' => 4,
    'autoFit' => false,
    'minWidth' => 240,
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
$classes = ['gm-grid'];
if ($autoFit) {
    $classes[] = 'gm-grid--auto';
} else {
    $classes[] = "gm-grid--{$columns}";
}
$classes[] = "gm-grid--gap-{$gap}";
if ($listView) $classes[] = 'gm-product-grid--list';
$class = implode(' ', $classes);

$style = '';
if ($autoFit) {
    $style = 'style="grid-template-columns: repeat(auto-fill, minmax(' . $minWidth . 'px, 1fr));"';
}
?>

<div <?php echo e($attributes->merge(['class' => $class, 'style' => $style, 'role' => 'list'])); ?>>
    <?php echo e($slot); ?>

</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/components/ui/grid.blade.php ENDPATH**/ ?>