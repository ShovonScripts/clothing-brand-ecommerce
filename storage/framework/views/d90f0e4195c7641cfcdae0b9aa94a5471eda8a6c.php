
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                    <li class="breadcrumb-item active">Generate Pathao Courier Access Token</li>
                </ol>
            </div>
            <h4 class="page-title">Generate Pathao Courier Access Token</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary">Back</a><br><br>
                
                <br>
                <form action="<?php echo e(route('admin.generatePathaoAccessToken')); ?>" method="POST" id="">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                    <strong for="client_id">Client ID</strong>
                                    <input type="text" id="client_id" class="form-control" name="client_id" placeholder="Client ID..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="client_secret">Client Secret</strong>
                                <input type="text" id="client_secret" class="form-control" name="client_secret" placeholder="Client Secret..." required>
                            </div>
                        </div>
                      	
                      	<div class="col-md-6">
                            <div class="form-group">
                                <strong for="client_email">Client Email</strong>
                                <input type="email" class="form-control" name="client_email" placeholder="Client Email..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="client_password">Client Password</strong>
                                <input type="password" id="client_password" class="form-control" name="client_password" required placeholder="Client Password...">
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" value="SUBMIT" class="btn btn-success">
                    <hr>
                </form>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div> <!-- end row -->
<?php $__env->stopSection(); ?> 

<?php $__env->startPush('js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">

  
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/informations/generate-pathao-access-token.blade.php ENDPATH**/ ?>