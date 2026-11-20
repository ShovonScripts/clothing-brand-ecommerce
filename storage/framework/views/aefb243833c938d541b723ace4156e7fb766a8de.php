<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'label' => null,
    'checked' => false,
    'disabled' => false,
    'id' => null,
    'name' => null,
    'value' => '1',
    'error' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'label' => null,
    'checked' => false,
    'disabled' => false,
    'id' => null,
    'name' => null,
    'value' => '1',
    'error' => false,
]); ?>
<?php foreach (array_filter(([
    'label' => null,
    'checked' => false,
    'disabled' => false,
    'id' => null,
    'name' => null,
    'value' => '1',
    'error' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$checkboxId = $id ?? 'gm-checkbox-' . uniqid();
?>

<div <?php echo e($attributes->merge(['class' => 'gm-checkbox'])); ?>>
    <input
        type="checkbox"
        id="<?php echo e($checkboxId); ?>"
        name="<?php echo e($name); ?>"
        value="<?php echo e($value); ?>"
        class="gm-checkbox__input"
        <?php if($checked): ?> checked <?php endif; ?>
        <?php if($disabled): ?> disabled <?php endif; ?>
        <?php if($error): ?> aria-invalid="true" <?php endif; ?>
        <?php echo e($attributes->except(['class', 'id', 'name', 'value', 'checked', 'disabled'])); ?>

    />
    <span class="gm-checkbox__box" aria-hidden="true"></span>
    <?php if($label): ?>
        <label for="<?php echo e($checkboxId); ?>" class="gm-checkbox__label"><?php echo e($label); ?></label>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\checkbox.blade.php ENDPATH**/ ?>