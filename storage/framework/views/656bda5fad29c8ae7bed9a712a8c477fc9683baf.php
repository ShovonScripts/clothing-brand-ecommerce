
<?php
    $data = getProductInfo($product);
    $hasDiscount = $data['discount_amount'] > 0 && $data['old_price'] > 0;
    $isSingle = ($product->type ?? 'single') === 'single';
    $variationId = optional($product->variation)->id;
?>

<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.product-card','data' => ['role' => 'listitem','image' => getImage('products', $product->image),'name' => $product->name,'price' => $data['price'],'originalPrice' => $hasDiscount ? $data['old_price'] : null,'category' => optional($product->category)->name,'badges' => $hasDiscount ? [['variant' => 'sale', 'label' => 'Sale']] : [],'href' => route('front.products.show', [$product->id])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['role' => 'listitem','image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(getImage('products', $product->image)),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->name),'price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['price']),'originalPrice' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasDiscount ? $data['old_price'] : null),'category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(optional($product->category)->name),'badges' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasDiscount ? [['variant' => 'sale', 'label' => 'Sale']] : []),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('front.products.show', [$product->id]))]); ?>
     <?php $__env->slot('actions', null, []); ?> 
        <?php if($isSingle && $variationId): ?>
            <form class="gm-quick-add" method="POST" action="<?php echo e(route('front.carts.storeCart')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                <input type="hidden" name="variation_id" value="<?php echo e($variationId); ?>">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="is_stock" value="<?php echo e($product->is_stock); ?>">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['type' => 'submit','variant' => 'primary','size' => 'sm','full' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','variant' => 'primary','size' => 'sm','full' => true]); ?>Add to bag <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </form>
        <?php else: ?>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['href' => route('front.products.show', [$product->id]),'variant' => 'secondary','size' => 'sm','full' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('front.products.show', [$product->id])),'variant' => 'secondary','size' => 'sm','full' => true]); ?>Select options <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        <?php endif; ?>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/products/partials/card.blade.php ENDPATH**/ ?>