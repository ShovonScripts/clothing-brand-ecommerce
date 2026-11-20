<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'items' => [],
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'items' => [],
]); ?>
<?php foreach (array_filter(([
    'items' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<nav class="gm-admin-page-header__breadcrumb" aria-label="Breadcrumb">
    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$loop->last && isset($item['url'])): ?>
            <a href="<?php echo e($item['url']); ?>"><?php echo e($item['label']); ?></a>
            <span class="gm-admin-page-header__breadcrumb-separator" aria-hidden="true">/</span>
        <?php else: ?>
            <span class="gm-admin-page-header__breadcrumb-current"><?php echo e($item['label']); ?></span>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</nav><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\admin\page-header-breadcrumb.blade.php ENDPATH**/ ?>