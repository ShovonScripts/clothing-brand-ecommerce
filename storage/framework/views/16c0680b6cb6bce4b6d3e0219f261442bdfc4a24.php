<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'product' => null,
    'open' => false,
    'onClose' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'product' => null,
    'open' => false,
    'onClose' => null,
]); ?>
<?php foreach (array_filter(([
    'product' => null,
    'open' => false,
    'onClose' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
if (!$product) return;
$modalId = 'gm-quick-view-' . $product->id;
$overlayId = $modalId . '-overlay';

$info = \App\Models\Information::first();
$currencySymbol = match($info->currency) {
    'BDT' => '৳',
    'Dollar' => '$',
    'Euro' => '€',
    'Rupee' => '₹',
    default => ''
};

$data = getProductInfo($product);
$hasVariations = $product->type !== 'single' && $product->variations->count();
$images = collect([$product->image])->merge($product->images->pluck('image')->toArray())->filter()->values();
$maxStock = $hasVariations ? ($product->variations->first()?->is_stock ?? $product->is_stock) : $product->is_stock;
?>

<?php if($open): ?>
<div
    id="<?php echo e($overlayId); ?>"
    class="gm-modal-overlay gm-modal-overlay--open"
    role="dialog"
    aria-modal="true"
    aria-labelledby="<?php echo e($modalId); ?>-title"
>
    <div id="<?php echo e($modalId); ?>" class="gm-modal gm-modal--lg gm-modal--open" style="max-width: 800px;">
        <div class="gm-modal__header">
            <h2 id="<?php echo e($modalId); ?>-title" class="gm-modal__title">Quick View</h2>
            <button
                type="button"
                class="gm-modal__close"
                aria-label="Close"
            >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <div class="gm-modal__body" style="padding: 0; max-height: none;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0; min-height: 500px;">
                
                <div class="gm-quick-view-gallery" style="position: relative; background: var(--c-bg-2); padding: var(--s-6);">
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

                
                <div class="gm-quick-view-info" style="padding: var(--s-6); overflow-y: auto; max-height: 500px;">
                    <div class="gm-quick-view-meta" style="display: flex; flex-wrap: wrap; gap: var(--s-2); margin-bottom: var(--s-2); font-size: var(--t-sm);">
                        <?php if($product->category): ?>
                            <span class="gm-quick-view-category" style="color: var(--c-accent); font-weight: 500; text-transform: uppercase; letter-spacing: var(--ls-wide);"><?php echo e($product->category->name); ?></span>
                        <?php endif; ?>
                        <?php if($product->brand): ?>
                            <span class="gm-quick-view-brand" style="color: var(--c-ink-500);"><?php echo e($product->brand->name); ?></span>
                        <?php endif; ?>
                    </div>

                    <h2 class="gm-quick-view-title" style="font-size: var(--t-xl); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-3); line-height: var(--lh-tight);"><?php echo e($product->name); ?></h2>

                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.price','data' => ['current' => $data['price'],'original' => $data['discount_amount'] > 0 ? $data['old_price'] : null,'context' => 'pdp','currency' => '$info->currency','class' => 'gm-quick-view-price']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.price'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['price']),'original' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['discount_amount'] > 0 ? $data['old_price'] : null),'context' => 'pdp','currency' => '$info->currency','class' => 'gm-quick-view-price']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                    <?php if($product->feature): ?>
                        <ul class="gm-quick-view-features" style="list-style: none; padding: 0; margin: var(--s-4) 0; display: flex; flex-wrap: wrap; gap: var(--s-3) var(--s-5);">
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

                    <form method="POST" action="<?php echo e(route('front.carts.storeCart')); ?>" class="gm-quick-view-form">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                        <input type="hidden" name="price" :value="$data['price']">
                        <input type="hidden" name="is_stock" value="<?php echo e($maxStock); ?>">
                        <input type="hidden" name="quantity" value="1">

                        <?php if($hasVariations): ?>
                            <div class="gm-quick-view-variations" style="margin-bottom: var(--s-4);">
                                <?php $__currentLoopData = $product->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $sizeLabel = optional($v->size)->title;
                                        $colorLabel = optional($v->color)->name;
                                        $label = $sizeLabel ?: $colorLabel ?: 'One size';
                                    ?>
                                    <input type="hidden" class="gm-variation-option" data-id="<?php echo e($v->id); ?>" data-label="<?php echo e($label); ?>" data-price="<?php echo e($v->price); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <div class="gm-variant-swatch-group" role="radiogroup" aria-label="Size options">
                                    <?php $__currentLoopData = $product->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $sizeLabel = optional($v->size)->title;
                                            $colorLabel = optional($v->color)->name;
                                            $label = $sizeLabel ?: $colorLabel ?: 'One size';
                                            $isFirst = $loop->first;
                                        ?>
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.variant-swatch','data' => ['value' => $v->id,'label' => $label,'selected' => $isFirst,'disabled' => $v->is_stock <= 0,'size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.variant-swatch'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($v->id),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($label),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isFirst),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($v->is_stock <= 0),'size' => 'md']); ?>
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
                            <input type="hidden" name="variation_id" value="<?php echo e($product->variation->id ?? ''); ?>">
                        <?php endif; ?>

                        <div class="gm-quick-view-quantity" style="display: flex; align-items: center; gap: var(--s-4); margin-bottom: var(--s-4);">
                            <label for="quick-view-qty" class="gm-qty-label" style="font-size: var(--t-xs); font-weight: 500; letter-spacing: var(--ls-wide); text-transform: uppercase; color: var(--c-ink-900); white-space: nowrap;">Quantity</label>
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

                        <div class="gm-quick-view-actions" style="display: flex; flex-direction: column; gap: var(--s-3);">
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

                    
                    <div class="gm-quick-view-delivery" style="display: flex; flex-wrap: wrap; gap: var(--s-3) var(--s-5); padding-top: var(--s-4); border-top: 1px solid var(--c-line); margin-top: var(--s-4);">
                        <div class="gm-quick-view-delivery-item" style="display: inline-flex; align-items: center; gap: var(--s-2); font-size: var(--t-sm); color: var(--c-ink-700);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                            <span>Free delivery over <?php echo e($currencySymbol); ?> 5,000</span>
                        </div>
                        <div class="gm-quick-view-delivery-item" style="display: inline-flex; align-items: center; gap: var(--s-2); font-size: var(--t-sm); color: var(--c-ink-700);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                            <span>14-day easy returns</span>
                        </div>
                        <div class="gm-quick-view-delivery-item" style="display: inline-flex; align-items: center; gap: var(--s-2); font-size: var(--t-sm); color: var(--c-ink-700);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><rect x="2" y="2" width="20" height="20" rx="2"></rect><line x1="2" y1="12" x2="22" y2="12"></line></svg>
                            <span>Secure payment</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php $__env->startPush('scripts'); ?>
<script>
    (function() {
        const overlay = document.getElementById('<?php echo e($overlayId); ?>');
        if (!overlay) return;

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

        // Close on escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && overlay.classList.contains('gm-modal-overlay--open')) {
                <?php if($onClose): ?>
                    @this->dispatch('close-quick-view', ['id' => '<?php echo e($overlayId); ?>'])
                <?php else: ?>
                    overlay.dispatchEvent(new CustomEvent('gm:close-modal', { detail: { id: '<?php echo e($overlayId); ?>' } }));
                <?php endif; ?>
            }
        });
    })();
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\quick-view.blade.php ENDPATH**/ ?>