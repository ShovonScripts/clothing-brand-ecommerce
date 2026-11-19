
<?php $__env->startSection('content'); ?>

<div class="main-wrapper container-fluid">
  <div class="main-wrapper">
    <link rel="stylesheet" href="frontend/css/career.css">
    <section>
        <div class="career-banner" style="background-image: url(<?php echo e(getImage('career','0906_hp_lux_takeover_c06_img1666696656.jpg')); ?>);">
            <h2 class="title"> Career Page</h2>
        </div>
    </section>
    <br><br>
    <section>
        <div class="container mt-5">
            <div class="career mb-5">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row career-row mb-5">
                    <div class="col-lg-5 col-md-5 col-12 m-auto career-item">
                        <img src="<?php echo e(getImage('career',$item->image)); ?>" alt="" width="500">
                    </div>
                    <div class="col-lg-7 col-md-7 col-12 m-auto ps-5 align-items-start career-item">
                        <h2 class="text-cap mb-5">
                            <?php echo e($item->title); ?>

                        </h2>
                        <p><?php echo e($item->description); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <br><br>
    </section>
  </div>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/career.blade.php ENDPATH**/ ?>