
<?php $__env->startSection('content'); ?>
<?php
    $time=session()->get('user_data')['exp_time'];
    $otp=session()->get('user_data')['otp_verify'];
?>
<main class="main-wrapper">
    <!-- Start Checkout Area  -->
    <div class="axil-checkout-area">
        <style>
            .form-group input, .form-group .button{
            border-radius: 50px;
        }
        .form-group{
            margin-bottom: 0;
            padding-bottom: 30px;
        }
        .axil-checkout-billing{
            background: #ff7400;
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
      	
        <div class="container">
          	<?php if(session('status')): ?>
            <div class="alert alert-success" role="alert">
              <?php echo e(session('status')); ?>

            </div>
            <?php endif; ?>

            <?php if(session('error_msg')): ?>
            <div class="alert alert-danger" role="alert">
              <?php echo e(session('error_msg')); ?>

            </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('front.optVerify')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row mt-lg-5 mt-3 mb-5 justify-content-center">
                    <div class="col-lg-6 p-0 card">
                        <div class="axil-checkout-billing">
                            <div class="form-title">
                                <div class="icon-logo">
                                    <i class="fab fa-buromobelexperte"></i>
                                </div>
                                <h2 class="serif text-center m-5"> OTP Verification <span style="color:blue" id="demo"></span> </h2>
                            </div>
                            <div class="input-form px-3">
                                <div class="form-group">
                                    <label>OTP Number <span>*</span></label>
                                    <input type="text" name="otp_verify" class=" <?php $__errorArgs = ['otp_verify'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="otp_verify"   autofocus placeholder="OTP Number">
                                  	<?php $__errorArgs = ['otp_verify'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
    
                               
                              
                              <div class="d-grid form-group gap-2">
                                <input type="submit"  name="button" class="button" value="Save" style="background-color: #041e3a; color: white;height: 35px;border:none">
                                <input type="submit"  name="button" class="button bg-danger" value="Resend" style="background-color: indianred !important; color: white;height: 35px;border:none">
                               
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
<script>
$(document).ready(function(){
  var countDownDate = new Date("<?php echo e($time); ?>").getTime();
  
 
  
  var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownDate - now;
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s "; 
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "";
    }
  }, 1000);
  
});
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\auth\otp_verify.blade.php ENDPATH**/ ?>