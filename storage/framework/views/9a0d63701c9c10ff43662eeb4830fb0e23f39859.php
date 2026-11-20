
<?php $__env->startSection('content'); ?>

<style>
 th, td, h4, .pr_dis, .form-label {
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
                    <li class="breadcrumb-item active pr_dis">Product Discount List</li>
                </ol>
            </div>
            <h4 class="page-title">Product Discount List</h4>
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
                        <form class="row gy-2 gx-2 align-items-center justify-content-xl-start justify-content-between">
                            <div class="col-auto">
                                <label for="inputPassword2" class="visually-hidden">Search</label>
                                <input type="search" class="form-control" id="inputPassword2" placeholder="Search...">
                            </div>
                            <div class="col-auto">
                                <div class="d-flex align-items-center">
                                    <label for="status-select" class="me-2" style="color: black;">Status</label>
                                    <select class="form-select" id="status-select">
                                        <option selected>Choose...</option>
                                        <option value="1">Paid</option>
                                        <option value="2">Awaiting Authorization</option>
                                        <option value="3">Payment failed</option>
                                        <option value="4">Cash On Delivery</option>
                                        <option value="5">Fulfilled</option>
                                        <option value="6">Unfulfilled</option>
                                    </select>
                                </div>
                            </div>
                        </form>                            
                    </div>
                    <div class="col-xl-4">
                        <div class="text-xl-end mt-xl-0 mt-2">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discount.create')): ?>
                            <a href="<?php echo e(route('admin.product_discounts.create')); ?>" class="btn btn-danger mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add New Product Discount</a>
                        <?php endif; ?>
                            <button type="button" class="btn btn-light mb-2" style="color: black;">Export</button>
                        </div>
                    </div><!-- end col-->
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                
                                <th>Product</th>
                                <th>Image</th>
                           
                                <th>Sell Price</th>
                                <th>Discount Type</th>
                                <th>Discount Amount</th>
                                <th>After Discount</th>
                                <th style="width: 125px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php echo e($item->name); ?>

                                </td>
                                <td>
                        
                                    <div class="flex-shrink-0">
                                        <img src="<?php echo e(getImage('products',$item->image)); ?>" class="rounded-circle avatar-xs" alt="friend">
                                    </div>
                                        
                                </td>
                             
                                <td><?php echo e($item->sell_price); ?></td>
                                <td><?php echo e($item->discount_type); ?></td>
                                <td><?php echo e($item->dicount_amount); ?></td>
                                <td><?php echo e($item->after_discount); ?></td>
                                <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discount.edit')): ?>
                                    <a href="<?php echo e(route('admin.product_discounts.edit',[$item->id])); ?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discount.delete')): ?>
                                    <a href="<?php echo e(route('admin.product_discounts.destroy',[$item->id])); ?>" class="delete action-icon"> <i class="mdi mdi-delete"></i></a>
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
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/product_discounts/index.blade.php ENDPATH**/ ?>