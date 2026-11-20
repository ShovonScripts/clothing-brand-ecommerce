<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'labels' => [],
    'active' => 0,
    'variant' => 'underline',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'labels' => [],
    'active' => 0,
    'variant' => 'underline',
]); ?>
<?php foreach (array_filter(([
    'labels' => [],
    'active' => 0,
    'variant' => 'underline',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>


<?php
    $tabsId = 'gm-tabs-' . uniqid();
?>

<div <?php echo e($attributes->merge(['class' => 'gm-tabs'])); ?> id="<?php echo e($tabsId); ?>" data-gm-tabs data-gm-active="<?php echo e((int) $active); ?>">
    <div class="gm-tabs__list <?php echo e($variant === 'pill' ? 'gm-tabs__list--pill' : ''); ?>" role="tablist" aria-orientation="horizontal">
        <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button
                type="button"
                role="tab"
                id="<?php echo e($tabsId); ?>-tab-<?php echo e($index); ?>"
                class="gm-tabs__trigger <?php echo e($index === (int) $active ? 'gm-tabs__trigger--active' : ''); ?>"
                aria-selected="<?php echo e($index === (int) $active ? 'true' : 'false'); ?>"
                aria-controls="<?php echo e($tabsId); ?>-panel-<?php echo e($index); ?>"
                tabindex="<?php echo e($index === (int) $active ? '0' : '-1'); ?>"
                data-gm-tab="<?php echo e($index); ?>"
            ><?php echo e($label); ?></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php echo e($slot); ?>

</div>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\tabs.blade.php ENDPATH**/ ?>