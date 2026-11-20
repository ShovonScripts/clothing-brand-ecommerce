
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
                    <li class="breadcrumb-item active">Page update</li>
                </ol>
            </div>
            <h4 class="page-title">Landing Page update</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">

        <div class="card">

            <div class="card-body">

                <form method="POST" action="<?php echo e(route('admin.landing_pages.update',[$item->id])); ?>" id="ajax_form">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                     <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Page Title</label>
                                <input type="text" value="<?php echo e($item->title1); ?>" name="title1" class="form-control" placeholder="Title">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Quality Assurance</label>
                                <textarea class="form-control" name="title2" rows="10" cols="10"><?php echo e($item->title2); ?></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Video Url (Embedded Code)</label>
                                <input type="text" value="<?php echo e($item->video_url); ?>" name="video_url" class="form-control" placeholder="Title">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Product Overview</label>
                                <textarea class="form-control" name="des1" rows="10" cols="10">
                                    <?php echo $item->des1; ?>

                                </textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Slider Top Text</label>
                                 <input type="text" value="<?php echo e($item->feature); ?>" name="feature" class="form-control" placeholder="Title">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div>
                                <img src="<?php echo e(getImage('landing_pages',$item->image)); ?>" width="50" class="mb-2">
                            </div>
                            <div class="mb-3">

                                <label class="form-label">Image</label>
                               <input type="file" name="image" class="form-control">
                               <input type="hidden" name="product_id" value="<?php echo e($item->product_id); ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div class="d-flex">
                                <?php $__currentLoopData = $item->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="img-box">
                                    <a href="<?php echo e(route('admin.delete_slider',[$image->id])); ?>" class="" onclick="return confirm(' you want to delete?');">&times;</a>
                                    <img src="<?php echo e(getImage('landing_sliders',$image->image)); ?>" width="50">
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <label  class="form-label">Slider Image</label>
                            <input type="file" name="sliderimage[]" class="form-control" multiple>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Old Price</label>
                                <input type="text" name="old_price" value="<?php echo e($item->old_price); ?>" class="form-control" placeholder="Title">
                            </div>
                        </div> 

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">New Price</label>
                                <input type="text" name="new_price" value="<?php echo e($item->new_price); ?>" class="form-control" placeholder="Title">
                            </div>
                        </div> 
                        
                         <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Phone Number</label>
                                <input type="text" name="phone" value="<?php echo e($item->phone); ?>" class="form-control" placeholder="Title">
                            </div>
                        </div> 
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Bottom Title</label>
                                 <input type="text" name="title3" class="form-control" placeholder="Bottom Title" value="<?php echo e($item->title3); ?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Feature</label>
                                <textarea class="form-control" name="des3" rows="10" cols="10">
                                    <?php echo $item->des3; ?>

                                </textarea>
                            </div>
                        </div>
                         <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Bottom Feature</label>
                                <textarea class="form-control" name="title4" rows="10" cols="10">
                                    <?php echo $item->title4; ?>

                                </textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Home Delivery</label>
                                <input type="text" value="<?php echo e($item->pay_text); ?>" name="pay_text" class="form-control" placeholder="Title">
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
</div> <!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('title2', {
        filebrowserUploadUrl: "<?php echo e(route('admin.ckeditor.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form'
    });
</script>

<script type="text/javascript">
    CKEDITOR.replace('des1', {
        filebrowserUploadUrl: "<?php echo e(route('admin.ckeditor.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form'
    });
</script>

<script type="text/javascript">
    CKEDITOR.replace('des2', {
        filebrowserUploadUrl: "<?php echo e(route('admin.ckeditor.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form'
    });
</script>
<script type="text/javascript">
    CKEDITOR.replace('des3', {
        filebrowserUploadUrl: "<?php echo e(route('admin.ckeditor.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form'
    });
</script>
<script type="text/javascript">
    CKEDITOR.replace('title4', {
        filebrowserUploadUrl: "<?php echo e(route('admin.ckeditor.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form'
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\landing_pages\edit.blade.php ENDPATH**/ ?>