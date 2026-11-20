<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'product' => null,
    'image' => null,
    'name' => null,
    'price' => null,
    'originalPrice' => null,
    'category' => null,
    'rating' => null,
    'reviewCount' => 0,
    'badges' => [],
    'href' => '#',
    'wishlistId' => null,
    'inWishlist' => false,
    'quickView' => false,
    'horizontal' => false,
    'stock' => 'in-stock',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'product' => null,
    'image' => null,
    'name' => null,
    'price' => null,
    'originalPrice' => null,
    'category' => null,
    'rating' => null,
    'reviewCount' => 0,
    'badges' => [],
    'href' => '#',
    'wishlistId' => null,
    'inWishlist' => false,
    'quickView' => false,
    'horizontal' => false,
    'stock' => 'in-stock',
]); ?>
<?php foreach (array_filter(([
    'product' => null,
    'image' => null,
    'name' => null,
    'price' => null,
    'originalPrice' => null,
    'category' => null,
    'rating' => null,
    'reviewCount' => 0,
    'badges' => [],
    'href' => '#',
    'wishlistId' => null,
    'inWishlist' => false,
    'quickView' => false,
    'horizontal' => false,
    'stock' => 'in-stock',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-product-card'];
if ($horizontal) $classes[] = 'gm-product-card--horizontal';
$class = implode(' ', $classes);
?>

<article <?php echo e($attributes->merge(['class' => $class])); ?>>
    <a href="<?php echo e($href); ?>" class="gm-product-card__link" aria-label="<?php echo e($name); ?>">
        <div class="gm-product-card__image-wrapper">
            <?php if($image): ?>
                <img src="<?php echo e($image); ?>" alt="" class="gm-product-card__image" loading="lazy" width="400" height="400">
            <?php else: ?>
                <div class="gm-skeleton gm-skeleton--box" aria-hidden="true"></div>
            <?php endif; ?>

            <?php if($badges): ?>
                <div class="gm-product-card__badges" aria-label="Product badges">
                    <?php $__currentLoopData = $badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => $badge['variant'] ?? 'neutral','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badge['variant'] ?? 'neutral'),'size' => 'sm']); ?><?php echo e($badge['label']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <?php if($wishlistId !== null): ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.wishlist-button','data' => ['id' => $wishlistId,'active' => $inWishlist,'class' => 'gm-product-card__wishlist','dataTooltip' => 'Add to wishlist']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.wishlist-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($wishlistId),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($inWishlist),'class' => 'gm-product-card__wishlist','data-tooltip' => 'Add to wishlist']); ?>
                    <svg class="gm-wishlist-button__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php if($quickView): ?>
                <button type="button" class="gm-btn gm-btn--ghost gm-btn--sm gm-product-card__quick-view">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    Quick View
                </button>
            <?php endif; ?>
        </div>

        <div class="gm-product-card__content">
            <?php if($category): ?>
                <div class="gm-product-card__meta">
                    <span class="gm-product-card__category"><?php echo e($category); ?></span>
                </div>
            <?php endif; ?>

            <h3 class="gm-product-card__name"><?php echo e($name); ?></h3>

            <?php if($rating !== null): ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.rating','data' => ['value' => $rating,'count' => $reviewCount,'readonly' => true,'size' => 'sm','class' => 'gm-product-card__rating']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.rating'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($rating),'count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($reviewCount),'readonly' => true,'size' => 'sm','class' => 'gm-product-card__rating']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            <?php endif; ?>

            <div class="gm-product-card__price-wrapper">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.price','data' => ['current' => $price,'original' => $originalPrice,'class' => 'gm-product-card__price']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.price'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($price),'original' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($originalPrice),'class' => 'gm-product-card__price']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>
        </div>
    </a>

    
    <?php if(isset($actions)): ?>
        <div class="gm-product-card__actions">
            <?php echo e($actions); ?>

        </div>
    <?php endif; ?>
</article><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\product-card.blade.php ENDPATH**/ ?>