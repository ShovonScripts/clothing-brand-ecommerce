
<?php $__env->startSection('content'); ?>


<style>
  a.axil-btn.btn-bg-primary::before, button.axil-btn.btn-bg-primary::before {
  background-color: var(--color-primary);
  background: #111111 !important;
}
</style>
<main class="main-wrapper">
  <div class="cart_other_details">
    <?php echo $__env->make('frontend.cart.other_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
</main>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/cart/index.blade.php ENDPATH**/ ?>