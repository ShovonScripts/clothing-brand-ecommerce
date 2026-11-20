<?php $__env->startSection('title', $product->name . ' — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<?php
$info = \App\Models\Information::first();
$data = getProductInfo($product);
$currencySymbol = match($info->currency) {
    'BDT' => '৳',
    'Dollar' => '$',
    'Euro' => '€',
    'Rupee' => '₹',
    default => ''
};
$images = collect([$product->image])->merge($product->images->pluck('image')->toArray())->filter()->values();
$hasVariations = $product->type !== 'single' && $product->variations->count();
$variationOptions = $hasVariations ? $product->variations->mapWithKeys(function($v) {
    $sizeLabel = optional($v->size)->title;
    $colorLabel = optional($v->color)->name;
    return [$v->id => [
        'label' => $sizeLabel ?: $colorLabel ?: 'One size',
        'price' => $v->price,
        'stock' => $v->is_stock ?? $product->is_stock,
    ]];
}) : [];
$firstVariation = $hasVariations ? $product->variations->first() : null;
$selectedVariationId = $firstVariation?->id ?? ($product->variation->id ?? '');
$maxStock = $hasVariations ? ($firstVariation?->is_stock ?? $product->is_stock) : $product->is_stock;
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
        <div class="gm-pdp-layout" style="display: grid; grid-template-columns: 1fr 480px; gap: var(--s-8); align-items: start;">

            
            <div class="gm-pdp-gallery" style="position: sticky; top: calc(var(--header-h) + var(--s-4));">
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

            
            <div class="gm-pdp-info" style="padding-inline-start: var(--s-6);">
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

                <form method="POST" action="<?php echo e(route('front.carts.storeCart')); ?>" class="gm-pdp-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                    <input type="hidden" name="price" :value="$data['price']">
                    <input type="hidden" name="is_stock" value="<?php echo e($maxStock); ?>">
                    <input type="hidden" name="quantity" value="1">

                    <?php if($hasVariations): ?>
                        <div class="gm-pdp-variations" style="margin-bottom: var(--s-4);">
                            <?php $__currentLoopData = $variationOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationId => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $isSelected = $variationId == $selectedVariationId;
                                ?>
                                <input type="radio"
                                    name="variation_id"
                                    value="<?php echo e($variationId); ?>"
                                    id="variation_<?php echo e($variationId); ?>"
                                    class="gm-variant-swatch__input"
                                    <?php if($isSelected): ?> checked <?php endif; ?>
                                    <?php if($variation['stock'] <= 0): ?> disabled <?php endif; ?>
                                >
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <div class="gm-variant-swatch-group" style="margin-top: var(--s-3);" role="radiogroup" aria-label="Size options">
                                <?php $__currentLoopData = $variationOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationId => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.variant-swatch','data' => ['value' => $variationId,'label' => $variation['label'],'selected' => $variationId == $selectedVariationId,'disabled' => $variation['stock'] <= 0,'size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.variant-swatch'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($variationId),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($variation['label']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($variationId == $selectedVariationId),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($variation['stock'] <= 0),'size' => 'md']); ?>
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

                    <div class="gm-pdp-quantity" style="display: flex; align-items: center; gap: var(--s-4); margin-bottom: var(--s-4);">
                        <label for="pdp-qty" class="gm-qty-label" style="font-size: var(--t-xs); font-weight: 500; letter-spacing: var(--ls-wide); text-transform: uppercase; color: var(--c-ink-900); white-space: nowrap;">Quantity</label>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.quantity-stepper','data' => ['name' => 'quantity','value' => $quantity ?? 1,'min' => 1,'max' => $maxStock,'stock' => $maxStock,'size' => 'md','inline' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.quantity-stepper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'quantity','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($quantity ?? 1),'min' => 1,'max' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($maxStock),'stock' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($maxStock),'size' => 'md','inline' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>

                    <div class="gm-pdp-actions" style="display: flex; flex-direction: column; gap: var(--s-3);">
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','size' => 'lg','full' => true,'type' => 'submit','disabled' => $maxStock <= 0]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','full' => true,'type' => 'submit','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($maxStock <= 0)]); ?>
                            <?php if($maxStock <= 0): ?>
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

                        <?php if(auth()->guard()->check()): ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'ghost','size' => 'md','full' => true,'active' => $product->in_wishlist ?? false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'md','full' => true,'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->in_wishlist ?? false)]); ?>
                                Save for later
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="gm-btn gm-btn--ghost gm-btn--md gm-btn--full" style="text-align: center;">Sign in to save</a>
                        <?php endif; ?>
                    </div>
                </form>

                
                <div class="gm-pdp-delivery" style="display: flex; flex-wrap: wrap; gap: var(--s-3) var(--s-5); padding-top: var(--s-4); border-top: 1px solid var(--c-line); margin-top: var(--s-4);">
                    <div class="gm-pdp-delivery-item" style="display: inline-flex; align-items: center; gap: var(--s-2); font-size: var(--t-sm); color: var(--c-ink-700);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <span>Free delivery over <?php echo e($currencySymbol); ?> 5,000</span>
                    </div>
                    <div class="gm-pdp-delivery-item" style="display: inline-flex; align-items: center; gap: var(--s-2); font-size: var(--t-sm); color: var(--c-ink-700);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                        <span>14-day easy returns</span>
                    </div>
                    <div class="gm-pdp-delivery-item" style="display: inline-flex; align-items: center; gap: var(--s-2); font-size: var(--t-sm); color: var(--c-ink-700);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><rect x="2" y="2" width="20" height="20" rx="2"></rect><line x1="2" y1="12" x2="22" y2="12"></line></svg>
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


<div class="gm-sticky-bar" id="gm-sticky-bar" style="position: fixed; bottom: 0; left: 0; right: 0; z-index: 100; transform: translateY(100%); transition: transform var(--d-base) var(--e-out); background: var(--c-bg); box-shadow: 0 -4px 24px rgba(16,16,16,0.08); border-top: 1px solid var(--c-line);">
    <div class="gm-sticky-bar-inner" style="display: grid; grid-template-columns: 1fr 1.5fr 1.5fr; align-items: stretch; max-width: 1280px; margin: 0 auto;">
        <button type="button" class="gm-sticky-btn gm-sticky-btn--store" data-gm-drawer-open="cart-drawer" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 2px; padding: var(--s-3) var(--s-2); background: transparent; border: none; color: var(--c-ink-500); font-size: var(--t-xs); font-weight: 500; letter-spacing: var(--ls-wide); text-transform: uppercase; cursor: pointer;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
            <span>Bag</span>
            <span class="gm-sticky-count" id="gm-sticky-count" style="position: absolute; top: 2px; right: 2px; min-width: 16px; height: 16px; padding: 0 4px; background: var(--c-accent); color: var(--c-accent-ink); font-size: 10px; font-weight: 600; line-height: 16px; text-align: center; border-radius: 8px;"><?php echo e(getTotalCart()); ?></span>
        </button>

        <form method="POST" action="<?php echo e(route('front.carts.storeCart')); ?>" class="gm-sticky-form">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
            <input type="hidden" name="price" :value="$data['price']">
            <input type="hidden" name="is_stock" value="<?php echo e($maxStock); ?>">
            <input type="hidden" name="quantity" value="1">
            <?php if($hasVariations): ?>
                <input type="hidden" name="variation_id" class="gm-sticky-variation" value="<?php echo e($selectedVariationId); ?>">
            <?php else: ?>
                <input type="hidden" name="variation_id" value="<?php echo e($selectedVariationId); ?>">
            <?php endif; ?>
            <button type="submit" class="gm-sticky-btn gm-sticky-btn--buy" style="background: var(--c-accent); color: var(--c-accent-ink); font-family: var(--f-body); font-size: var(--t-sm); font-weight: 500; letter-spacing: var(--ls-wide); text-transform: uppercase; padding: var(--s-3); border: none; cursor: pointer; width: 100%; height: 100%;">Buy Now</button>
        </form>

        <form method="POST" action="<?php echo e(route('front.carts.storeCart')); ?>" class="gm-sticky-form">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
            <input type="hidden" name="price" :value="$data['price']">
            <input type="hidden" name="is_stock" value="<?php echo e($maxStock); ?>">
            <input type="hidden" name="quantity" value="1">
            <?php if($hasVariations): ?>
                <input type="hidden" name="variation_id" class="gm-sticky-variation" value="<?php echo e($selectedVariationId); ?>">
            <?php else: ?>
                <input type="hidden" name="variation_id" value="<?php echo e($selectedVariationId); ?>">
            <?php endif; ?>
            <button type="submit" class="gm-sticky-btn gm-sticky-btn--add" style="background: var(--c-ink-900); color: var(--c-bg); font-family: var(--f-body); font-size: var(--t-sm); font-weight: 500; letter-spacing: var(--ls-wide); text-transform: uppercase; padding: var(--s-3); border: none; cursor: pointer; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; gap: var(--s-2);">
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

        // Variant change handler
        document.addEventListener('variant-change', function(e) {
            const { id, price, stock } = e.detail;
            const priceEls = document.querySelectorAll('[data-gm-price]');
            priceEls.forEach(el => {
                el.textContent = '<?php echo e($currencySymbol); ?> ' + price.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            });
            document.querySelectorAll('input[name="price"]').forEach(input => input.value = price);
            document.querySelectorAll('input[name="is_stock"]').forEach(input => input.value = stock);

            const qtyInputs = document.querySelectorAll('input[name="quantity"]');
            qtyInputs.forEach(input => {
                input.max = stock;
            });
        });

        // Tab change handler
        document.addEventListener('tab-change', function(e) {
            console.log('Tab changed to:', e.detail.index);
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