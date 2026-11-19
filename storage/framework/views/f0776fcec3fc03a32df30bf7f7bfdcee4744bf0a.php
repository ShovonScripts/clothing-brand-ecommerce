
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">User List</li>
                </ol>
            </div>
            <h4 class="page-title">User List</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if(Session::has('success')): ?>
                    <div class="alert alert-success">
                        <strong><?php echo e(Session::get('success')); ?></strong>
                    </div>
                <?php endif; ?>
                <br>
                <div class="row mb-2">
                    <div class="col-xl-3">
                        <div class="text-xl-end mt-xl-0 mt-2">
                            <form>
                                <input type="text" name="q" class="form-control" placeholder="search here.." value="<?php echo e(request('q')??''); ?>">
                            </form>
                        
                        </div>
                    </div><!-- end col-->
                    
                    <div class="col-xl-3">
                        <div class="text-xl-end mt-xl-0 mt-2">
                          <select class="form-control" name="role">
                            <option value="" selected disabled>Select One</option>
                            <option value="">All User</option>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->name); ?>"><?php echo e(ucfirst($role->name)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                    </div><!-- end col-->                    
                  <div class="col-xl-3">
                        <div class="text-xl-end mt-xl-0 mt-2">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.edit')): ?>
                                <a type="button" href="<?php echo e(route('admin.userStatusUpdate')); ?>?status=0" class="status btn btn-primary btn-sm mb-2 me-2"> Active</a>
                                <a type="button" href="<?php echo e(route('admin.userStatusUpdate')); ?>?status=1" class="status btn btn-info btn-sm mb-2 me-2">De-Active</a>
                            <?php endif; ?>
                        
                        </div>
                    </div><!-- end col-->
                    
                    <div class="col-xl-3">
                        <div class="text-xl-end mt-xl-0 mt-2">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.create')): ?>
                                <a type="button" href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-danger mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add New User</a>
                            <?php endif; ?>
                        
                        </div>
                    </div><!-- end col-->
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th><input type="checkbox" id="parent_item"></th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>businessname</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th style="width: 125px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><input type="checkbox" value="<?php echo e($user->id); ?>" class="user_status"></td>
                                <td><?php echo e($user->first_name); ?></td>
                                <td><?php echo e($user->last_name); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php echo e($user->username); ?></td>
                                <td><?php echo e($user->business_name); ?></td>
                                <td>
                                    <?php $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-success"><?php echo e($role); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td><?php echo e($user->status==null ?'De-Active':'Active'); ?></td>
                                <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.edit')): ?>
                                <a href="<?php echo e(route('admin.users.edit',[$user->id])); ?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.delete')): ?>
                                    <a href="<?php echo e(route('admin.users.destroy',[$user->id])); ?>" class="delete action-icon"> <i class="mdi mdi-delete"></i></a>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo e($users->links()); ?>

                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="row">
    <div class="col-md-12">
        <h3 style="text-align: center;color: red;">কমপক্ষে ১ জন Active Worker রাখুন। অন্যথায় Site এ Order আসতে Problem হবে।</3>
    </div>
</div>

<?php $__env->stopSection(); ?> 

<?php $__env->startPush('js'); ?>
<script>

$(document).ready(function(){
    
    $(".check_all").on('change',function(){
      $(".checkbox").prop('checked',$(this).is(":checked"));
    });
    
    
    $(document).on('click', 'a.status', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
    
        var user = $('input.user_status:checked').map(function(){
          return $(this).val();
        });
        var user_ids=user.get();
        
        if(user_ids.length ==0){
            toastr.error('Please Select A Product First !');
            return ;
        }
        
        $.ajax({
           type:'GET',
           url:url,
           data:{user_ids},
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
    
    $(document).on('change', 'select[name="role"]', function(e){
      	let query = $('input[name="q"]').val();
      	let value = $(this).val();
      	location.href = '?q='+query+'&role='+value;
    });
  
    $('#parent_item').change(function(){
        if($(this).prop('checked'))
        $('.user_status').prop('checked', true);
        else $('.user_status').prop('checked', false);
    });    
    
    $('.user_status').change(function(){
        if($('.user_status:checked').length == $('.user_status').length)
        $('#parent_item').prop('checked', true);
        else $('#parent_item').prop('checked', false);
    });
});
    
    
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/users/index.blade.php ENDPATH**/ ?>