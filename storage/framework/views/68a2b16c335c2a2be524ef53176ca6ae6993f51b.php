
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
                    <li class="breadcrumb-item active">User Create</li>
                </ol>
            </div>
            <h4 class="page-title">User Create</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary">Back</a><br><br>
                <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST" id="ajax_form">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                    <strong for="first_name">First Name</strong>
                                    <input type="text" id="first_name" class="form-control" name="first_name" placeholder="First name..." value="<?php echo e($user->first_name); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="last_name">Last Name</strong>
                                <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last name..." value="<?php echo e($user->last_name); ?>">
                            </div>
                        </div>
                      
                      	<div class="col-md-6">
                            <div class="form-group">
                                <strong for="last_name">Business Name</strong>
                                <input type="text" class="form-control" name="business_name" placeholder="Business name..." value="<?php echo e($user->business_name); ?>">
                            </div>
                        </div>
                      
                      
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="email">Email</strong>
                                <input type="email" id="email" class="form-control" name="email" placeholder="Email..." value="<?php echo e($user->email); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="username">Username</strong>
                                <input type="text" id="username" class="form-control" name="username" placeholder="Username..." value="<?php echo e($user->username); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="password">Password</strong>
                                <input type="password" id="password" class="form-control" name="password" placeholder="Password..." autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="role">Role</strong>
                                 <select name="role" id="role" class="form-control">
                                    <option value="" disabled selected>Choose a Role</option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>" <?php if($role->id == $user->hasRole($role)): ?>  selected <?php endif; ?>><?php echo e($role->name); ?></option>
                                               
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>   
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" value="Update" class="btn btn-success">
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
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\users\edit.blade.php ENDPATH**/ ?>