<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'label' => null,
    'placeholder' => null,
    'error' => null,
    'help' => null,
    'disabled' => false,
    'readonly' => false,
    'size' => 'md',
    'rows' => 4,
    'id' => null,
    'name' => null,
    'value' => null,
    'required' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'label' => null,
    'placeholder' => null,
    'error' => null,
    'help' => null,
    'disabled' => false,
    'readonly' => false,
    'size' => 'md',
    'rows' => 4,
    'id' => null,
    'name' => null,
    'value' => null,
    'required' => false,
]); ?>
<?php foreach (array_filter(([
    'label' => null,
    'placeholder' => null,
    'error' => null,
    'help' => null,
    'disabled' => false,
    'readonly' => false,
    'size' => 'md',
    'rows' => 4,
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
$textareaId = $id ?? 'gm-textarea-' . uniqid();
$classes = ['gm-textarea', "gm-textarea--{$size}"];
if ($error) $classes[] = 'gm-textarea--error';
if ($disabled) $classes[] = 'gm-textarea--disabled';
if ($readonly) $classes[] = 'gm-textarea--readonly';
?>

<div <?php echo e($attributes->merge(['class' => 'gm-form-field'])); ?>>
    <?php if($label): ?>
        <label for="<?php echo e($textareaId); ?>" class="gm-label"><?php echo e($label); ?> <?php if($required): ?><span class="gm-label__required" aria-hidden="true">*</span><?php endif; ?></label>
    <?php endif; ?>

    <textarea
        id="<?php echo e($textareaId); ?>"
        name="<?php echo e($name); ?>"
        rows="<?php echo e($rows); ?>"
        class="<?php echo e(implode(' ', $classes)); ?>"
        placeholder="<?php echo e($placeholder); ?>"
        <?php if($disabled): ?> disabled <?php endif; ?>
        <?php if($readonly): ?> readonly <?php endif; ?>
        <?php if($error): ?> aria-invalid="true" aria-describedby="<?php echo e($textareaId); ?>-error" <?php endif; ?>
        <?php echo e($attributes->except(['class', 'id', 'name', 'rows', 'placeholder', 'disabled', 'readonly'])); ?>

    ><?php echo e(old($name, $value)); ?></textarea>

    <?php if($error): ?>
        <p id="<?php echo e($textareaId); ?>-error" class="gm-error-text" role="alert"><?php echo e($error); ?></p>
    <?php elseif($help): ?>
        <p id="<?php echo e($textareaId); ?>-help" class="gm-help-text"><?php echo e($help); ?></p>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\textarea.blade.php ENDPATH**/ ?>