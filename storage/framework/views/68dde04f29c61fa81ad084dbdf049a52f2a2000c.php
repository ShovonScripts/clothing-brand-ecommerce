<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'current' => 0,
    'original' => null,
    'currency' => 'BDT',
    'size' => 'md',
    'context' => 'default',
    'showDiscount' => true,
    'perUnit' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'current' => 0,
    'original' => null,
    'currency' => 'BDT',
    'size' => 'md',
    'context' => 'default',
    'showDiscount' => true,
    'perUnit' => null,
]); ?>
<?php foreach (array_filter(([
    'current' => 0,
    'original' => null,
    'currency' => 'BDT',
    'size' => 'md',
    'context' => 'default',
    'showDiscount' => true,
    'perUnit' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-price', "gm-price--{$size}", "gm-price--{$context}"];
if ($showDiscount && $original && $original > $current) $classes[] = 'gm-price--inline-sale';
$class = implode(' ', $classes);

$symbol = $currency === 'BDT' ? '৳' : '$';
$currentFormatted = number_format($current, 2);
$originalFormatted = $original ? number_format($original, 2) : null;
$discountPercent = ($original && $original > $current) ? round((($original - $current) / $original) * 100) : null;
?>

<div <?php echo e($attributes->merge(['class' => $class])); ?>>
    <span class="gm-price__currency" aria-hidden="true"><?php echo e($symbol); ?></span>
    <span class="gm-price__current"><?php echo e($currentFormatted); ?></span>

    <?php if($original && $original > $current): ?>
        <span class="gm-price__original"><?php echo e($symbol); ?><?php echo e($originalFormatted); ?></span>
        <?php if($showDiscount && $discountPercent): ?>
            <span class="gm-price__discount">-<?php echo e($discountPercent); ?>%</span>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($perUnit): ?>
        <span class="gm-price__unit">/<?php echo e($perUnit); ?></span>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/components/ui/price.blade.php ENDPATH**/ ?>