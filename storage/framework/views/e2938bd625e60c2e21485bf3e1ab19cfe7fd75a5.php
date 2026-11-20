
<?php $__env->startSection('content'); ?>

<style>
 th, td, h4, .pr_list, .form-label {
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
                    <li class="breadcrumb-item active pr_list">Product List</li>
                </ol>
            </div>
            <h4 class="page-title">Product List</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-12 p-1">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    
                    <div class="col-md-4">
                    
                        <div class="#" style=" ">
                            <a class=" btn btn-sm btn-info recomm_update" href="<?php echo e(route('admin.recommendedUpdate')); ?>?is_recommended=1" style=" margin-right: 10px;margin-bottom: 10px; ">
                              Active (Recomm)
                          </a>
                            <a class=" btn btn-sm btn-danger recomm_update" href="<?php echo e(route('admin.recommendedUpdate')); ?>?is_recommended=0" style=" margin-bottom: 10px; ">
                              De-active (Recomm)
                          </a>
                        </div>
                    </div>
                  
                    <div class="col-md-5" style="  ">
                        <form class="row align-items-center">
                            <div style="width:60%;margin-top: 0px;">
                                <label for="inputPassword2" class="visually-hidden">Search</label>
                                <input type="search" class="form-control" id="inputPassword2" placeholder="Search..." name="q" value="<?php echo e($q??''); ?>">
                            </div>
                            
                            <div class="col-auto" style="margin-top: 0px;" >
                                <label for="submit" class="visually-hidden">Submit</label>
                                <input type="submit" class="form-control btn btn-sm btn-primary" id="submit" value="Submit">
                                
                            </div>
                        </form>
                        
                    </div>
                    <div class="col-md-3">
                        <div class="text-xl-end mt-xl-0 mt-2" style="  ">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.create')): ?>
                            <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-danger mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add Product</a>
                        <?php endif; ?>
                        <a type="button" href="<?php echo e(route('admin.productExport')); ?>" class="btn btn-light mb-2" style="color: black;">Export</a>
                        </div>
                    </div><!-- end col-->
                </div>

                <div class="col-md-12 col-sm-12 p-1">
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:7%">Action</th>
                                <th>
                                    
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input check_all" value="">
                                      </label>
                                    </div>
                                </th>
                                <th style="width:12%">Product</th>
                              	<th style="width:8%">Sku</th>
                                <th>Image</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Purchase Price</th>
                                <th>Sell Price</th>
                                <th>Stock</th>
                              	<th>Recommended</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td>
                                  	<a href="<?php echo e(route('admin.productCopy',[$item->id])); ?>" class="action-icon">copy</a>
                                    <a href="<?php echo e(route('admin.products.show',[$item->id])); ?>" class="action-icon"> <i class="mdi mdi-details"></i></a>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.edit')): ?>
                                    <a href="<?php echo e(route('admin.products.edit',[$item->id])); ?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.delete')): ?>
                                    <a href="<?php echo e(route('admin.products.destroy',[$item->id])); ?>" class="delete action-icon"> <i class="mdi mdi-delete"></i></a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <input type="checkbox" class="checkbox" value="<?php echo e($item->id); ?>">
                                    
                                </td>
                                <td> <?php echo e($item->name); ?></td>
                              	<td> <?php echo e($item->sku); ?></td>
                                <td>
                        
                                    <div class="flex-shrink-0">
                                        <img src="<?php echo e(getImage('products',$item->image)); ?>" class="rounded-circle avatar-xs" alt="friend">
                                    </div>
                                        
                                </td>
                                <td> <?php echo e($item->type); ?></td>
                                <td><?php echo e($item->category?$item->category->name:''); ?></td>
                                <td><?php echo e($item->brand?$item->brand->name:''); ?></td>
                                <td><?php echo e($item->purchase_price); ?></td>
                                <td><?php echo e($item->sell_price); ?></td>
                                <td><?php echo e($item->stocks->sum('quantity')); ?></td>
                              
                              	<td> <?php echo e($item->is_recommended=='1'?'yes':'no'); ?> </td>
                                
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
<?php $__env->startPush('js'); ?>
<script>

$(document).ready(function(){
    
    $(".check_all").on('change',function(){
      $(".checkbox").prop('checked',$(this).is(":checked"));
    });
    
    
    $(document).on('click', 'a.recomm_update', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
    
        var product = $('input.checkbox:checked').map(function(){
          return $(this).val();
        });
        var product_ids=product.get();
        
        if(product_ids.length ==0){
            toastr.error('Please Select A Product First !');
            return ;
        }
        
        $.ajax({
           type:'GET',
           url:url,
           data:{product_ids},
           success:function(res){
               if(res.status==true){
                toastr.success(res.msg);
                window.location.reload();
                
            }else if(res.status==false){
                toastr.error(res.msg);
            }
           }
        });
    
    });
    
    
})
    
    
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\products\index.blade.php ENDPATH**/ ?>