
<?php $__env->startSection('content'); ?>

<?php
use App\Models\Information;
$info = Information::first();

?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                    <li class="breadcrumb-item active">Coupon Code Manage</li>
                </ol>
            </div>
            <h4 class="page-title">Coupon Code Manage</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-sm-12 col-md-4">            
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('size.create')): ?>
        <div class="card">
            <div class="card-header">
                <h4> Coupon Code Create</h4>
            </div>
            <div class="card-body">
   
                <form method="POST" action="<?php echo e(route('admin.coupon_codes.store')); ?>" id="ajax_form">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Coupon Code</label>
                                <input type="text" name="code" class="form-control" placeholder="Coupon Code">
                            </div>
                            
                          	<div class="mb-3">
                                <label  class="form-label">Discount Type</label>
                              <select class="form-control" name="discount_type">
                                	<option value="fixed">Fixed</option>
                                	<option value="percentage">Percentage</option>
                              </select>
                            </div>
                          
                            <div class="mb-3">
                                <label  class="form-label">Discount Amount</label>
                                <input type="number" step="any" name="amount" class="form-control">
                            </div>
                          
                          	<div class="mb-3">
                                <label  class="form-label">Minimum Purchase</label>
                                <input type="number" step="any" name="minimum_amount" class="form-control">
                            </div>
                            
                            <div class="mb-3">
                                <label  class="form-label">Date Start</label>
                                <input type="date" step="any" name="start" class="form-control">
                            </div>
                            
                            <div class="mb-3">
                                <label  class="form-label">Date End</label>
                                <input type="date" step="any" name="end" class="form-control">
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
    <div class="col-sm-12 col-md-8">
        <div class="card">
            <div class="card-body">
   

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0 table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>SL</th>
                                <th>Coupon Code</th>
                              	<th>Discount Type</th>
                                <th>Discount Amount</th>
                              	<th>Minimum Purchase</th>
                                <th>Date Start</th>
                                <th>Date End</th>
                                <th style="width: 125px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td> <?php echo e($key+1); ?> </td>
                                <td> <?php echo e($item->code); ?> </td>
                              	<td> <?php echo e($item->discount_type); ?> </td>
                                <td> <?php echo e($item->amount); ?> </td>
                              	<td> <?php echo e($item->minimum_amount); ?> </td>
                                <td> <?php echo e($item->start); ?></td>
                                <td> <?php echo e($item->end); ?></td>
                                <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('size.edit')): ?>
                                    <a href="<?php echo e(route('admin.coupon_codes.edit',[$item->id])); ?>" class="action-icon btn_modal"> 
                                        <i class="mdi mdi-square-edit-outline"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('size.delete')): ?>
                                    <a href="<?php echo e(route('admin.coupon_codes.destroy',[$item->id])); ?>" class="delete action-icon"> <i class="mdi mdi-delete"></i></a>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-body-->
        </div>
      
      <div class="row mb-2">
         <form method="GET" action="<?php echo e(route('admin.status.coupon')); ?>" id="">
                    <?php echo csrf_field(); ?>
        <div class="col-md-3" style="margin-bottom: 10px;">
                            <div class="form-group">
                               <strong for="role">Coupon Manage</strong>
                                <select class="form-select" class="coupon_visibility" name="coupon_visibility">                                
                                <option value="1" <?php echo e($info->coupon_visibility == 1 ?'selected':''); ?> >On</option>                               
                                <option value="0" <?php echo e($info->coupon_visibility == 0 ?'selected':''); ?> >Off</option>  
                               </select>
                            </div>                            
          
                        </div>
        
        				<div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                        </div>
        </form>
      </div>  
              
      
      <!-- end card-->
    </div> <!-- end col -->
</div> <!-- end row -->
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\coupon_codes\index.blade.php ENDPATH**/ ?>