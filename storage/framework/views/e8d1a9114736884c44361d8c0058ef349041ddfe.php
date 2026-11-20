<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'id' => null,
    'active' => false,
    'size' => 'md',
    'card' => false,
    'tooltip' => 'Add to wishlist',
    'onToggle' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'id' => null,
    'active' => false,
    'size' => 'md',
    'card' => false,
    'tooltip' => 'Add to wishlist',
    'onToggle' => null,
]); ?>
<?php foreach (array_filter(([
    'id' => null,
    'active' => false,
    'size' => 'md',
    'card' => false,
    'tooltip' => 'Add to wishlist',
    'onToggle' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-wishlist-button', "gm-wishlist-button--{$size}"];
if ($active) $classes[] = 'gm-wishlist-button--active';
if ($card) $classes[] = 'gm-wishlist-button--card';
$class = implode(' ', $classes);

$heartIcon = '<svg class="gm-wishlist-button__icon" viewBox="0 0 24 24" fill="' . ($active ? 'currentColor' : 'none') . '" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>';
?>

<button
    type="button"
    <?php echo e($attributes->merge(['class' => $class, 'data-tooltip' => $tooltip])); ?>

    aria-label="<?php echo e($tooltip); ?>"
    aria-pressed="<?php echo e($active ? 'true' : 'false'); ?>"
>
    <?php echo $heartIcon; ?>

</button><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\wishlist-button.blade.php ENDPATH**/ ?>