<?php
    $data = getProductInfo($product);
    $info = \App\Models\Information::first();
    $hasDiscount = ($data['discount_amount'] > 0 && $data['old_price'] > 0);
    $categoryName = optional($product->category)->name;
    $isSingle = ($product->type ?? 'single') === 'single';
    $variationId = optional($product->variation)->id;
?>

<article class="gm-card">
    <div class="gm-card-media">
        <a href="<?php echo e(route('front.products.show', [$product->id])); ?>" aria-label="<?php echo e($product->name); ?>">
            <img src="<?php echo e(getImage('products', $product->image)); ?>" alt="<?php echo e($product->name); ?>" loading="lazy">
        </a>

        <?php if($hasDiscount): ?>
        <span class="gm-card-badge gm-card-badge--sale">
            <?php echo e($product->discount_type == 'fixed' ? 'Sale' : rtrim(rtrim(number_format((float) $product->discount, 1), '0'), '.') . '% off'); ?>

        </span>
        <?php elseif($product->created_at && $product->created_at->gt(now()->subDays(30))): ?>
        <span class="gm-card-badge">New</span>
        <?php endif; ?>

        <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('front.wishlist.index')); ?>" class="gm-card-wish" aria-label="Save <?php echo e($product->name); ?>"><i class="far fa-heart"></i></a>
        <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="gm-card-wish" aria-label="Sign in to save <?php echo e($product->name); ?>"><i class="far fa-heart"></i></a>
        <?php endif; ?>

        <div class="gm-card-quick">
            <?php if($isSingle && $variationId): ?>
            <form class="gm-quick-add" method="POST" action="<?php echo e(route('front.carts.storeCart')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                <input type="hidden" name="variation_id" value="<?php echo e($variationId); ?>">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="is_stock" value="<?php echo e($product->is_stock); ?>">
                <button type="submit" class="gm-btn"><i class="fas fa-shopping-bag"></i> Add to bag</button>
            </form>
            <?php else: ?>
            <a href="<?php echo e(route('front.products.show', [$product->id])); ?>" class="gm-btn"><i class="fas fa-sliders-h"></i> Select options</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="gm-card-body">
        <div class="gm-card-meta"><?php echo e($categoryName ?: 'Gentry'); ?></div>
        <h3 class="gm-card-name">
            <a href="<?php echo e(route('front.products.show', [$product->id])); ?>"><?php echo e(\Illuminate\Support\Str::limit($product->name, 46)); ?></a>
        </h3>
        <div class="gm-card-price">
            <span class="<?php echo e($hasDiscount ? 'gm-price-sale' : ''); ?>"><?php echo e(priceFormate($data['price'])); ?></span>
            <?php if($hasDiscount): ?>
            <del><?php echo e(priceFormate($data['old_price'])); ?></del>
            <?php endif; ?>
        </div>
    </div>
</article>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/products/partials/product_section.blade.php ENDPATH**/ ?>