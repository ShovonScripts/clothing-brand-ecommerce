<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'items' => [],
    'size' => 'md',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'items' => [],
    'size' => 'md',
]); ?>
<?php foreach (array_filter(([
    'items' => [],
    'size' => 'md',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-breadcrumb', "gm-breadcrumb--{$size}"];
?>

<nav <?php echo e($attributes->merge(['class' => implode(' ', $classes), 'aria-label' => 'Breadcrumb'])); ?>>
    <ol class="gm-breadcrumb__list">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="gm-breadcrumb__item" <?php echo e($loop->last ? 'aria-current="page"' : ''); ?>>
                <?php if(!$loop->last && isset($item['url'])): ?>
                    <a href="<?php echo e($item['url']); ?>" class="gm-breadcrumb__link"><?php echo e($item['label']); ?></a>
                <?php else: ?>
                    <span class="gm-breadcrumb__current"><?php echo e($item['label'] ?? $slot); ?></span>
                <?php endif; ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
</nav><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/components/ui/breadcrumb.blade.php ENDPATH**/ ?>