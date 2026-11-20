<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    // Cart key = variation id (see Frontend\CartController).
    'id' => null,
    'image' => null,
    'name' => null,
    'href' => '#',
    'variant' => [],
    'price' => 0,
    'originalPrice' => null,
    'quantity' => 1,
    'maxQuantity' => 99,
    'stock' => null,
    // false = read-only line (e.g. checkout summary): shows the quantity, no controls.
    'editable' => true,
    'drawer' => false,
    // Accepted for backwards compatibility; behaviour now comes from data attributes.
    'onQuantityChange' => null,
    'onRemove' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    // Cart key = variation id (see Frontend\CartController).
    'id' => null,
    'image' => null,
    'name' => null,
    'href' => '#',
    'variant' => [],
    'price' => 0,
    'originalPrice' => null,
    'quantity' => 1,
    'maxQuantity' => 99,
    'stock' => null,
    // false = read-only line (e.g. checkout summary): shows the quantity, no controls.
    'editable' => true,
    'drawer' => false,
    // Accepted for backwards compatibility; behaviour now comes from data attributes.
    'onQuantityChange' => null,
    'onRemove' => null,
]); ?>
<?php foreach (array_filter(([
    // Cart key = variation id (see Frontend\CartController).
    'id' => null,
    'image' => null,
    'name' => null,
    'href' => '#',
    'variant' => [],
    'price' => 0,
    'originalPrice' => null,
    'quantity' => 1,
    'maxQuantity' => 99,
    'stock' => null,
    // false = read-only line (e.g. checkout summary): shows the quantity, no controls.
    'editable' => true,
    'drawer' => false,
    // Accepted for backwards compatibility; behaviour now comes from data attributes.
    'onQuantityChange' => null,
    'onRemove' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>


<?php
    $variant = array_filter((array) $variant, fn ($v) => filled($v));
?>

<div <?php echo e($attributes->merge(['class' => 'gm-cart-line' . ($drawer ? ' gm-cart-line--drawer' : ''), 'data-cart-line-id' => $id])); ?>>
    <a href="<?php echo e($href); ?>" class="gm-cart-line__image-wrapper" aria-label="<?php echo e($name); ?>">
        <?php if($image): ?>
            <img src="<?php echo e($image); ?>" alt="" class="gm-cart-line__image" loading="lazy" width="160" height="160">
        <?php else: ?>
            <div class="gm-skeleton gm-skeleton--box" aria-hidden="true"></div>
        <?php endif; ?>
    </a>

    <div class="gm-cart-line__details">
        <a href="<?php echo e($href); ?>" class="gm-cart-line__link">
            <h3 class="gm-cart-line__name"><?php echo e($name); ?></h3>
        </a>

        <?php if($variant): ?>
            <div class="gm-cart-line__variant">
                <?php $__currentLoopData = $variant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="gm-cart-line__variant-item">
                        <span class="gm-cart-line__variant-label"><?php echo e($key); ?>:</span>
                        <span class="gm-cart-line__variant-value"><?php echo e($value); ?></span>
                    </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.price','data' => ['current' => $price,'original' => $originalPrice,'context' => 'cart','class' => 'gm-cart-line__price']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.price'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($price),'original' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($originalPrice),'context' => 'cart','class' => 'gm-cart-line__price']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    </div>

    <div class="gm-cart-line__quantity">
        <?php if($editable): ?>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.quantity-stepper','data' => ['name' => 'quantity_' . $id,'value' => $quantity,'min' => 1,'max' => $maxQuantity,'stock' => $stock,'inline' => true,'dataGmCartQty' => $id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.quantity-stepper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('quantity_' . $id),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($quantity),'min' => 1,'max' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($maxQuantity),'stock' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($stock),'inline' => true,'data-gm-cart-qty' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        <?php else: ?>
            <span class="gm-cart-line__qty-text">Qty: <?php echo e($quantity); ?></span>
        <?php endif; ?>
    </div>

    <?php if($editable): ?>
        <button type="button" class="gm-cart-line__remove" data-gm-cart-remove="<?php echo e($id); ?>" aria-label="Remove <?php echo e($name); ?> from bag">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
        </button>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\cart-line.blade.php ENDPATH**/ ?>