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
$classes = ['gm-stat-card', "gm-stat-card--{$variant}"];
$class = implode(' ', $classes);

$variantColors = [
    'default' => 'var(--c-ink-900)',
    'success' => 'var(--c-success)',
    'warn' => 'var(--c-warn)',
    'danger' => 'var(--c-danger)',
    'info' => 'var(--c-info)',
];
$iconColor = $variantColors[$variant] ?? $variantColors['default'];
?>

<div <?php echo e($attributes->merge(['class' => $class])); ?>>
    <div class="gm-stat-card__icon" style="width: 48px; height: 48px; border-radius: var(--r-md); background: <?php echo e($iconColor); ?>15; display: flex; align-items: center; justify-content: center; color: <?php echo e($iconColor); ?>; margin-bottom: var(--s-3);">
        <?php echo $icon; ?>

    </div>
    <div class="gm-stat-card__value" style="font-size: var(--t-2xl); font-weight: 600; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1); line-height: 1;"><?php echo e($value); ?></div>
    <div class="gm-stat-card__label" style="font-size: var(--t-sm); color: var(--c-ink-500); margin: 0;"><?php echo e($label); ?></div>

    <?php if($trend !== null): ?>
        <div class="gm-stat-card__trend" style="display: inline-flex; align-items: center; gap: var(--s-1); margin-top: var(--s-2); font-size: var(--t-xs); font-weight: 500; <?php echo e($trend >= 0 ? 'color: var(--c-success);' : 'color: var(--c-danger);'); ?>">
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
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\stat-card.blade.php ENDPATH**/ ?>