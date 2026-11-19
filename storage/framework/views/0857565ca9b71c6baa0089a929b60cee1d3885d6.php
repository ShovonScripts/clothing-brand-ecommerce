
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                    <li class="breadcrumb-item active">Permission List</li>
                </ol>
            </div>
            <h4 class="page-title">Permission List</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
  	<div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4> Permission Create</h4>
                
                <form action="<?php echo e(route('admin.permissions.store')); ?>" method="POST" id="ajax_form">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <input type="text" id="permission" class="form-control" name="name" placeholder="Enter permission name...">
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Save" class="btn btn-success">
                    <hr>
                </form>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
    <div class="col-6">
        <div class="card">
            <div class="card-body">
             	 <h4> Permission List</h4>
                <div class="row mb-2">
                    <div class="col-xl-8">
                        <form class="row gy-2 gx-2 align-items-center justify-content-xl-start justify-content-between">
                            <div class="col-auto">
                                <label for="inputPassword2" class="visually-hidden">Search</label>
                                <input type="search" class="form-control" id="inputPassword2" placeholder="Search..." name="q" value="<?php echo e(request('q')??''); ?>">
                            </div>
                            
                            <div class="col-auto">
                                <label for="submit" class="visually-hidden">Submit</label>
                                <input type="submit" class="form-control btn btn-sm btn-primary" id="submit" value="Submit">
                                
                            </div>
                        </form>
                        
                    </div>
                    
                    <div class="col-xl-4">
                        <div class="text-xl-end mt-xl-0 mt-2">
                             <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission.create')): ?>
                                <a type="button" href="<?php echo e(route('admin.permissions.create')); ?>" class="btn btn-danger mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add Permission</a>
                             <?php endif; ?>
                            
                        </div>
                    </div><!-- end col-->
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Permission</th>
                                <th style="width: 125px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($permission->name); ?></td>
                                <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission.edit')): ?>
                                <a href="<?php echo e(route('admin.permissions.edit',[$permission->id])); ?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission.delete')): ?>
                                    <a href="<?php echo e(route('admin.permissions.destroy',[$permission->id])); ?>" class="delete action-icon"> <i class="mdi mdi-delete"></i></a>
                                <?php endif; ?>
                               
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo e($permissions->links()); ?>

                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div> <!-- end row -->
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/permissions/index.blade.php ENDPATH**/ ?>