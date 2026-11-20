
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
            <h4 class="page-title">Product Discount Update</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('admin.product_discounts.update',[$item->id])); ?>" id="ajax_form">
                    <?php echo csrf_field(); ?>
                     <?php echo e(method_field('PATCH')); ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label  class="form-label">Product Name</label>
                                <input type="text" name="name" value="<?php echo e($item->name); ?>" class="form-control" placeholder="Product Name">
                            </div>
                            
                            <div class="mb-3">
                                <label  class="form-label">Discount Type</label>
                                <select class="form-control dicount_type" name="dicount_type">
                                    <option value="fixed" <?php echo e($item->dicount_type=='fixed' ?'selected':''); ?>>Fixed</option>
                                    <option value="percentage" <?php echo e($item->dicount_type=='fixed' ?'selected':''); ?>>Percentage</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label  class="form-label">Discount Amount</label>
                                <input type="number" step="any" name="dicount_amount" class="form-control dicount_amount" value="<?php echo e($item->dicount_amount); ?>">
                            
                            </div>

                        </div>


                        <div class="col-lg-6">

                            <div class="mb-3">
                                <label  class="form-label"> Price</label>
                                <input type="text" id="sell_price" name="sell_price" value="<?php echo e($item->sell_price); ?>" class="form-control" placeholder="Productn sell Price">
                            </div>
                            
                            <div class="mb-3">
                                <label  class="form-label">After Discount Price</label>
                                <input type="number" step="any" name="after_discount" class="form-control after_discount" value="<?php echo e($item->after_discount); ?>">
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
    </div> <!-- end col -->
</div> <!-- end row -->
<?php $__env->stopSection(); ?> 


<?php $__env->startPush('js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
    
    $(document).on('change', '.dicount_type', function(){
        let discount_amount=$('.dicount_amount').val();
        let new_price=0;
        var price=$('#sell_price').val();
        var discount_type=$('select.dicount_type').val();

        if (discount_type=='percentage') {
            new_price= (price / 100) * discount_amount;
            new_price=price - new_price;
        }else{
            new_price= price - discount_amount;
        }
        $('input.after_discount').val(new_price.toFixed(2));
    });
    
    
    $(document).on('blur', '.dicount_amount', function(){
        let discount_amount=$(this).val();
        let new_price=0;
        var price=$('#sell_price').val();
        var discount_type=$('select.dicount_type').val();

        if (discount_type=='percentage') {
            new_price= (price / 100) * discount_amount;
            new_price=price - new_price;
        }else{
            new_price= price - discount_amount;
        }
        $('input.after_discount').val(new_price.toFixed(2));
    });
  
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\product_discounts\edit.blade.php ENDPATH**/ ?>