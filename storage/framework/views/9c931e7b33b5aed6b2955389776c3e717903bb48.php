<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'name' => null,
    'value' => 1,
    'min' => 1,
    'max' => 99,
    // Known stock for this item, or null when unknown. Only drives the low-stock note.
    'stock' => null,
    'size' => 'md',
    'inline' => false,
    'id' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'name' => null,
    'value' => 1,
    'min' => 1,
    'max' => 99,
    // Known stock for this item, or null when unknown. Only drives the low-stock note.
    'stock' => null,
    'size' => 'md',
    'inline' => false,
    'id' => null,
]); ?>
<?php foreach (array_filter(([
    'name' => null,
    'value' => 1,
    'min' => 1,
    'max' => 99,
    // Known stock for this item, or null when unknown. Only drives the low-stock note.
    'stock' => null,
    'size' => 'md',
    'inline' => false,
    'id' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>


<?php
    $stepperId = $id ?? 'gm-qty-' . uniqid();
    $classes = ['gm-quantity-stepper', "gm-quantity-stepper--{$size}"];
    if ($inline) $classes[] = 'gm-quantity-stepper--inline';
    $cap = $stock !== null ? min((int) $max, (int) $stock) : (int) $max;
    $left = $stock !== null ? (int) $stock - (int) $value : null;
?>

<div class="<?php echo e(implode(' ', $classes)); ?>" data-gm-qty>
    <button type="button" class="gm-quantity-stepper__btn gm-quantity-stepper__btn--decrement"
            data-gm-qty-step="-1" aria-label="Decrease quantity" <?php if($value <= $min): echo 'disabled'; endif; ?>>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
    </button>

    <input
        type="number"
        <?php if($name): ?> name="<?php echo e($name); ?>" <?php endif; ?>
        id="<?php echo e($stepperId); ?>"
        value="<?php echo e($value); ?>"
        min="<?php echo e($min); ?>"
        max="<?php echo e($cap); ?>"
        aria-label="Quantity"
        inputmode="numeric"
        <?php echo e($attributes->merge(['class' => 'gm-quantity-stepper__input'])); ?>

    />

    <button type="button" class="gm-quantity-stepper__btn gm-quantity-stepper__btn--increment"
            data-gm-qty-step="1" aria-label="Increase quantity" <?php if($value >= $cap): echo 'disabled'; endif; ?>>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
    </button>
</div>

<?php if($left !== null && $left <= 5): ?>
    <p class="gm-quantity-stepper__limit <?php echo e($left <= 0 ? 'gm-quantity-stepper__limit--error' : 'gm-quantity-stepper__limit--warning'); ?>">
        <?php echo e($left <= 0 ? 'No more in stock' : "Only {$stock} left in stock"); ?>

    </p>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/components/ui/quantity-stepper.blade.php ENDPATH**/ ?>