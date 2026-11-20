
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
            <h4 class="page-title">Page update</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-12">            
       
        <div class="card">
            
            <div class="card-body">
   
                <form method="POST" action="<?php echo e(route('admin.pages.update',[$item->id])); ?>" id="ajax_form">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Page Select</label>
                                <select name="page" class="form-control">
                                    <?php $__currentLoopData = getPageName(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e($key==$item->page?'selected':''); ?>><?php echo e($p); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label  class="form-label">Page Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo e($item->title); ?>">
                            </div>

                            

                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Page Body</label>
                                <textarea class="form-control" name="body" rows="10" cols="10"><?php echo $item->body; ?></textarea>
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
    CKEDITOR.replace('body', {
        filebrowserUploadUrl: "<?php echo e(route('admin.ckeditor.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form'
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\pages\edit.blade.php ENDPATH**/ ?>