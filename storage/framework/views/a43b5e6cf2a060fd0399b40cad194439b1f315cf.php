
<?php $__env->startSection('content'); ?>
<div class="row mt-3">
    <div class="col-12">
           <div class="card">
           <div class="card-body">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                    <li class="breadcrumb-item active">Product List</li>
                </ol>
            </div>
            <h4 class="page-title">Product Details</h4>
            <div class="row">
                <div class="col-md-6"><strong>Product :</strong> <?php echo e($product->name); ?></div><br>
                <div class="col-md-6"><strong>Sku :</strong> <?php echo e($product->sku); ?></div><br>
                <div class="col-md-6"><strong>Category :</strong> <?php echo e($product->category?$product->category->name:''); ?></div><br>
                <div class="col-md-6"><strong>Brand :</strong> <?php echo e($product->brand?$product->brand->name:''); ?></div><br>
                <div class="col-md-6"><strong>Type :</strong> <?php echo e($product->type); ?></div><br>
            </div>
            <div class="row">
                <div class="col-md-6"><strong>Purchase  Price :</strong> <?php echo e($product->purchase_price); ?></div>
                <div class="col-md-6"><strong>Selling Price :</strong> <?php echo e($product->sell_price); ?></div>
                <div class="col-md-6"><strong>Color :</strong> <?php echo e($product->color); ?></div>
            </div>
            <hr>
             <div class="row mb-3">
                <?php if($product->image): ?>
                <div class="col-md-3">
                    <strong>Product Image :</strong> <br>
                    <img src="<?php echo e(getImage('products',$product->image)); ?>" height=200 width=200>
                </div>
                <?php endif; ?>
                

                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <div class="col-md-3">
                    <strong><strong>Multi Image : <a href="<?php echo e(route('admin.deleteImage',[$image->id])); ?>" class="btn btn-sm btn-danger" onclick="return confirm(' you want to delete?');">Delete</a></strong><br> 
                    <img src="<?php echo e(getImage('products',$image->image)); ?>" height="200" width="200">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
             <?php if($product->description): ?> 
             
            
                <strong>Product Description : </strong><?php echo e($product->description); ?>

             </div>
             <?php endif; ?>
            <?php if($product->body): ?>
             <div>
                <strong>Body : </strong><?php echo $product->body; ?>

             </div>
            <?php endif; ?> 

            <?php if($product->feature): ?>
             <div>
                <strong>Feature : </strong><?php echo $product->feature; ?>

             </div>
            <?php endif; ?> 
            <?php if($product->discount_type): ?>
             <div>
                <strong>Discount Type : </strong><?php echo e($product->discount_type); ?>

             </div>
            <?php endif; ?>
            <?php if($product->dicount_amount !=0): ?>
             <div>
                <strong>Discount Amount : </strong><?php echo e($product->dicount_amount); ?>

             </div>
            <?php endif; ?>
            <?php if($product->after_discount !=0): ?>
             <div>
                <strong>After Discount : </strong><?php echo e($product->after_discount); ?>

             </div>
            <?php endif; ?> 
        </div>

    </div>
</div>  
</div>
</div> 
<hr>
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
                        </div>
                    </div><!-- end col-->
                </div>
                <h4 class="text-center">Product-Size Wise Available Stock Quantity</h4><br>
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Sl</th>
                                <th>Weight</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Stock Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $product->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e($v->weight->title); ?></td>
                                    <td><?php echo e($v->size->title); ?></td>
                                    <td><?php echo e($v->color->name); ?></td>
                                    <td><?php echo e($v->stocks->sum('quantity')); ?></td>
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
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\products\show.blade.php ENDPATH**/ ?>