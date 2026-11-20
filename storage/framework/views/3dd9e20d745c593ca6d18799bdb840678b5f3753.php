<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'name' => null,
    'label' => null,
    'value' => null,
    'selected' => false,
    'disabled' => false,
    'color' => null,
    'size' => 'md',
    'onSelect' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'name' => null,
    'label' => null,
    'value' => null,
    'selected' => false,
    'disabled' => false,
    'color' => null,
    'size' => 'md',
    'onSelect' => null,
]); ?>
<?php foreach (array_filter(([
    'name' => null,
    'label' => null,
    'value' => null,
    'selected' => false,
    'disabled' => false,
    'color' => null,
    'size' => 'md',
    'onSelect' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-variant-swatch', "gm-variant-swatch--{$size}"];
if ($color) $classes[] = 'gm-variant-swatch--color';
if ($selected) $classes[] = 'gm-variant-swatch--selected';
if ($disabled) $classes[] = 'gm-variant-swatch--disabled';

$style = '';
if ($color) $style = 'style="--swatch-color: ' . e($color) . '"';
?>

<?php
    $id = $attributes->get('id') ?? 'gm-swatch-' . uniqid();
?>

<?php if($onSelect): ?>
    <button
        type="button"
        class="<?php echo e(implode(' ', $classes)); ?>"
        <?php echo e($style); ?>

        <?php if($disabled): ?> disabled <?php endif; ?>
        <?php echo e($attributes->except(['class', 'disabled', 'style'])); ?>

        aria-pressed="<?php echo e($selected ? 'true' : 'false'); ?>"
        aria-label="<?php echo e($label ?: $value); ?>"
    >
        <?php if(!$color): ?> <?php echo e($label ?? $value); ?> <?php endif; ?>
    </button>
<?php else: ?>
    <input
        type="radio"
        name="<?php echo e($name); ?>"
        value="<?php echo e($value); ?>"
        id="<?php echo e($id); ?>"
        class="gm-variant-swatch__input"
        <?php if($selected): ?> checked <?php endif; ?>
        <?php if($disabled): ?> disabled <?php endif; ?>
        <?php echo e($attributes->except(['class', 'id', 'value', 'checked', 'disabled'])); ?>

    >
    <label
        for="<?php echo e($id); ?>"
        class="<?php echo e(implode(' ', $classes)); ?>"
        <?php echo e($style); ?>

        <?php echo e($attributes->except(['class', 'for', 'style'])); ?>

    >
        <?php if(!$color): ?> <?php echo e($label ?? $value); ?> <?php endif; ?>
    </label>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\variant-swatch.blade.php ENDPATH**/ ?>