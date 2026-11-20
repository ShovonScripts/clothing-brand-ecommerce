
<?php $__env->startSection('content'); ?>

<style>
 th, td, h4, .br_manage, .form-label {
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
                    <li class="breadcrumb-item active br_manage">Brand Manage</li>
                </ol>
            </div>
            <h4 class="page-title">Brand Manage</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="p-1 col-md-12 col-sm-12  col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4> Brand Create</h4>
            </div>
            <div class="card-body">
   
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('type.create')): ?>
                <form method="POST" action="<?php echo e(route('admin.types.store')); ?>" id="ajax_form">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Brand Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Brand Name">
                            </div>

                            <div class="mb-3">
                                <label  class="form-label">Brand Image</label>
                                <input type="file" name="image" class="form-control">
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
              <div class="col-sm-12 mb-2">
                <div class="row">
                  <div class="col-lg-6">

                    <div class="col-auto">
                      <a class=" btn btn-sm btn-info top_update" href="<?php echo e(route('admin.topBrandUpdate')); ?>?is_top=1">Active Top Brand</a>
                      <a class=" btn btn-sm btn-danger top_update" href="<?php echo e(route('admin.topBrandUpdate')); ?>?is_top=0">De-active Top Brand</a>
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
              <div class="col-sm-12">
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
                                <th>Brand</th>
                                <th>Brand Image</th>
                              	<th>Brand Top</th>
                                <th style="width: 125px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                  <input type="checkbox" class="checkbox" value="<?php echo e($item->id); ?>">
                              	</td>
                                <td> <?php echo e($item->name); ?> </td>
                                <td>
                                    <img src="<?php echo e(getImage('types', $item->image)); ?>" width="150"> 
                                </td>
                              	<td> <?php echo e($item->is_top=='1'?'yes':'no'); ?> </td>
                                <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('type.edit')): ?>
                                    <a href="<?php echo e(route('admin.types.edit',[$item->id])); ?>" class="action-icon btn_modal"> 
                                        <i class="mdi mdi-square-edit-outline"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('type.delete')): ?>
                                    <a href="<?php echo e(route('admin.types.destroy',[$item->id])); ?>" class="delete action-icon"> <i class="mdi mdi-delete"></i></a>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
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
    
    
    $(document).on('click', 'a.top_update', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
    
        var product = $('input.checkbox:checked').map(function(){
          return $(this).val();
        });
        var brand_ids=product.get();
        
        if(brand_ids.length ==0){
            toastr.error('Please Select A Product First !');
            return ;
        }
        
        $.ajax({
           type:'GET',
           url:url,
           data:{brand_ids},
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
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/types/index.blade.php ENDPATH**/ ?>