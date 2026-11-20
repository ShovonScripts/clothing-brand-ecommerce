<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'name' => null,
    'value' => null,
    'label' => null,
    'help' => null,
    'error' => null,
    'disabled' => false,
    'multiple' => false,
    'accept' => 'image/*',
    'maxSize' => 5120, // KB
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'name' => null,
    'value' => null,
    'label' => null,
    'help' => null,
    'error' => null,
    'disabled' => false,
    'multiple' => false,
    'accept' => 'image/*',
    'maxSize' => 5120, // KB
]); ?>
<?php foreach (array_filter(([
    'name' => null,
    'value' => null,
    'label' => null,
    'help' => null,
    'error' => null,
    'disabled' => false,
    'multiple' => false,
    'accept' => 'image/*',
    'maxSize' => 5120, // KB
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$dropzoneId = 'gm-dropzone-' . uniqid();
$inputId = $name ?? 'gm-upload-' . uniqid();
?>

<div <?php echo e($attributes->merge(['class' => 'gm-admin-image-uploader'])); ?>>
    <?php if($label): ?>
        <label for="<?php echo e($inputId); ?>" class="gm-admin-form-row__label"><?php echo e($label); ?></label>
    <?php endif; ?>

    <div class="gm-admin-image-uploader__dropzone <?php echo e($value ? 'has-image' : ''); ?>" id="<?php echo e($dropzoneId); ?>" data-image-uploader>
        <input
            type="file"
            name="<?php echo e($name); ?>"
            id="<?php echo e($inputId); ?>"
            accept="<?php echo e($accept); ?>"
            <?php if($multiple): ?> multiple <?php endif; ?>
            class="gm-admin-image-uploader__input"
            <?php if($disabled): ?> disabled <?php endif; ?>
        >

        <?php if($value): ?>
            <?php if(is_array($value)): ?>
                <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="position: relative; display: inline-block; margin: var(--s-2);">
                        <img src="<?php echo e($img); ?>" alt="" class="gm-admin-image-uploader__preview" style="max-width: 120px; max-height: 120px;">
                        <button type="button" class="gm-admin-image-uploader__remove" aria-label="Remove image">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <img src="<?php echo e($value); ?>" alt="" class="gm-admin-image-uploader__preview" style="max-width: 100%; max-height: 160px;">
                <button type="button" class="gm-admin-image-uploader__remove" aria-label="Remove image">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            <?php endif; ?>
        <?php else: ?>
            <div class="gm-admin-image-uploader__placeholder">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                <span>Click or drag to upload</span>
                <?php if($maxSize): ?>
                    <small style="color: var(--c-ink-300);">Max <?php echo e($maxSize / 1024); ?>MB</small>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if($error): ?>
        <p class="gm-admin-form-row__error"><?php echo e($error); ?></p>
    <?php elseif($help): ?>
        <p class="gm-admin-image-uploader__hint"><?php echo e($help); ?></p>
    <?php endif; ?>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    (function() {
        const dropzone = document.getElementById('<?php echo e($dropzoneId); ?>');
        const input = document.getElementById('<?php echo e($inputId); ?>');
        if (!dropzone || !input) return;

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, () => dropzone.classList.add('dragover'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, () => dropzone.classList.remove('dragover'), false);
        });

        dropzone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length) {
                input.files = files;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        }, false);

        dropzone.addEventListener('click', () => input.click());
    })();
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\admin\image-uploader.blade.php ENDPATH**/ ?>