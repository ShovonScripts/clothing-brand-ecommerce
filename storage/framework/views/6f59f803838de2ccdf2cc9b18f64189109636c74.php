

<?php $__env->startSection('title', 'Collection — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<?php $parent = $subs->first() ? optional($subs->first())->parent : null; ?>
<main class="main-wrapper">
    <div class="axil-breadcrumb-area">
        <div class="container-fluid">
            <ul class="axil-breadcrumb">
                <li class="axil-breadcrumb-item"><a href="<?php echo e(route('front.home')); ?>">Home</a></li>
                <li class="separator"></li>
                <li class="axil-breadcrumb-item"><a href="<?php echo e(route('front.categories')); ?>">Collections</a></li>
                <li class="separator"></li>
                <li class="axil-breadcrumb-item active" aria-current="page"><?php echo e($parent ? $parent->name : 'Collection'); ?></li>
            </ul>
        </div>
    </div>

    <section class="gm-section">
        <div class="container-fluid">
            <div class="gm-section-head">
                <div>
                    <span class="gm-eyebrow">Collection</span>
                    <h1 class="gm-title"><?php echo e($parent ? $parent->name : 'Collection'); ?></h1>
                    <p class="gm-subtitle">Refine your wardrobe with pieces designed to be worn together, season after season.</p>
                </div>
                <?php if($parent): ?>
                <a href="<?php echo e(route('front.products.index')); ?>?category_id=<?php echo e($parent->id); ?>" class="gm-link">Shop all <?php echo e($parent->name); ?> <i class="fas fa-arrow-right"></i></a>
                <?php endif; ?>
            </div>

            <?php if($subs->count()): ?>
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
            <?php else: ?>
            <div class="alert alert-light" style="border-radius:0">New pieces are arriving in this collection soon.</div>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\frontend\sub_categories.blade.php ENDPATH**/ ?>