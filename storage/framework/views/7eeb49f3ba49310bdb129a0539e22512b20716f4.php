
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                    <li class="breadcrumb-item active">Slider Manage</li>
                </ol>
            </div>
            <h4 class="page-title">Slider Manage</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="p-1 m-0 col-sm-12 col-md-12 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4> Slider Create</h4>
            </div>
            <div class="card-body">
   
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('slider.create')): ?>
                <form method="POST" action="<?php echo e(route('admin.sliders.store')); ?>" id="ajax_form">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Title">
                            </div>

                            <div class="mb-3">
                                <label  class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" placeholder="Description">
                            </div>

                            <div class="mb-3">
                                <label  class="form-label">Desktop Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            
                            <div class="mb-3">
                                <label  class="form-label">Mobile Image</label>
                                <input type="file" name="mobile_image" class="form-control">
                            </div>
                            
                            
                            <div class="mb-3">
                                <label  class="form-label">Link</label>
                                <input type="text" name="link" class="form-control" placeholder="Link">
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
    <div class="p-1 m-0 col-sm-12 col-md-12 col-lg-8">
        <div class="card p-0 m-0">
            <div class="card-body">
  
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Desktop Image</th>
                                <th>Mobile Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th style="width: 125px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <img src="<?php echo e(getImage('sliders', $item->image)); ?>" width="120"> 
                                </td>
                                
                                 <td>
                                    <img src="<?php echo e(getImage('sliders', $item->mobile_image)); ?>" width="120"> 
                                </td>
                                
                                <td> <?php echo e($item->title); ?> </td>
                                <td> <?php echo e($item->description); ?> </td>
                                <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('slider.edit')): ?>
                                    <a href="<?php echo e(route('admin.sliders.edit',[$item->id])); ?>" class="action-icon btn_modal"> 
                                        <i class="mdi mdi-square-edit-outline"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('slider.delete')): ?>
                                    <a href="<?php echo e(route('admin.sliders.destroy',[$item->id])); ?>" class="delete action-icon"> <i class="mdi mdi-delete"></i></a>
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
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/sliders/index.blade.php ENDPATH**/ ?>