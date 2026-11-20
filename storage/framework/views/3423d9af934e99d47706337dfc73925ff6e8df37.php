<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'label' => null,
    'placeholder' => 'Select an option',
    'options' => [],
    'error' => null,
    'help' => null,
    'disabled' => false,
    'size' => 'md',
    'id' => null,
    'name' => null,
    'value' => null,
    'required' => false,
    'multiple' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'label' => null,
    'placeholder' => 'Select an option',
    'options' => [],
    'error' => null,
    'help' => null,
    'disabled' => false,
    'size' => 'md',
    'id' => null,
    'name' => null,
    'value' => null,
    'required' => false,
    'multiple' => false,
]); ?>
<?php foreach (array_filter(([
    'label' => null,
    'placeholder' => 'Select an option',
    'options' => [],
    'error' => null,
    'help' => null,
    'disabled' => false,
    'size' => 'md',
    'id' => null,
    'name' => null,
    'value' => null,
    'required' => false,
    'multiple' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$selectId = $id ?? 'gm-select-' . uniqid();
$classes = ['gm-select', "gm-select--{$size}"];
if ($error) $classes[] = 'gm-select--error';
if ($disabled) $classes[] = 'gm-select--disabled';
?>

<div <?php echo e($attributes->merge(['class' => 'gm-form-field'])); ?>>
    <?php if($label): ?>
        <label for="<?php echo e($selectId); ?>" class="gm-label"><?php echo e($label); ?> <?php if($required): ?><span class="gm-label__required" aria-hidden="true">*</span><?php endif; ?></label>
    <?php endif; ?>

    <select
        id="<?php echo e($selectId); ?>"
        name="<?php echo e($name); ?><?php echo e($multiple ? '[]' : ''); ?>"
        class="<?php echo e(implode(' ', $classes)); ?>"
        <?php if($disabled): ?> disabled <?php endif; ?>
        <?php if($multiple): ?> multiple <?php endif; ?>
        <?php if($error): ?> aria-invalid="true" aria-describedby="<?php echo e($selectId); ?>-error" <?php endif; ?>
        <?php echo e($attributes->except(['class', 'id', 'name', 'disabled', 'multiple'])); ?>

    >
        <?php if($placeholder && !$multiple): ?>
            <option value="" disabled <?php echo e(is_null(old($name, $value)) ? 'selected' : ''); ?>><?php echo e($placeholder); ?></option>
        <?php endif; ?>
        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($key); ?>" <?php echo e((old($name, $value) == $key) ? 'selected' : ''); ?>><?php echo e($label); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <?php if($error): ?>
        <p id="<?php echo e($selectId); ?>-error" class="gm-error-text" role="alert"><?php echo e($error); ?></p>
    <?php elseif($help): ?>
        <p id="<?php echo e($selectId); ?>-help" class="gm-help-text"><?php echo e($help); ?></p>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\select.blade.php ENDPATH**/ ?>