<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'fields' => [],
    'columns' => 2,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'fields' => [],
    'columns' => 2,
]); ?>
<?php foreach (array_filter(([
    'fields' => [],
    'columns' => 2,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-admin-form-row'];
if ($columns === 1) $classes[] = 'gm-admin-form-row--single';
elseif ($columns === 3) $classes[] = 'gm-admin-form-row--three';
elseif ($columns === 4) $classes[] = 'gm-admin-form-row--four';
$class = implode(' ', $classes);
?>

<div <?php echo e($attributes->merge(['class' => $class])); ?>>
    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $key = $field['key'] ?? '';
            $label = $field['label'] ?? ucfirst($key);
            $type = $field['type'] ?? 'text';
            $required = $field['required'] ?? false;
            $value = $field['value'] ?? old($key);
            $error = $field['error'] ?? $errors->first($key);
            $help = $field['help'] ?? null;
            $options = $field['options'] ?? [];
            $placeholder = $field['placeholder'] ?? '';
            $disabled = $field['disabled'] ?? false;
            $attributesStr = $field['attributes'] ?? [];
        ?>

        <div class="gm-admin-form-row__field">
            <label for="<?php echo e($key); ?>" class="gm-admin-form-row__label<?php echo e($required ? ' gm-admin-form-row__label--required' : ''); ?>">
                <?php echo e($label); ?>

            </label>

            <?php if($type === 'textarea'): ?>
                <textarea
                    id="<?php echo e($key); ?>"
                    name="<?php echo e($key); ?>"
                    class="gm-admin-form-row__textarea<?php echo e($error ? ' gm-admin-form-row__textarea--error' : ''); ?>"
                    placeholder="<?php echo e($placeholder); ?>"
                    <?php if($disabled): ?> disabled <?php endif; ?>
                    <?php echo e(collect($attributesStr)->map(fn($v, $k) => "$k=\"$v\"")->implode(' ')); ?>

                ><?php echo e($value); ?></textarea>
            <?php elseif($type === 'select'): ?>
                <select
                    id="<?php echo e($key); ?>"
                    name="<?php echo e($key); ?>"
                    class="gm-admin-form-row__select<?php echo e($error ? ' gm-admin-form-row__select--error' : ''); ?>"
                    <?php if($disabled): ?> disabled <?php endif; ?>
                    <?php echo e(collect($attributesStr)->map(fn($v, $k) => "$k=\"$v\"")->implode(' ')); ?>

                >
                    <?php if($placeholder): ?>
                        <option value="" disabled <?php echo e(is_null($value) ? 'selected' : ''); ?>><?php echo e($placeholder); ?></option>
                    <?php endif; ?>
                    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optKey => $optLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($optKey); ?>" <?php echo e($value == $optKey ? 'selected' : ''); ?>><?php echo e($optLabel); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            <?php elseif($type === 'checkbox'): ?>
                <div class="gm-checkbox">
                    <input
                        type="checkbox"
                        id="<?php echo e($key); ?>"
                        name="<?php echo e($key); ?>"
                        value="<?php echo e($field['value'] ?? '1'); ?>"
                        class="gm-checkbox__input"
                        <?php if($value): ?> checked <?php endif; ?>
                        <?php if($disabled): ?> disabled <?php endif; ?>
                    >
                    <span class="gm-checkbox__box" aria-hidden="true"></span>
                    <label for="<?php echo e($key); ?>" class="gm-checkbox__label"><?php echo e($label); ?></label>
                </div>
            <?php elseif($type === 'image'): ?>
                <div class="gm-admin-image-uploader">
                    <div class="gm-admin-image-uploader__dropzone <?php echo e($value ? 'has-image' : ''); ?>" data-image-uploader>
                        <input
                            type="file"
                            name="<?php echo e($key); ?>"
                            id="<?php echo e($key); ?>"
                            accept="image/*"
                            class="gm-admin-image-uploader__input"
                            <?php if($disabled): ?> disabled <?php endif; ?>
                        >
                        <?php if($value): ?>
                            <img src="<?php echo e($value); ?>" alt="" class="gm-admin-image-uploader__preview">
                            <button type="button" class="gm-admin-image-uploader__remove" aria-label="Remove image">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        <?php else: ?>
                            <div class="gm-admin-image-uploader__placeholder">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                <span>Click or drag to upload</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if($help): ?>
                        <p class="gm-admin-image-uploader__hint"><?php echo e($help); ?></p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <input
                    type="<?php echo e($type); ?>"
                    id="<?php echo e($key); ?>"
                    name="<?php echo e($key); ?>"
                    value="<?php echo e($value); ?>"
                    class="gm-admin-form-row__input<?php echo e($error ? ' gm-admin-form-row__input--error' : ''); ?>"
                    placeholder="<?php echo e($placeholder); ?>"
                    <?php if($disabled): ?> disabled <?php endif; ?>
                    <?php if($required): ?> required <?php endif; ?>
                    <?php echo e(collect($attributesStr)->map(fn($v, $k) => "$k=\"$v\"")->implode(' ')); ?>

                >
            <?php endif; ?>

            <?php if($error): ?>
                <p class="gm-admin-form-row__error"><?php echo e($error); ?></p>
            <?php elseif($help): ?>
                <p class="gm-admin-form-row__help"><?php echo e($help); ?></p>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\admin\form-row.blade.php ENDPATH**/ ?>