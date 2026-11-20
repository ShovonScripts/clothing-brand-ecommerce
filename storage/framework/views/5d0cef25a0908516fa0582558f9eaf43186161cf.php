
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
                    <li class="breadcrumb-item active">Role Update</li>
                </ol>
            </div>
            <h4 class="page-title">Role Update</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="<?php echo e(route('admin.roles.index')); ?>" class="btn btn-secondary">Back</a><br><br>
                <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <strong><?php echo e($error); ?></strong>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                <?php endif; ?>
                <form action="<?php echo e(route('admin.roles.update', $role->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="role">Role Name</strong>
                                <input type="text" id="role" class="form-control" name="name" placeholder="Role name..." value="<?php echo e($role->name); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                            <h4>Permissions</h4>
                            <label for="select_all"><input type="checkbox" id="select_all"> All Permissions</label>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <h4><label class="mb-1 mt-2"><input type="checkbox" class="permission-item" name="permissions[]" value="<?php echo e($permission->id); ?>" <?php if($permission->id == $permission->hasRole($role)): ?> checked <?php endif; ?>> <?php echo e($permission->name); ?></label></h4>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <input type="submit" value="Save" class="btn btn-success">
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
        $("#select_all").change(function(){
            $(".permission-item").prop("checked", $(this).prop("checked"));
    
        });

        $(".permission-item").change(function(){
           if($(this).prop("checked") == false)
           {
                $("#select_all").prop("checked", false);
           }

          select_all();
    
        });

        function select_all()
        {
            if($('.permission-item:checked').length == $('.permission-item').length)
            {
                $("#select_all").prop("checked", true);
            }
        }

        select_all();
  
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\roles\edit.blade.php ENDPATH**/ ?>