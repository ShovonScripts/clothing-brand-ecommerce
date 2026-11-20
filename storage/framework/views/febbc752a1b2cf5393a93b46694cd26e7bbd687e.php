<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'allowMultiple' => false,
    'borderless' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'allowMultiple' => false,
    'borderless' => false,
]); ?>
<?php foreach (array_filter(([
    'allowMultiple' => false,
    'borderless' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>


<div <?php echo e($attributes->merge(['class' => 'gm-accordion' . ($borderless ? ' gm-accordion--borderless' : '')])); ?>

     data-gm-accordion
     data-gm-allow-multiple="<?php echo e($allowMultiple ? 'true' : 'false'); ?>">
    <?php echo e($slot); ?>

</div>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/components/ui/accordion.blade.php ENDPATH**/ ?>