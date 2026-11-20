
<?php $__env->startPush('css'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                    <li class="breadcrumb-item active">Combo Offer Create</li>
                </ol>
            </div>
            <h4 class="page-title">Combo Offer Create</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-12 p-5">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('admin.combos.store')); ?>" id="ajax_form">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Select Combo Offer</label>
                                <select class="form-control" name="product_id">
                                    <option hidden value=""> Select One</option>
                                    
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($product->id); ?>"> <?php echo e($product->name); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>Produt</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                   <tbody>
                                       
                                        <tr>
                                            <td>
                                                <select class="form-control select2" name="products[]">
                                                    <option hidden value=""> Select One</option>
                                                    
                                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($item->product && $item->size): ?>
                                                    <option value="<?php echo e($item->id); ?>"> <?php echo e($item->product->name); ?> (<?php echo e($item->size->title); ?>)</option>
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            
                                            <td>
                                                <input type="number" class="form-control" value="1" name="quantity[]">
                                            </td>
                                            
                                            <td>
                                                <a class="btn btn-success btn-sm add"> <i class="mdi mdi-plus"></i> </a>
                                                <a class="btn btn-danger btn-sm remove"> <i class="mdi mdi-delete"></i> </a>
                                            </td>
                                        </tr>
                                    
                                   </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>

                </form>
       
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div> <!-- end row -->
<?php $__env->stopSection(); ?> 

<?php $__env->startPush('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function(){
        
        $(document).on('click','a.add', function(){
            
            let row =`<tr>
                        <td>
                            <select class="form-control select2" name="products[]">
                                <option hidden value=""> Select One</option>
                                
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($item->product && $item->size): ?>
                                <option value="<?php echo e($item->id); ?>"> <?php echo e($item->product->name); ?> (<?php echo e($item->size->title); ?>)</option>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        
                        <td>
                            <input type="number" class="form-control" value="1" name="quantity[]">
                        </td>
                        
                        <td>
                            <a class="btn btn-success btn-sm add"> <i class="mdi mdi-plus"></i> </a>
                            <a class="btn btn-danger btn-sm remove"> <i class="mdi mdi-delete"></i> </a>
                        </td>
                    </tr>`;
            $('.table tbody').append(row);
        });
        
        $(document).on('click','a.remove', function(){
            var whichtr = $(this).closest("tr");
            whichtr.remove();      
        });
    });
</script>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/combos/create.blade.php ENDPATH**/ ?>