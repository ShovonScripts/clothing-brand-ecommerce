
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
                    <li class="breadcrumb-item active">Product Update</li>
                </ol>
            </div>
            <h4 class="page-title">Product Update</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('admin.products.update',[$item->id])); ?>" id="ajax_form">
                    <?php echo csrf_field(); ?>
                     <?php echo e(method_field('PATCH')); ?>

                    <div class="row">
                        
                        <div class="col-lg-4 mb-3">
                            <label  class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Product Name" value="<?php echo e($item->name); ?>">
                        </div>
                      
                      	<div class="col-lg-4 mb-3">
                            <label  class="form-label">Product Sku</label>
                            <input type="text" name="sku" class="form-control" placeholder="Product Sku" value="<?php echo e($item->sku); ?>">
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label  class="form-label">Product Brand</label>
                            <select class="form-select" name="type_id">
                                <option value="">Select One</option>
                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($type->id); ?>" <?php echo e($type->id == $item->type_id ?'selected':''); ?>> <?php echo e($type->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div>
                                <img src="<?php echo e(getImage('products',$item->image)); ?>" width="50" class="mb-2">
                            </div>
                            <label for="example-email" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <style>
                            .img-box{
                                position: relative;
                                padding: 5px;
                            }
                            .img-box a{
                                    position: absolute;
                                    top: 2px;
                                    right: 12px;
                                    font-size: 22px;
                                    font-weight: bold;
                                    color: red;
                            }
                        </style>
                        <div class="col-lg-4 mb-3">
                            <div class="d-flex">
                                <?php $__currentLoopData = $item->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <div class="img-box">
                                    <a href="<?php echo e(route('admin.deleteImage',[$image->id])); ?>" class="" onclick="return confirm(' you want to delete?');">&times;</a> 
                                    <img src="<?php echo e(getImage('products',$image->image)); ?>" width="50">
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <label for="example-email" class="form-label">Multi Image</label>
                            <input type="file" name="images[]" class="form-control" multiple>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label for="example-email" class="form-label">Video Embedded Code</label>
                            <textarea name="video_link" class="form-control"><?php echo e($item->video_link); ?></textarea>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label  class="form-label">Product Category</label>
                            <select class="form-select" name="category_id">
                                <option value="">Select One</option>
                                <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>" <?php echo e($cat->id == $item->category_id ?'selected':''); ?>> <?php echo e($cat->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                            </select>
                        </div>


                        <div class="col-lg-4 mb-3">
                            <label  class="form-label">Sub Category</label>
                            <select class="form-select" name="sub_category_id">
                                <option value="">Select One</option>
                                <?php $__currentLoopData = $subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sub->id); ?>" <?php echo e($sub->id == $item->sub_category_id ?'selected':''); ?>> <?php echo e($sub->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </select>
                        </div>

                        <!--<div class="col-lg-4 mb-3">-->
                        <!--    <label  class="form-label">Purchase Price</label>-->
                        <!--    <input type="text" name="purchase_price" class="form-control" value="<?php echo e($item->purchase_price); ?>">-->
                        <!--</div>-->

                        <div class="col-lg-4 mb-3">
                            <label  class="form-label">Sell Price</label>
                            <input type="text" name="sell_price" class="form-control" value="<?php echo e($item->sell_price); ?>">
                        </div>
                        
                        <!--<div class="col-lg-4 mb-3 d-none">-->
                        <!--    <label  class="form-label">Regular Price</label>-->
                        <!--    <input type="text" name="regular_price" class="form-control" value="<?php echo e($item->regular_price); ?>">-->
                        <!--</div>-->

                        <div class="col-lg-3 mb-3">
                            <label  class="form-label">Manage Stock</label>
                            <select name="is_stock" class="form-control">
                                <option value="1" <?php echo e($item->is_stock == '1' ? 'selected' : ''); ?> >Yes</option>
                                <option value="0" <?php echo e($item->is_stock == '0' ? 'selected' : ''); ?>>No</option>
                            </select>
                        </div>
                            
                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-8 offset-md-2">
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Weight</th>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th style="width: 20%;">Price</th>
                                            <th width="5">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                        <?php $__currentLoopData = $item->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="variation_id[]" value="<?php echo e($v->id); ?>">
                                                <select name="weight_id[]" class="form-control">
                                                    <?php $__currentLoopData = $weights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e($weight->id==$v->weight_id ?'selected':''); ?> value="<?php echo e($weight->id); ?>"><?php echo e($weight->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="size_id[]" class="form-control">
                                                    <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e($size->id==$v->size_id ?'selected':''); ?> value="<?php echo e($size->id); ?>"><?php echo e($size->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="color_id[]" class="form-control">
                                                    <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e($color->id==$v->color_id ?'selected':''); ?> value="<?php echo e($color->id); ?>"><?php echo e($color->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td style="width: 16%;">
                                                <input class="form-control" type="number" value="<?php echo e($v->price); ?>" name="price[]" placeholder="Price">
                                            </td>
                                            <td>
                                                <a class="action-icon btn-primary add_moore"><i class="mdi mdi-plus"></i> </a>
                                                <a class="action-icon btn-danger remove"><i class="mdi mdi-delete"></i> </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>                                  
                                </table>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <label  class="form-label">Feature</label>
                            <textarea class="form-control" name="feature" rows="5"><?php echo $item->feature; ?></textarea>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label  class="form-label">Product Body</label>
                                <textarea class="form-control" name="body" rows="5"><?php echo $item->body; ?></textarea>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
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
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('body', {
        filebrowserUploadUrl: "<?php echo e(route('admin.ckeditor.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('feature');

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    $("document").ready(function () {
        $('select[name="category_id"]').on('change', function () {
            var cat_id = $(this).val();
            if (cat_id) {
                $.ajax({
                    url: '<?php echo e(route("admin.getSubcategory")); ?>',
                    type: "GET",
                    dataType: "json",
                    data:{cat_id},
                    success: function (data) {
                        $('select[name="sub_category_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="sub_category_id"]').append('<option value=" ' + key + '">' + value + '</option>');
                        })
                    }

                })
            } else {
                $('select[name="sub_category_id"]').empty();
            }
        });

        // add moore

        $(document).on('click','a.add_moore', function(){
            let type='<?php echo e($item->type); ?>';

            if (type=='single') {
                toastr.error('For Single Product You Can\'t Add Moore');
                return;
            }
            let row=`<tr>
                        <td>
                            <select name="weight_id[]" class="form-control">
                                <?php $__currentLoopData = $weights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php echo e($weight->id==$v->weight_id ?'selected':''); ?> value="<?php echo e($weight->id); ?>"><?php echo e($weight->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td>
                            <select name="size_id[]" class="form-control">
                                <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($size->id); ?>"><?php echo e($size->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>

                        <td>
                            <select name="color_id[]" class="form-control">
                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option  value="<?php echo e($color->id); ?>"><?php echo e($color->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td style="width: 16%;">
                            <input class="form-control" type="number" value="<?php echo e($v->price); ?>" name="price[]" placeholder="Price">
                        </td>
                        <td>
                            <a class="action-icon btn-primary add_moore"><i class="mdi mdi-plus"></i> </a>
                            <a class="action-icon btn-danger remove"><i class="mdi mdi-delete"></i> </a>
                        </td>
                    </tr>`;
            $(document).find('.table tbody').append(row);

        });

        $(document).on('click', "a.remove",function(e) {
            var whichtr = $(this).closest("tr");
            whichtr.remove();      
        });


    });

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/products/edit.blade.php ENDPATH**/ ?>