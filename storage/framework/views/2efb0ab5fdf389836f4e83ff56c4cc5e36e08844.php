<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'subtotal' => 0,
    // null = not known yet (the delivery area is chosen at checkout).
    'shipping' => null,
    'shippingLabel' => 'Calculated at checkout',
    // Money taken off the total (e.g. a coupon).
    'discount' => 0,
    // Informational only: what product markdowns already saved (prices are already reduced).
    'savings' => 0,
    // Defaults to subtotal + shipping - discount.
    'total' => null,
    'variant' => 'default',
    'actionText' => 'Proceed to checkout',
    // null = no action button.
    'actionUrl' => null,
    // Ignored, kept so older callers don't render them as HTML attributes:
    // the store currency comes from priceFormate(), and the store has no free-shipping threshold.
    'currency' => null,
    'freeShippingThreshold' => null,
    'tax' => 0,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'subtotal' => 0,
    // null = not known yet (the delivery area is chosen at checkout).
    'shipping' => null,
    'shippingLabel' => 'Calculated at checkout',
    // Money taken off the total (e.g. a coupon).
    'discount' => 0,
    // Informational only: what product markdowns already saved (prices are already reduced).
    'savings' => 0,
    // Defaults to subtotal + shipping - discount.
    'total' => null,
    'variant' => 'default',
    'actionText' => 'Proceed to checkout',
    // null = no action button.
    'actionUrl' => null,
    // Ignored, kept so older callers don't render them as HTML attributes:
    // the store currency comes from priceFormate(), and the store has no free-shipping threshold.
    'currency' => null,
    'freeShippingThreshold' => null,
    'tax' => 0,
]); ?>
<?php foreach (array_filter(([
    'subtotal' => 0,
    // null = not known yet (the delivery area is chosen at checkout).
    'shipping' => null,
    'shippingLabel' => 'Calculated at checkout',
    // Money taken off the total (e.g. a coupon).
    'discount' => 0,
    // Informational only: what product markdowns already saved (prices are already reduced).
    'savings' => 0,
    // Defaults to subtotal + shipping - discount.
    'total' => null,
    'variant' => 'default',
    'actionText' => 'Proceed to checkout',
    // null = no action button.
    'actionUrl' => null,
    // Ignored, kept so older callers don't render them as HTML attributes:
    // the store currency comes from priceFormate(), and the store has no free-shipping threshold.
    'currency' => null,
    'freeShippingThreshold' => null,
    'tax' => 0,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $grandTotal = $total ?? ($subtotal + ($shipping ?? 0) - $discount);
?>

<div <?php echo e($attributes->merge(['class' => "gm-order-summary gm-order-summary--{$variant}"])); ?>>
    <h2 class="gm-order-summary__title">Order summary</h2>

    <div class="gm-order-summary__rows">
        <div class="gm-order-summary__row gm-order-summary__row--subtotal">
            <span class="gm-order-summary__label">Subtotal</span>
            <span class="gm-order-summary__value" data-gm-summary="subtotal"><?php echo e(priceFormate($subtotal)); ?></span>
        </div>

        <div class="gm-order-summary__row gm-order-summary__row--shipping">
            <span class="gm-order-summary__label">Delivery</span>
            <span class="gm-order-summary__value" data-gm-summary="shipping">
                <?php echo e($shipping === null ? $shippingLabel : ($shipping > 0 ? priceFormate($shipping) : 'Free')); ?>

            </span>
        </div>

        <div class="gm-order-summary__row gm-order-summary__row--discount" data-gm-summary-row="discount" <?php if($discount <= 0): ?> hidden <?php endif; ?>>
            <span class="gm-order-summary__label">Discount</span>
            <span class="gm-order-summary__value" data-gm-summary="discount">−<?php echo e(priceFormate($discount)); ?></span>
        </div>

        <?php if($tax > 0): ?>
            <div class="gm-order-summary__row">
                <span class="gm-order-summary__label">Tax</span>
                <span class="gm-order-summary__value"><?php echo e(priceFormate($tax)); ?></span>
            </div>
        <?php endif; ?>
    </div>

    <div class="gm-order-summary__divider"></div>

    <div class="gm-order-summary__total">
        <span class="gm-order-summary__label">Total</span>
        <span class="gm-order-summary__value gm-order-summary__total-value" data-gm-summary="total"><?php echo e(priceFormate($grandTotal)); ?></span>
    </div>

    <?php if($savings > 0): ?>
        <p class="gm-order-summary__shipping-notice gm-order-summary__shipping-notice--free">
            You save <?php echo e(priceFormate($savings)); ?> on this order
        </p>
    <?php endif; ?>

    <?php echo e($slot); ?>


    <?php if($actionUrl): ?>
        <div class="gm-order-summary__actions">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','size' => 'lg','full' => true,'href' => $actionUrl]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','full' => true,'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionUrl)]); ?><?php echo e($actionText); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            <?php if($variant === 'cart'): ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'ghost','size' => 'md','full' => true,'href' => route('front.products.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'md','full' => true,'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('front.products.index'))]); ?>Continue shopping <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/components/ui/order-summary.blade.php ENDPATH**/ ?>