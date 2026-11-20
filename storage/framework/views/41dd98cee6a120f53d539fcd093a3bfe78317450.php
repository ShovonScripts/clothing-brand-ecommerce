<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'type' => 'text',
    'label' => null,
    'placeholder' => null,
    'error' => null,
    'help' => null,
    'icon' => null,
    'iconPosition' => 'left',
    'disabled' => false,
    'readonly' => false,
    'size' => 'md',
    'id' => null,
    'name' => null,
    'value' => null,
    'required' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'type' => 'text',
    'label' => null,
    'placeholder' => null,
    'error' => null,
    'help' => null,
    'icon' => null,
    'iconPosition' => 'left',
    'disabled' => false,
    'readonly' => false,
    'size' => 'md',
    'id' => null,
    'name' => null,
    'value' => null,
    'required' => false,
]); ?>
<?php foreach (array_filter(([
    'type' => 'text',
    'label' => null,
    'placeholder' => null,
    'error' => null,
    'help' => null,
    'icon' => null,
    'iconPosition' => 'left',
    'disabled' => false,
    'readonly' => false,
    'size' => 'md',
    'id' => null,
    'name' => null,
    'value' => null,
    'required' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$inputId = $id ?? 'gm-input-' . uniqid();
$wrapperClasses = ['gm-input-wrapper'];
$inputClasses = ['gm-input', "gm-input--{$size}"];
if ($error) $inputClasses[] = 'gm-input--error';
if ($disabled) $inputClasses[] = 'gm-input--disabled';
if ($readonly) $inputClasses[] = 'gm-input--readonly';
if ($icon) {
    $wrapperClasses[] = 'gm-input-wrapper--with-icon';
    $inputClasses[] = $iconPosition === 'left' ? 'gm-input--with-icon-start' : 'gm-input--with-icon-end';
}
?>

<div <?php echo e($attributes->merge(['class' => implode(' ', $wrapperClasses)])); ?>>
    <?php if($label): ?>
        <label for="<?php echo e($inputId); ?>" class="gm-label"><?php echo e($label); ?> <?php if($required): ?><span class="gm-label__required" aria-hidden="true">*</span><?php endif; ?></label>
    <?php endif; ?>

    <?php if($icon && $iconPosition === 'left'): ?>
        <span class="gm-input-icon gm-input-icon--start" aria-hidden="true"><?php echo e($icon); ?></span>
    <?php endif; ?>

    <input
        type="<?php echo e($type); ?>"
        id="<?php echo e($inputId); ?>"
        name="<?php echo e($name); ?>"
        value="<?php echo e(old($name, $value)); ?>"
        class="<?php echo e(implode(' ', $inputClasses)); ?>"
        placeholder="<?php echo e($placeholder); ?>"
        <?php if($disabled): ?> disabled <?php endif; ?>
        <?php if($readonly): ?> readonly <?php endif; ?>
        <?php if($error): ?> aria-invalid="true" aria-describedby="<?php echo e($inputId); ?>-error" <?php endif; ?>
        <?php echo e($attributes->except(['class', 'id', 'name', 'value', 'placeholder', 'disabled', 'readonly'])); ?>

    />

    <?php if($icon && $iconPosition === 'right'): ?>
        <span class="gm-input-icon gm-input-icon--end" aria-hidden="true"><?php echo e($icon); ?></span>
    <?php endif; ?>

    <?php if($error): ?>
        <p id="<?php echo e($inputId); ?>-error" class="gm-error-text" role="alert"><?php echo e($error); ?></p>
    <?php elseif($help): ?>
        <p id="<?php echo e($inputId); ?>-help" class="gm-help-text"><?php echo e($help); ?></p>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\input.blade.php ENDPATH**/ ?>