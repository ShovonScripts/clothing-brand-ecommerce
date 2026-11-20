
<?php $__env->startSection('content'); ?>

<style>
 th, td, h4, .img_manage, .form-label {
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
                    <li class="breadcrumb-item active img_manage">Home Section Image Manage</li>
                </ol>
            </div>
            <h4 class="page-title">Home Section Image Manage</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row ">
    <div class="p-1 m-0 col-sm-12 col-md-12  col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4> Home Section Image Create</h4>
            </div>
            <div class="card-body">
   
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('image.create')): ?>
                <form method="POST" action="<?php echo e(route('admin.home_section_images.store')); ?>" id="ajax_form">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Desktop Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            
                            <div class="mb-3">
                                <label  class="form-label">Mobile Image</label>
                                <input type="file" name="mobile_image" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label  class="form-label">Sections</label>
                                <select class="form-control" name="section">
                                    <?php $__currentLoopData = getSectionLists(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e($i); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label  class="form-label">Link</label>
                                <input type="text" name="link" class="form-control">
                            </div>

                            <div class="mb-3">

                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="is_for_small" value="1">
                                <label class="form-check-label" for="exampleCheck1" style="color: black;"> Is For Small </label>

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
    <div class="p-1 m-0 col-sm-12 col-md-12 col-lg-7">
        <div class="card">
            <div class="card-body">
   

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>SL</th>
                                <th>Section</th>
                                <th>Desktop Image</th>
                                <th>Mobile Image</th>
                                <th>Is For Small</th>
                                <th style="width: 125px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td> <?php echo e($key+1); ?> </td>
                                <td> <?php echo e(getSectionLists()[$item->section]); ?> </td>
                                <td>
                                    <img src="<?php echo e(getImage('homeimages', $item->image)); ?>" width="120"> 
                                </td>
                                
                                <td>
                                    <img src="<?php echo e(getImage('homeimages', $item->mobile_image)); ?>" width="120"> 
                                </td>

                                <td> <?php echo e($item->is_for_small=='1' ?'yes':''); ?> </td>

                                <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('image.edit')): ?>
                                    <a href="<?php echo e(route('admin.home_section_images.edit',[$item->id])); ?>" class="action-icon btn_modal"> 
                                        <i class="mdi mdi-square-edit-outline"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('image.delete')): ?>
                                    <a href="<?php echo e(route('admin.home_section_images.destroy',[$item->id])); ?>" class="delete action-icon"> <i class="mdi mdi-delete"></i></a>
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
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/home_section_images/index.blade.php ENDPATH**/ ?>