<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'variant' => 'text',
    'width' => '100%',
    'height' => null,
    'count' => 1,
    'animation' => true,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'variant' => 'text',
    'width' => '100%',
    'height' => null,
    'count' => 1,
    'animation' => true,
]); ?>
<?php foreach (array_filter(([
    'variant' => 'text',
    'width' => '100%',
    'height' => null,
    'count' => 1,
    'animation' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-skeleton', "gm-skeleton--{$variant}"];
if (!$animation) $classes[] = 'gm-skeleton--no-animation';

$style = 'width: ' . $width . ';';
if ($height) $style .= ' height: ' . $height . ';';
?>

<?php for($i = 0; $i < $count; $i++): ?>
    <div
        <?php echo e($attributes->merge(['class' => implode(' ', $classes), 'style' => $style, 'aria-hidden' => 'true', 'role' => 'status', 'aria-label' => 'Loading...'])); ?>

    ></div>
<?php endfor; ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\skeleton.blade.php ENDPATH**/ ?>