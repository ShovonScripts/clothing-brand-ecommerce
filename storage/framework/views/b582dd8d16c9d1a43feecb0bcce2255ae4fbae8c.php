<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'label' => '',
    'value' => '',
    'icon' => null,
    'variant' => 'default',
    'trend' => null,
    'trendLabel' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'label' => '',
    'value' => '',
    'icon' => null,
    'variant' => 'default',
    'trend' => null,
    'trendLabel' => null,
]); ?>
<?php foreach (array_filter(([
    'label' => '',
    'value' => '',
    'icon' => null,
    'variant' => 'default',
    'trend' => null,
    'trendLabel' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-admin-stat-card', "gm-admin-stat-card--{$variant}"];
$class = implode(' ', $classes);
?>

<div <?php echo e($attributes->merge(['class' => $class])); ?>>
    <?php if($icon): ?>
        <div class="gm-admin-stat-card__icon"><?php echo $icon; ?></div>
    <?php endif; ?>
    <div class="gm-admin-stat-card__value"><?php echo e($value); ?></div>
    <div class="gm-admin-stat-card__label"><?php echo e($label); ?></div>

    <?php if($trend !== null): ?>
        <div class="gm-admin-stat-card__trend gm-admin-stat-card__trend--<?php echo e($trend >= 0 ? 'up' : 'down'); ?>">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <?php if($trend >= 0): ?>
                    <polyline points="23 6 13.5 15.5 8.5 10.5"></polyline>
                <?php else: ?>
                    <polyline points="1 18 10.5 8.5 15.5 13.5"></polyline>
                <?php endif; ?>
            </svg>
            <span><?php echo e(abs($trend)); ?>%</span>
            <?php if($trendLabel): ?>
                <span style="color: var(--c-ink-500);"><?php echo e($trendLabel); ?></span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\admin\stat-card.blade.php ENDPATH**/ ?>