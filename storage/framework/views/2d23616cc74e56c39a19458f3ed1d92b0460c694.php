
<?php $__env->startSection('content'); ?>

<style>
 th, td, h4, .cr_manage, .form-label {
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
                    <li class="breadcrumb-item active cr_manage">Category Manage</li>
                </ol>
            </div>
            <h4 class="page-title">Category Manage</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="p-1 col-lg-4 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4> Category Create</h4>
            </div>
            <div class="card-body">
   
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category.create')): ?>
                <form method="POST" action="<?php echo e(route('admin.categories.store')); ?>" id="ajax_form">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        
                        <div class="col-lg-12">
                            
                        
                            <div class="mb-3">
                                <label  class="form-label">Category Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Category Name">
                            </div>
                            
                            <div class="mb-3">
                                <label  class="form-label">Category Slug</label>
                                <input type="text" name="url" class="form-control" placeholder="Category Slug">
                            </div>

                            <div class="mb-3">
                                <label  class="form-label">Category Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label  class="form-label">Parent Category</label>
                                
                                <select class="form-control select2" name="parent_id">
                                    <option value="" hidden>Select Category ..</option>
                                    <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e($cat); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>

                </form>
                <?php endif; ?>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>
    <div class="p-1 col-md-12 col-sm-12 col-lg-8">
        
        
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                        
                            <div class="col-auto">
                                <a class=" btn btn-sm btn-info popular_update" href="<?php echo e(route('admin.popularCatgeory')); ?>?is_popular=1">Active Popular</a>
                                <a class=" btn btn-sm btn-danger popular_update" href="<?php echo e(route('admin.popularCatgeory')); ?>?is_popular=0">De-active Popular</a>
                            </div>
                        </div>
                      
                        <div class="col-lg-6">
                            <form class="row gy-2 gx-2 align-items-center justify-content-xl-start justify-content-between">
                                <div class="col-auto">
                                    <label for="inputPassword2" class="visually-hidden">Search</label>
                                    <input type="search" class="form-control" id="inputPassword2" placeholder="Search..." name="q" value="<?php echo e($q??''); ?>">
                                </div>
                                
                                <div class="col-auto">
                                    <label for="submit" class="visually-hidden">Submit</label>
                                    <input type="submit" class="form-control btn btn-sm btn-primary" id="submit" value="Submit">
                                    
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12 mt-4">
        
                    <div class="table-responsive">
                        <table class="table table-centered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>
                                    
                                        <div class="form-check">
                                          <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input check_all" value="">Check All
                                          </label>
                                        </div>
                                    </th>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th>Parent Category</th>
                                    <th>Category Image</th>
                                    <th>Popular</th>
                                    <th style="width: 125px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td> <input type="checkbox" class="checkbox" value="<?php echo e($item->id); ?>"> </td>
                                    <td> <?php echo e($item->name); ?> </td>
                                    <td> <?php echo e($item->url); ?> </td>
                                    <td> <?php echo e($item->parent?$item->parent->name:''); ?> </td>
                                    <td>
                                        <img src="<?php echo e(getImage('categories', $item->image)); ?>" width="120"> 
                                    </td>
                                    <td> <?php echo e($item->is_popular=='1'?'yes':'no'); ?> </td>
                                    <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category.edit')): ?>
                                        <a href="<?php echo e(route('admin.categories.edit',[$item->id])); ?>" class="action-icon btn_modal"> 
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category.delete')): ?>
                                        <a href="<?php echo e(route('admin.categories.destroy',[$item->id])); ?>" class="delete action-icon"> <i class="mdi mdi-delete"></i></a>
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

<?php $__env->startPush('js'); ?>
<script>

$(document).ready(function(){
    
    $(".check_all").on('change',function(){
      $(".checkbox").prop('checked',$(this).is(":checked"));
    });
    
    
    $(document).on('click', 'a.popular_update', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
    
        var product = $('input.checkbox:checked').map(function(){
          return $(this).val();
        });
        var cat_ids=product.get();
        
        if(cat_ids.length ==0){
            toastr.error('Please Select A Product First !');
            return ;
        }
        
        $.ajax({
           type:'GET',
           url:url,
           data:{cat_ids},
           success:function(res){
               if(res.status==true){
                toastr.success(res.msg);
                window.location.reload();
                
            }else if(res.status==false){
                toastr.error(res.msg);
            }
           }
        });
    
    })
    
    
})
    
    
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/categories/index.blade.php ENDPATH**/ ?>