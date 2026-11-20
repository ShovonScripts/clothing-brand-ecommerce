
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                    <li class="breadcrumb-item active">Product Stock Report</li>
                </ol>
            </div>
            <h4 class="page-title">Product Stock Report</h4> 
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                 <div class="row mb-2">
                    <div class="col-md-12 no-print">
                        <form class="row gy-2 gx-2 align-items-center justify-content-xl-start justify-content-between" id="order_report_form" method="GET" action="<?php echo e(route('admin.report.product.search')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="col-md-4">
                                <label for="query" class="visually-hidden">Search</label>
                                <input type="search" class="form-control" id="query" placeholder="Search..." name="query" value="<?php echo e(old('query')); ?>">
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <label for="status-select" class="me-2">Status</label>
                                    <select class="form-select" id="status-select" name="status">
                                        <option selected value="">Choose...</option>
                                        <?php $__currentLoopData = getOrderStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>" ><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>                            
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <label for="status-select" class="me-2">Assign By</label>
                                    <select class="form-select" id="assign" name="assign">
                                        <option selected value="">Choose...</option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>" ><?php echo e(full_name($user)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>                                
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <label for="status-select" class="me-2">From:</label>
                                    <input type="date" name="from" id="from" class="form-control"/>
                                </div>
                            </div>                            
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <label for="status-select" class="me-2">To:</label>
                                    <input type="date" name="to" id="to" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <label for="status-select" class="me-2">Courier</label>
                                    <select class="form-select" id="courier" name="courier">
                                        <option selected value="">Choose...</option>
                                        <?php $__currentLoopData = $couriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $courier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($courier->id); ?>" ><?php echo e($courier->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>    
                            <div class="col-auto">
                                <label for="submit" class="visually-hidden">Submit</label>
                                <input type="submit" class="form-control btn btn-sm btn-primary" value="Submit">
                                
                            </div>
                        </form>                            
                    </div>
                    <div align="right" class="no-print">
                        <button class="btn btn-info print-btn">Print</button>
                    </div>
              <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-centered mb-0" id="order_report_table">
                        <thead class="table-light">
                            <tr>
                                <th width="12%">Product Name</th>
                                <th width="12%">Product Price</th>
                                <th width="15%">Product Quantity</th>                               
                                <th width="10%">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $totalPrice = 0;$totalQuantity = 0;  ?>
                          
                            <?php $__empty_1 = true; $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>                             
                              
                                <td><?php echo e($item->name); ?></td> 
                              <td><?php echo e($item->unit_price); ?></td>        
                                  
                               <td><?php echo e($item->total_qty); ?></td>        
                              <td><?php echo e($item->unit_price * $item->total_qty); ?></td>     
                                <?php 
                                $totalPrice += $item->unit_price * $item->total_qty;
                                $totalQuantity += $item->total_qty
                              ?>                              
                            </tr>                    
                          
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <center>
                                <h3 class='text-danger'>No data found</h3>
                            </center>
                            <?php endif; ?>
                          
                          <tr style="font-weight:bold">
                              <td class="text-center" colspan="2">Total</td>  
                               <td><?php echo e($totalQuantity); ?></td>  
                               <td><?php echo e($totalPrice); ?></td>  
                          </tr>  
                          
                        </tbody>
                        <br/>
                       <tfoot >
                           
                       </tfoot>
                    </table>
                  	 </div>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div> <!-- end row -->
<?php $__env->stopSection(); ?> 

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('backend/js/order.js')); ?>"></script>
<script>
$(document).ready(function(){
/*
   $("#order_report_form").submit(function(e){
       e.preventDefault();
       let method = $(this).attr('method');
       let url = $(this).attr('action');
       let data = $(this).serialize();
       
       $.ajax({
           url,
           method,
           data,
           beforeSend: function()
           {
               
           },
           success: function(res)
           {
               if(res.status === 'success')
               {
                console.log(res.details);
                    $("body").html(res.data);                
               }
               else{
                   
               }
           }
       });
   });
   
*/
    
    $(".print-btn").click(function(){
        print();
    })    

});
  
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\reports\product.blade.php ENDPATH**/ ?>