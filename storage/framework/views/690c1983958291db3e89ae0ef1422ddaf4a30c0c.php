

<?php $__env->startSection('title', 'Brands — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-wrapper">
    <div class="axil-breadcrumb-area">
        <div class="container-fluid">
            <ul class="axil-breadcrumb">
                <li class="axil-breadcrumb-item"><a href="<?php echo e(route('front.home')); ?>">Home</a></li>
                <li class="separator"></li>
                <li class="axil-breadcrumb-item active" aria-current="page">Brands</li>
            </ul>
        </div>
    </div>

    <section class="gm-section">
        <div class="container-fluid">
            <div class="gm-section-head">
                <div>
                    <span class="gm-eyebrow">In good company</span>
                    <h1 class="gm-title">The makers</h1>
                    <p class="gm-subtitle">A curated roster of labels and ateliers we believe in — each with a distinct point of view.</p>
                </div>
            </div>

            <div class="row row--15">
                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb--30">
                    <a href="<?php echo e(route('front.products.index')); ?>?brand_id=<?php echo e($item->id); ?>" class="gm-card" style="padding:36px 24px;align-items:center;justify-content:center;min-height:160px;text-align:center">
                        <h3 style="font-family:var(--gm-display)!important;font-size:26px;font-weight:400!important;margin:0 0 8px"><?php echo e($item->name); ?></h3>
                        <span class="gm-card-meta" style="margin:0">Shop the label</span>
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12"><div class="alert alert-light" style="border-radius:0">Brands will appear here soon.</div></div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\frontend\brands.blade.php ENDPATH**/ ?>