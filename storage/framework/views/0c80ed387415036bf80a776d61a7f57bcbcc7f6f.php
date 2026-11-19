

<?php $__env->startSection('title', 'Collections — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-wrapper">
    <div class="axil-breadcrumb-area">
        <div class="container-fluid">
            <ul class="axil-breadcrumb">
                <li class="axil-breadcrumb-item"><a href="<?php echo e(route('front.home')); ?>">Home</a></li>
                <li class="separator"></li>
                <li class="axil-breadcrumb-item active" aria-current="page">Collections</li>
            </ul>
        </div>
    </div>

    <section class="gm-section">
        <div class="container-fluid">
            <div class="gm-section-head">
                <div>
                    <span class="gm-eyebrow">The wardrobe</span>
                    <h1 class="gm-title">Shop by category</h1>
                    <p class="gm-subtitle">Every piece in its place. Explore the full range of menswear, from shirting to tailoring and everyday essentials.</p>
                </div>
                <a href="<?php echo e(route('front.products.index')); ?>" class="gm-link">Shop all <i class="fas fa-arrow-right"></i></a>
            </div>

            <?php if($cats->count()): ?>
            <div class="gm-cats">
                <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="gm-cat" href="<?php echo e(route('front.products.index')); ?>?category_id=<?php echo e($cat->id); ?>">
                    <img src="<?php echo e(getImage('categories', $cat->image)); ?>" alt="<?php echo e($cat->name); ?>" loading="lazy">
                    <div class="gm-cat-label">
                        <h3><?php echo e($cat->name); ?></h3>
                        <span><i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if(isset($subs) && $subs->count()): ?>
    <section class="gm-section gm-section--tight" style="padding-top:0">
        <div class="container-fluid">
            <div class="gm-section-head">
                <div>
                    <span class="gm-eyebrow">More to explore</span>
                    <h2 class="gm-title">Featured sub-collections</h2>
                </div>
            </div>
            <div class="gm-cats">
                <?php $__currentLoopData = $subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="gm-cat" href="<?php echo e(route('front.products.index')); ?>?category_id=<?php echo e($sub->parent_id); ?>&sub_category_id=<?php echo e($sub->id); ?>">
                    <img src="<?php echo e(getImage('categories', $sub->image)); ?>" alt="<?php echo e($sub->name); ?>" loading="lazy">
                    <div class="gm-cat-label">
                        <h3><?php echo e($sub->name); ?></h3>
                        <span><i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/categories.blade.php ENDPATH**/ ?>