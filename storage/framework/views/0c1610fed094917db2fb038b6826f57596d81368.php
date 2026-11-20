<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'title' => '',
    'subtitle' => null,
    'breadcrumb' => [],
    'actions' => null,
    'count' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'title' => '',
    'subtitle' => null,
    'breadcrumb' => [],
    'actions' => null,
    'count' => null,
]); ?>
<?php foreach (array_filter(([
    'title' => '',
    'subtitle' => null,
    'breadcrumb' => [],
    'actions' => null,
    'count' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="gm-admin-page-header" <?php echo e($attributes); ?>>
    <div class="gm-admin-page-header__content">
        <?php if($breadcrumb->count()): ?>
            <nav class="gm-admin-page-header__breadcrumb" aria-label="Breadcrumb">
                <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!$loop->last && isset($item['url'])): ?>
                        <a href="<?php echo e($item['url']); ?>"><?php echo e($item['label']); ?></a>
                        <span class="gm-admin-page-header__breadcrumb-separator" aria-hidden="true">/</span>
                    <?php else: ?>
                        <span class="gm-admin-page-header__breadcrumb-current"><?php echo e($item['label']); ?></span>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </nav>
        <?php endif; ?>

        <?php echo e($slot ?? ''); ?>


        <h1 class="gm-admin-page-header__title"><?php echo e($title); ?></h1>

        <?php if($subtitle): ?>
            <p class="gm-admin-page-header__subtitle"><?php echo e($subtitle); ?></p>
        <?php endif; ?>

        <?php if($count !== null): ?>
            <span class="gm-admin-page-header__count"><?php echo e($count); ?> items</span>
        <?php endif; ?>
    </div>

    <?php if($actions): ?>
        <div class="gm-admin-page-header__actions">
            <?php echo e($actions); ?>

        </div>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\admin\page-header.blade.php ENDPATH**/ ?>