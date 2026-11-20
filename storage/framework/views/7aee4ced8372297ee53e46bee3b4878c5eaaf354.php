<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'id' => null,
    'open' => false,
    'position' => 'right',
    'title' => null,
    'closeable' => true,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'id' => null,
    'open' => false,
    'position' => 'right',
    'title' => null,
    'closeable' => true,
]); ?>
<?php foreach (array_filter(([
    'id' => null,
    'open' => false,
    'position' => 'right',
    'title' => null,
    'closeable' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$drawerId = $id ?? 'gm-drawer-' . uniqid();
$overlayId = $drawerId . '-overlay';
$classes = ['gm-drawer', "gm-drawer--{$position}"];
if ($open) $classes[] = 'gm-drawer--open';
?>


<div
    id="<?php echo e($overlayId); ?>"
    class="gm-drawer-overlay <?php if($open): ?> gm-drawer--open <?php endif; ?>"
    aria-hidden="true"
    data-gm-overlay-for="<?php echo e($drawerId); ?>"
></div>

<aside
    id="<?php echo e($drawerId); ?>"
    <?php echo e($attributes->merge(['class' => implode(' ', $classes)])); ?>

    role="dialog"
    aria-modal="true"
    <?php if($title): ?> aria-labelledby="<?php echo e($drawerId); ?>-title" <?php endif; ?>
    data-gm-drawer
>
    <div class="gm-drawer__header">
        <?php if($title): ?>
            <h2 id="<?php echo e($drawerId); ?>-title" class="gm-drawer__title"><?php echo e($title); ?></h2>
        <?php endif; ?>
        <?php if($closeable): ?>
            <button type="button" class="gm-drawer__close" data-gm-close aria-label="Close">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        <?php endif; ?>
    </div>
    <div class="gm-drawer__body">
        <?php echo e($slot); ?>

    </div>
    <?php if(isset($footer)): ?>
        <div class="gm-drawer__footer">
            <?php echo e($footer); ?>

        </div>
    <?php endif; ?>
</aside>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\drawer.blade.php ENDPATH**/ ?>