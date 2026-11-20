<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'variant' => 'primary',
    'size' => 'md',
    'full' => false,
    'loading' => false,
    'disabled' => false,
    'icon' => null,
    'iconPosition' => 'left',
    'tag' => 'button',
    'href' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'variant' => 'primary',
    'size' => 'md',
    'full' => false,
    'loading' => false,
    'disabled' => false,
    'icon' => null,
    'iconPosition' => 'left',
    'tag' => 'button',
    'href' => null,
]); ?>
<?php foreach (array_filter(([
    'variant' => 'primary',
    'size' => 'md',
    'full' => false,
    'loading' => false,
    'disabled' => false,
    'icon' => null,
    'iconPosition' => 'left',
    'tag' => 'button',
    'href' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    // A button with an href is rendered as a link.
    $isLink = filled($href);
    $element = $isLink ? 'a' : $tag;

    $classes = ['gm-btn', "gm-btn--{$variant}", "gm-btn--{$size}"];
    if ($full) $classes[] = 'gm-btn--full';
    if ($loading) $classes[] = 'gm-btn--loading';
    if ($disabled) $classes[] = 'gm-btn--disabled';

    // Defaults; anything the caller passes (e.g. type="submit") wins over these,
    // except `class`, which is appended.
    $defaults = ['class' => implode(' ', $classes)];
    if ($isLink) {
        $defaults['href'] = $href;
        if ($disabled) {
            $defaults['aria-disabled'] = 'true';
            $defaults['tabindex'] = '-1';
        }
    } elseif ($element === 'button') {
        $defaults['type'] = 'button';
        if ($disabled || $loading) $defaults['disabled'] = true;
    }
    if ($loading) $defaults['aria-busy'] = 'true';
?>

<<?php echo e($element); ?> <?php echo e($attributes->merge($defaults)); ?>>
    <?php if($icon && $iconPosition === 'left'): ?>
        <span class="gm-btn__icon gm-btn__icon--left" aria-hidden="true"><?php echo e($icon); ?></span>
    <?php endif; ?>
    <span class="gm-btn__text"><?php echo e($slot); ?></span>
    <?php if($icon && $iconPosition === 'right'): ?>
        <span class="gm-btn__icon gm-btn__icon--right" aria-hidden="true"><?php echo e($icon); ?></span>
    <?php endif; ?>
</<?php echo e($element); ?>>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/components/ui/button.blade.php ENDPATH**/ ?>