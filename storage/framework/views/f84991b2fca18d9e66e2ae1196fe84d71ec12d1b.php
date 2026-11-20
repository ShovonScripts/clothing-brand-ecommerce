
<?php $__env->startSection('content'); ?>

<style>
 th, td, h4, .pur_list, .form-label {
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
                    <li class="breadcrumb-item active pur_list">Purchase List</li>
                </ol>
            </div>
            <h4 class="page-title">Purchase List</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-xl-8">
                                               
                    </div>
                    <div class="col-xl-4">
                        <div class="text-xl-end mt-xl-0 mt-2">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.create')): ?>
                                <a href="<?php echo e(route('admin.purchase.create')); ?>" class="btn btn-danger mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add New Purchase</a>
                            <?php endif; ?>
                            <button type="button" class="btn btn-light mb-2" style="color: black;">Export</button>
                        </div>
                    </div><!-- end col-->
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Ref</th>
                               <!-- <th>Supplier</th> -->
                                <th>Status</th>
                                <th>Amount</th>
                                
                                <th>Note</th>
                                <th style="width: 125px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->date); ?> </td>
                                <td><a class="text-body fw-bold">#<?php echo e($item->ref); ?></a> </td>
                              
                                <td><h5 class="my-0"><span class="badge badge-info-lighten"><?php echo e($item->status); ?></span></h5></td>
                                <td><?php echo e($item->amount); ?></td>
                                <td><?php echo e($item->note); ?></td>
                                
                                <td>
                                    <a href="<?php echo e(route('admin.purchase.show',[$item->id])); ?>" class="action-icon"> <i class="mdi mdi-details"></i></a>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.edit')): ?>
                                    <a href="<?php echo e(route('admin.purchase.edit',[$item->id])); ?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.delete')): ?>
                                    <a href="<?php echo e(route('admin.purchase.destroy',[$item->id])); ?>" class="delete action-icon"> <i class="mdi mdi-delete"></i></a>
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
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/purchase/index.blade.php ENDPATH**/ ?>