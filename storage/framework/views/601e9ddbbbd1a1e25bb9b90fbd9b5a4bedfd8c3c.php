<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'variant' => 'neutral',
    'size' => 'md',
    'dot' => false,
    'removable' => false,
    'onRemove' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'variant' => 'neutral',
    'size' => 'md',
    'dot' => false,
    'removable' => false,
    'onRemove' => null,
]); ?>
<?php foreach (array_filter(([
    'variant' => 'neutral',
    'size' => 'md',
    'dot' => false,
    'removable' => false,
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
$classes = ['gm-badge', "gm-badge--{$variant}", "gm-badge--{$size}"];
if ($dot) $classes[] = 'gm-badge--dot';
?>

<span <?php echo e($attributes->merge(['class' => implode(' ', $classes), 'role' => 'status'])); ?>>
    <?php echo e($slot); ?>

    <?php if($removable): ?>
        <button
            type="button"
            class="gm-badge__remove"
            aria-label="Remove"
        >
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    <?php endif; ?>
</span><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/components/ui/badge.blade.php ENDPATH**/ ?>