<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'dirty' => false,
    'saving' => false,
    'onSave' => null,
    'onCancel' => null,
    'saveText' => 'Save',
    'cancelText' => 'Cancel',
    'showCancel' => true,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'dirty' => false,
    'saving' => false,
    'onSave' => null,
    'onCancel' => null,
    'saveText' => 'Save',
    'cancelText' => 'Cancel',
    'showCancel' => true,
]); ?>
<?php foreach (array_filter(([
    'dirty' => false,
    'saving' => false,
    'onSave' => null,
    'onCancel' => null,
    'saveText' => 'Save',
    'cancelText' => 'Cancel',
    'showCancel' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="gm-admin-save-bar" <?php echo e($attributes); ?>>
    <div class="gm-admin-save-bar__left">
        <span class="gm-admin-save-bar__status">
            <span class="gm-admin-save-bar__status-indicator<?php echo e($dirty ? ' gm-admin-save-bar__status-indicator--dirty' : ''); ?><?php echo e($saving ? ' gm-admin-save-bar__status-indicator--saving' : ''); ?>"></span>
            <span>
                <?php if($saving): ?>
                    Saving...
                <?php elseif($dirty): ?>
                    Unsaved changes
                <?php else: ?>
                    Saved
                <?php endif; ?>
            </span>
        </span>
    </div>

    <div class="gm-admin-save-bar__right">
        <?php if($showCancel): ?>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'ghost','size' => 'md','disabled' => $saving]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'md','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($saving)]); ?><?php echo e($cancelText); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        <?php endif; ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','size' => 'md','class' => 'gm-admin-save-bar__btn','type' => 'submit','loading' => $saving,'disabled' => $saving]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','class' => 'gm-admin-save-bar__btn','type' => 'submit','loading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($saving),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($saving)]); ?><?php echo e($saveText); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    </div>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\admin\save-bar.blade.php ENDPATH**/ ?>