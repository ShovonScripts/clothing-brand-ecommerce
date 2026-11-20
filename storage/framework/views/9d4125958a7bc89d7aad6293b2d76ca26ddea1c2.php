
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                    <li class="breadcrumb-item active">Supplier Details</li>
                </ol>
            </div>
            <h4 class="page-title">Supplier Details</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">         
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Supplier Information</h4>
                                
                                <p class="mb-2"><span class="fw-bold me-2"> Name :</span> <?php echo e($item->name); ?></p>
                                <p class="mb-2"><span class="fw-bold me-2"> Mobile :</span> <?php echo e($item->mobile); ?></p>
                                <p class="mb-2"><span class="fw-bold me-2"> Address :</span> <?php echo e($item->address); ?></p>
                                <p class="mb-2"><span class="fw-bold me-2"> Id :</span> <?php echo e($item->contact_id); ?></p>
                                
                                
                                
                
                            </div>
                        </div>
                    </div> <!-- end col -->
                
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Supplier Transaction</h4>
                
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <p class="mb-2"><span class="fw-bold me-2">Total Purchase:</span> <?php echo e(priceFormate($purchase->sum('amount'),)); ?></p>
                                        <p class="mb-2"><span class="fw-bold me-2">Total Payment:</span> <?php echo e(priceFormate($purchase->sum('paid'),)); ?> </p>
                                        <p class="mb-2"><span class="fw-bold me-2">Total Due:</span> <?php echo e(priceFormate($purchase->sum('amount') - $purchase->sum('paid'),)); ?></p>
                                    </li>
                                </ul>
                
                            </div>
                        </div>
                    </div> <!-- end col -->
                
                    
                </div>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div> <!-- end row -->
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\suppliers\show.blade.php ENDPATH**/ ?>