<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'selected' => false,
    'removable' => false,
    'disabled' => false,
    'size' => 'md',
    'onSelect' => null,
    'onRemove' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'selected' => false,
    'removable' => false,
    'disabled' => false,
    'size' => 'md',
    'onSelect' => null,
    'onRemove' => null,
]); ?>
<?php foreach (array_filter(([
    'selected' => false,
    'removable' => false,
    'disabled' => false,
    'size' => 'md',
    'onSelect' => null,
    'onRemove' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-chip', "gm-chip--{$size}"];
if ($selected) $classes[] = 'gm-chip--selected';
if ($disabled) $classes[] = 'gm-chip--disabled';
?>

<?php if($onSelect): ?>
    <button
        type="button"
        class="<?php echo e(implode(' ', $classes)); ?>"
        <?php if($disabled): ?> disabled <?php endif; ?>
        <?php echo e($attributes->except(['class', 'disabled'])); ?>

    >
        <?php echo e($slot); ?>

        <?php if($removable): ?>
            <button
                type="button"
                class="gm-chip__remove"
                aria-label="Remove"
            >
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        <?php endif; ?>
    </button>
<?php else: ?>
    <span class="<?php echo e(implode(' ', $classes)); ?>" <?php echo e($attributes); ?>>
        <?php echo e($slot); ?>

        <?php if($removable): ?>
            <button
                type="button"
                class="gm-chip__remove"
                aria-label="Remove"
            >
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        <?php endif; ?>
    </span>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\chip.blade.php ENDPATH**/ ?>