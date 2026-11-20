<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'title' => null,
    'subtitle' => null,
    'action' => null,
    'actionUrl' => null,
    'count' => null,
    'centered' => false,
    'minimal' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'title' => null,
    'subtitle' => null,
    'action' => null,
    'actionUrl' => null,
    'count' => null,
    'centered' => false,
    'minimal' => false,
]); ?>
<?php foreach (array_filter(([
    'title' => null,
    'subtitle' => null,
    'action' => null,
    'actionUrl' => null,
    'count' => null,
    'centered' => false,
    'minimal' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-section-header'];
if ($centered) $classes[] = 'gm-section-header--centered';
if ($minimal) $classes[] = 'gm-section-header--minimal';
$class = implode(' ', $classes);
?>

<div <?php echo e($attributes->merge(['class' => $class])); ?>>
    <div class="gm-section-header__content">
        <?php if($title): ?>
            <h2 class="gm-section-header__title"><?php echo e($title); ?></h2>
        <?php endif; ?>

        <?php if($subtitle): ?>
            <p class="gm-section-header__subtitle"><?php echo e($subtitle); ?></p>
        <?php endif; ?>

        <?php if($count !== null): ?>
            <span class="gm-section-header__count"><?php echo e($count); ?> items</span>
        <?php endif; ?>
    </div>

    <?php if($action && $actionUrl): ?>
        <div class="gm-section-header__actions">
            <a href="<?php echo e($actionUrl); ?>" class="gm-section-header__link gm-section-header__view-all">
                <?php echo e($action); ?>

                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </a>
        </div>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/components/ui/section-header.blade.php ENDPATH**/ ?>