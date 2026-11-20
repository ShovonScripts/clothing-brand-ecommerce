<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'open' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'open' => false,
]); ?>
<?php foreach (array_filter(([
    'open' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $itemId = 'gm-accordion-item-' . uniqid();
?>

<details <?php echo e($attributes->merge(['class' => 'gm-accordion__item'])); ?> id="<?php echo e($itemId); ?>" <?php if($open): ?> open <?php endif; ?>>
    <summary class="gm-accordion__trigger" aria-controls="<?php echo e($itemId); ?>-content">
        <?php echo e($trigger ?? ''); ?>

        <span class="gm-accordion__icon" aria-hidden="true">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
        </span>
    </summary>
    <div class="gm-accordion__content" id="<?php echo e($itemId); ?>-content" role="region">
        <div class="gm-accordion__content-inner">
            <?php echo e($content ?? $slot); ?>

        </div>
    </div>
</details>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\accordion-item.blade.php ENDPATH**/ ?>