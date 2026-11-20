<div class="slick-single-layout">
    <div class="row row--15">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <div class="col-lg-2 col-md-3 col-6 mb--30">
            <?php echo $__env->make('frontend.products.partials.product_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\frontend\products\partials\hotdeal_product.blade.php ENDPATH**/ ?>