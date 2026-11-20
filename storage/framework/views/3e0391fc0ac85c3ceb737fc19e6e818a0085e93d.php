
<?php $__env->startSection('content'); ?>

<style>
 th, td, h4, .cl_manage, .form-label {
  	color: black !important;
  }
</style>


<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                    <li class="breadcrumb-item active cl_manage">Color Manage</li>
                </ol>
            </div>
            <h4 class="page-title">Color Manage</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-6">            
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('size.create')): ?>
        <div class="card">
            <div class="card-header">
                <h4> Colore Create</h4>
            </div>
            <div class="card-body">
   
                <form method="POST" action="<?php echo e(route('admin.colors.store')); ?>" id="ajax_form">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Color Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Colore Name">
                            </div>

                            <div class="mb-3">
                                <label  class="form-label">Color Code</label>
                                <input type="text" name="code" class="form-control" placeholder="Colore Code">
                            </div>

                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>

                </form>
            
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>   
    <?php endif; ?>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
   

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>SL</th>
                                <th>Colore Name</th>
                                <th>Colore Code</th>
                                <th style="width: 125px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td> <?php echo e($key+1); ?> </td>
                                <td> <?php echo e($item->name); ?> </td>
                                <td> <?php echo e($item->code); ?> </td>
                                <td>
                                <?php if($key == 0): ?> 
                               
                                <?php else: ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('size.edit')): ?>
                                 <a href="<?php echo e(route('admin.colors.edit',[$item->id])); ?>" class="action-icon btn_modal"> 
                                        <i class="mdi mdi-square-edit-outline"></i>
                                    </a>
                                     <?php endif; ?>
                                <?php endif; ?>    
                                <?php if($key == 0): ?>
                                <?php else: ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('size.delete')): ?>
                                <a href="<?php echo e(route('admin.colors.destroy',[$item->id])); ?>" class="delete action-icon"> <i class="mdi mdi-delete"></i></a>
                               <?php endif; ?>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div> <!-- end row -->
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\colors\index.blade.php ENDPATH**/ ?>