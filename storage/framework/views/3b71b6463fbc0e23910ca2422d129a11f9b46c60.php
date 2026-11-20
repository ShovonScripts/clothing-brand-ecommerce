<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'name' => null,
    'label' => null,
    'options' => [],
    'selected' => null,
    'type' => 'radio',
    'colorKey' => 'color',
    'size' => 'md',
    'onChange' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'name' => null,
    'label' => null,
    'options' => [],
    'selected' => null,
    'type' => 'radio',
    'colorKey' => 'color',
    'size' => 'md',
    'onChange' => null,
]); ?>
<?php foreach (array_filter(([
    'name' => null,
    'label' => null,
    'options' => [],
    'selected' => null,
    'type' => 'radio',
    'colorKey' => 'color',
    'size' => 'md',
    'onChange' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$groupId = $attributes->get('id') ?? 'gm-swatch-group-' . uniqid();
?>

<div <?php echo e($attributes->merge(['class' => 'gm-variant-swatch-group', 'id' => $groupId])); ?>>
    <?php if($label): ?>
        <span class="gm-variant-swatch-group__label"><?php echo e($label); ?></span>
    <?php endif; ?>

    <div class="gm-variant-swatch-group__swatches" role="radiogroup" aria-label="<?php echo e($label); ?>">
        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $value = $option['value'] ?? $option;
                $labelText = $option['label'] ?? $value;
                $color = $option[$colorKey] ?? null;
                $disabled = $option['disabled'] ?? false;
                $isSelected = $selected == $value;
            ?>

            <?php if($type === 'radio'): ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.variant-swatch','data' => ['name' => $name,'value' => $value,'label' => $labelText,'selected' => $isSelected,'disabled' => $disabled,'color' => $color,'size' => $size,'onSelect' => $onChange,'id' => ''.e($groupId).'-'.e($value).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.variant-swatch'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($name),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($value),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($labelText),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isSelected),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($disabled),'color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($size),'onSelect' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($onChange),'id' => ''.e($groupId).'-'.e($value).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            <?php else: ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.chip','data' => ['selected' => $isSelected,'disabled' => $disabled,'size' => $size,'onSelect' => $onChange]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.chip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isSelected),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($disabled),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($size),'onSelect' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($onChange)]); ?>
                    <?php echo e($labelText); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if($selected && $onChange): ?>
        <span class="gm-variant-swatch-group__selected-value">
            Selected: <?php echo e(collect($options)->firstWhere('value', $selected)['label'] ?? $selected); ?>

        </span>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\variant-swatch-group.blade.php ENDPATH**/ ?>