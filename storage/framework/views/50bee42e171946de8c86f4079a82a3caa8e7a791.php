

<?php $__env->startSection('title', $product->name . ' — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<?php
$info = \App\Models\Information::first();
$data = getProductInfo($product);
$images = collect([$product->image])->merge($product->images->pluck('image')->toArray())->filter()->values()
    ->map(fn($file) => getImage('products', $file));
$hasVariations = $product->type !== 'single' && $product->variations->count();
$variationOptions = $hasVariations ? $product->variations->mapWithKeys(function($v) use ($product) {
    $sizeLabel = optional($v->size)->title;
    $colorLabel = optional($v->color)->name;
    $isStockFlag = $v->is_stock ?? $product->is_stock;
    $tracked = (int) $isStockFlag !== 0;
    $stock = $tracked ? app(\App\Utils\Util::class)->checkProductStock($product->id, $v->id) : 99;
    return [$v->id => [
        'label' => $sizeLabel ?: $colorLabel ?: 'One size',
        'price' => $v->price,
        'stock' => $stock,
        'tracked' => $tracked,
        'is_stock_flag' => $isStockFlag,
    ]];
}) : [];
$firstVariation = $hasVariations ? $product->variations->first() : null;
$selectedVariationId = $firstVariation?->id ?? ($product->variation->id ?? '');
$selectedVariation = $variationOptions[$selectedVariationId] ?? null;
$isStockFlag = $selectedVariation['is_stock_flag'] ?? $product->is_stock;
$tracked = (int) $isStockFlag !== 0;
if ($selectedVariation) {
    $maxStock = $selectedVariation['stock'];
} elseif ($tracked) {
    $maxStock = app(\App\Utils\Util::class)->checkProductStock($product->id, $selectedVariationId);
} else {
    $maxStock = 99;
}
?>

<main class="main-wrapper">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.breadcrumb','data' => ['items' => [
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Shop', 'url' => route('front.products.index')],
            ['label' => $product->name],
        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Shop', 'url' => route('front.products.index')],
            ['label' => $product->name],
        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.section','data' => ['size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'md']); ?>
        <div class="gm-pdp-layout">

            
            <div class="gm-pdp-gallery">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.gallery','data' => ['images' => $images->toArray()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.gallery'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['images' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($images->toArray())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>

            
            <div class="gm-pdp-info">
                <div class="gm-pdp-meta" style="display: flex; flex-wrap: wrap; gap: var(--s-2); margin-bottom: var(--s-2); font-size: var(--t-sm);">
                    <?php if($product->category): ?>
                        <span class="gm-pdp-category" style="color: var(--c-accent); font-weight: 500; text-transform: uppercase; letter-spacing: var(--ls-wide);"><?php echo e($product->category->name); ?></span>
                    <?php endif; ?>
                    <?php if($product->brand): ?>
                        <span class="gm-pdp-brand" style="color: var(--c-ink-500);"><?php echo e($product->brand->name); ?></span>
                    <?php endif; ?>
                </div>

                <h1 class="gm-pdp-title" style="font-size: clamp(var(--t-xl), 4vw, var(--t-2xl)); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-3); line-height: var(--lh-tight);"><?php echo e($product->name); ?></h1>

                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.price','data' => ['current' => $data['price'],'original' => $data['discount_amount'] > 0 ? $data['old_price'] : null,'context' => 'pdp','currency' => '$info->currency','class' => 'gm-pdp-price']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.price'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['price']),'original' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['discount_amount'] > 0 ? $data['old_price'] : null),'context' => 'pdp','currency' => '$info->currency','class' => 'gm-pdp-price']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                <?php if($product->feature): ?>
                    <ul class="gm-pdp-features" style="list-style: none; padding: 0; margin: var(--s-4) 0; display: flex; flex-wrap: wrap; gap: var(--s-3) var(--s-5);">
                        <?php $__currentLoopData = explode('<li>', strip_tags($product->feature, '<li>')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(trim($feature)): ?>
                                <li style="position: relative; padding-inline-start: var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); line-height: var(--lh-base);">
                                    <span style="position: absolute; inset-inline-start: 0; top: 0.6em; width: 6px; height: 6px; border-radius: 50%; background: var(--c-accent);"></span>
                                    <?php echo e(trim($feature)); ?>

                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('front.carts.storeCart')); ?>" class="gm-pdp-form gm-quick-add">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                    <input type="hidden" name="is_stock" value="<?php echo e($isStockFlag); ?>">

                    <?php if($hasVariations): ?>
                        <div class="gm-pdp-variations">
                            <div class="gm-variant-swatch-group" role="radiogroup" aria-label="Size options">
                                <?php $__currentLoopData = $variationOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationId => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.variant-swatch','data' => ['name' => 'variation_id','value' => $variationId,'label' => $variation['label'],'selected' => $variationId == $selectedVariationId,'disabled' => $variation['stock'] <= 0,'size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.variant-swatch'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'variation_id','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($variationId),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($variation['label']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($variationId == $selectedVariationId),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($variation['stock'] <= 0),'size' => 'md']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <input type="hidden" name="variation_id" value="<?php echo e($selectedVariationId); ?>">
                    <?php endif; ?>

                    <div class="gm-pdp-quantity">
                        <label for="pdp-qty" class="gm-qty-label">Quantity</label>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.quantity-stepper','data' => ['name' => 'quantity','id' => 'pdp-qty','value' => 1,'min' => 1,'max' => $maxStock,'stock' => $maxStock,'size' => 'md','inline' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.quantity-stepper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'quantity','id' => 'pdp-qty','value' => 1,'min' => 1,'max' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($maxStock),'stock' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($maxStock),'size' => 'md','inline' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>

                    <div class="gm-pdp-actions">
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','size' => 'lg','full' => true,'type' => 'submit','disabled' => $tracked && $maxStock <= 0]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','full' => true,'type' => 'submit','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tracked && $maxStock <= 0)]); ?>
                            <?php if($tracked && $maxStock <= 0): ?>
                                Out of Stock
                            <?php else: ?>
                                Add to Bag
                            <?php endif; ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>
                </form>

                
                <div class="gm-pdp-delivery">
                    <div class="gm-pdp-delivery-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <span>Delivery charge is calculated at checkout</span>
                    </div>
                    <div class="gm-pdp-delivery-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                        <a href="<?php echo e(route('front.returnPolicy')); ?>">Returns &amp; exchanges</a>
                    </div>
                    <div class="gm-pdp-delivery-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="2"></rect><line x1="2" y1="12" x2="22" y2="12"></line></svg>
                        <span>Secure payment</span>
                    </div>
                </div>
            </div>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.section','data' => ['size' => 'md','background' => 'bg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'md','background' => 'bg']); ?>
        <?php
            $reviewCount = $product->reviews->count();
            $tabLabels = ['Description'];
            if ($product->video_link) $tabLabels[] = 'Video';
            if ($reviewCount) $tabLabels[] = "Reviews ({$reviewCount})";
        ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.tabs','data' => ['variant' => 'underline','labels' => $tabLabels]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.tabs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'underline','labels' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabLabels)]); ?>
                <div class="gm-tabs__panel" data-gm-tab-panel>
                    <div class="gm-prose" style="font-family: var(--f-body); font-size: var(--t-md); line-height: var(--lh-loose); color: var(--c-ink-700);">
                        <?php echo $product->body; ?>

                    </div>
                </div>

                <?php if($product->video_link): ?>
                    <div class="gm-tabs__panel" data-gm-tab-panel>
                        <div class="gm-video-wrapper" style="position: relative; width: 100%; padding-top: 56.25%; border-radius: var(--r-md); overflow: hidden;">
                            <?php echo $product->video_link; ?>

                        </div>
                    </div>
                <?php endif; ?>

                <?php if($reviewCount): ?>
                    <div class="gm-tabs__panel" data-gm-tab-panel>
                      <div class="gm-reviews" style="display: flex; flex-direction: column; gap: var(--s-5);">
                        <?php $__currentLoopData = $product->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <article class="gm-review" style="padding: var(--s-4); background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-md);">
                                <div class="gm-review-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--s-2);">
                                    <div>
                                        <strong style="font-family: var(--f-display); color: var(--c-ink-900);"><?php echo e(full_name($review->user) ?: 'Customer'); ?></strong>
                                        <time style="font-size: var(--t-sm); color: var(--c-ink-500); margin-inline-start: var(--s-3);"><?php echo e($review->created_at->format('F j, Y')); ?></time>
                                    </div>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.rating','data' => ['value' => $review->rating,'max' => 5,'readonly' => true,'size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.rating'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($review->rating),'max' => 5,'readonly' => true,'size' => 'sm']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <p style="margin: 0; color: var(--c-ink-700);"><?php echo e($review->comment); ?></p>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                    </div>
                <?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.section','data' => ['size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'md']); ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.section-header','data' => ['title' => 'You Might Also Like','action' => 'View All','actionUrl' => route('front.products.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.section-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'You Might Also Like','action' => 'View All','actionUrl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('front.products.index'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.product-grid','data' => ['id' => 'gm-relative-products','style' => 'opacity: 0; transition: opacity 0.3s ease;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.product-grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'gm-relative-products','style' => 'opacity: 0; transition: opacity 0.3s ease;']); ?>
            
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
</main>


<div class="gm-sticky-bar" id="gm-sticky-bar">
    <div class="gm-sticky-bar__inner">
        <button type="button" class="gm-sticky-btn gm-sticky-btn--store" data-gm-drawer-open="cart-drawer">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
            <span>Bag</span>
            <span class="gm-sticky-count" id="gm-sticky-count"><?php echo e(getTotalCart()); ?></span>
        </button>

        <form method="POST" action="<?php echo e(route('front.carts.storeCart')); ?>" class="gm-sticky-form gm-quick-add">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
            <input type="hidden" name="is_stock" value="<?php echo e($isStockFlag); ?>">
            <input type="hidden" name="quantity" value="1">
            <?php if($hasVariations): ?>
                <input type="hidden" name="variation_id" class="gm-sticky-variation" value="<?php echo e($selectedVariationId); ?>">
            <?php else: ?>
                <input type="hidden" name="variation_id" value="<?php echo e($selectedVariationId); ?>">
            <?php endif; ?>
            <button type="submit" class="gm-sticky-btn gm-sticky-btn--buy">Buy Now</button>
        </form>

        <form method="POST" action="<?php echo e(route('front.carts.storeCart')); ?>" class="gm-sticky-form gm-quick-add">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
            <input type="hidden" name="is_stock" value="<?php echo e($isStockFlag); ?>">
            <input type="hidden" name="quantity" value="1">
            <?php if($hasVariations): ?>
                <input type="hidden" name="variation_id" class="gm-sticky-variation" value="<?php echo e($selectedVariationId); ?>">
            <?php else: ?>
                <input type="hidden" name="variation_id" value="<?php echo e($selectedVariationId); ?>">
            <?php endif; ?>
            <button type="submit" class="gm-sticky-btn gm-sticky-btn--add">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Add
            </button>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    (function() {
        // Sticky bar scroll visibility
        const stickyBar = document.getElementById('gm-sticky-bar');
        if (stickyBar) {
            let ticking = false;
            window.addEventListener('scroll', () => {
                if (!ticking) {
                    requestAnimationFrame(() => {
                        const scrollTop = window.pageYOffset;
                        stickyBar.classList.toggle('is-visible', scrollTop > 260);
                        ticking = false;
                    });
                    ticking = true;
                }
            }, { passive: true });
        }

        // Keep the mobile sticky bar in sync with the selected variation.
        document.querySelectorAll('.gm-pdp-form input[name="variation_id"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (!this.checked) return;
                document.querySelectorAll('.gm-sticky-variation').forEach(function(input) {
                    input.value = this.value;
                }, this);
            });
        });

        // Load related products
        function loadRelated() {
            fetch('<?php echo e(route("front.products.relativeProduct", [$product->id])); ?>')
                .then(res => res.json())
                .then(res => {
                    if (res.success && res.html) {
                        const container = document.getElementById('gm-relative-products');
                        if (container) {
                            container.innerHTML = res.html;
                            container.style.opacity = '1';
                        }
                    }
                })
                .catch(err => console.error('Failed to load related products:', err));
        }

        if (document.getElementById('gm-relative-products')) {
            loadRelated();
        }

        // Cart drawer sync
        window.addEventListener('cart-updated', function(e) {
            const countEl = document.getElementById('gm-sticky-count');
            if (countEl && e.detail.count !== undefined) {
                countEl.textContent = e.detail.count;
            }
        });
    })();
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/products/show.blade.php ENDPATH**/ ?>