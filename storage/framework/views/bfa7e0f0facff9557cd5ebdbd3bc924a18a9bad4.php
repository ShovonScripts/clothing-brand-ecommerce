
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                    <li class="breadcrumb-item active">Combo OfferManage</li>
                </ol>
            </div>
            <h4 class="page-title">Combo OfferManage</h4>
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
                                <label  class="visually-hidden">Search</label>
                                <input type="search" class="form-control" placeholder="Search..." name="q" value="<?php echo e($q??''); ?>">
                            </div>
                            
                            <div class="col-auto">
                                <label for="submit" class="visually-hidden">Submit</label>
                                <input type="submit" class="form-control btn btn-sm btn-primary" id="submit" value="Submit">
                                
                            </div>
                        </form>
                        
                    </div>
                    <div class="col-xl-4">
                        <div class="text-xl-end mt-xl-0 mt-2">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('combo.create')): ?>
                            <a href="<?php echo e(route('admin.combos.create')); ?>" class="btn btn-danger mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add New Combo Product</a>
                        <?php endif; ?>
                        </div>
                    </div><!-- end col-->
                </div>
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Total Item</th>
                                    <th style="width: 125px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td> <?php echo e($item->product->name); ?> </td>
                                    <td>
                                        <img src="<?php echo e(getImage('products',$item->product->image)); ?>" width="180">    
                                    </td>
                                    <td> <?php echo e($item->products->count()); ?> </td>
                                    <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('combo.edit')): ?>
                                        <a href="<?php echo e(route('admin.combos.edit',[$item->id])); ?>" class="action-icon"> 
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('combo.delete')): ?>
                                        <a href="<?php echo e(route('admin.combos.destroy',[$item->id])); ?>" class="delete action-icon"> <i class="mdi mdi-delete"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('combo.view')): ?>
                                    <a href="<?php echo e(route('admin.combos.show',[$item->id])); ?>" class="action-icon btn_modal"> <i class="mdi mdi-details"></i></a>
                                    <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <p><?php echo urldecode(str_replace("/?","?",$items->appends(Request::all())->render())); ?></p>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div> <!-- end row -->
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/combos/index.blade.php ENDPATH**/ ?>