
<?php $__env->startSection('content'); ?>
<main class="main-wrapper">
    <style>
        .form-group input, .form-group button{
            border-radius: 50px;
        }
        .form-group{
            margin-bottom: 0;
            padding-bottom: 30px;
        }
        .axil-checkout-billing{
            background: #c2050b;
        }

        .input-form{
            padding-top: 100px;
            background: white;
            border-radius: 0 50px 0 0;
        }
        .form-title{
            display: grid;
            place-content: center;
        }
        .icon-logo{
            height: 60px;
            width: 60px;
            margin: 0 auto;
            border-radius: 50px;
            border: 1px solid white;
            font-size: 30px;
            color: white;
            display: grid;
            place-content: center;
            margin-top: 30px;
        }
        .form-title .serif{
            color: white;
            padding: 10px;
            text-transform: uppercase;
        }
    </style>
    <!-- Start Checkout Area  -->
    <div class="axil-checkout-area axil-section-gap">
        <div class="container">
            <form method="POST" action="<?php echo e(route('front.login')); ?>" id="ajax_form">
                <?php echo csrf_field(); ?>

                <div class="row justify-content-center">
                    <div class="col-lg-6 card p-0">
                        <div class="axil-checkout-billing">
                            <div class="form-title">
                                <div class="icon-logo">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <h3 class="serif text-center">Provide your phone number</h3>
                            </div>
                            
                            <div class="input-form px-3">
                                <div class="form-group">
                                    <label>Sign In / Sign Up With Your Phone Number * <span>*</span></label>
                                    <input type="text" name="phone">
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="p-3 border col-12 mt-2" style="background-color: #c2050b; color: white;">Sign In</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
    <!-- End Checkout Area  -->

</main>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('frontend/js/checkout.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/auth/login.blade.php ENDPATH**/ ?>