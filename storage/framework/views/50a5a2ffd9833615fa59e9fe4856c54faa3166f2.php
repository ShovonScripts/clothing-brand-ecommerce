<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel"> Combo Offer Details</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

        <div class="modal-body">
            
            <div class="row">
                <div class="col-lg-12">
                    
                    <div class="col-6">
                        
                        <div class="well">
                            
                            <p>Product : <b><?php echo e($item->product->name); ?></b></p>
                            
                            <div>
                                <img src="<?php echo e(getImage('products',$item->product->image)); ?>" width="200">
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="col-lg-12">
                    
                    <table class="table table-centered table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>Produt</th>
                                <th>SIze</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        
                       <tbody>
                           
                           <?php $__empty_1 = true; $__currentLoopData = $item->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                           
                           <tr>
                                <td> <?php echo e($p->product->name); ?> </td>
                                
                                <td> <?php echo e($p->size->title); ?></td>
                                
                                <td> <?php echo e($p->quantity); ?> </td>
                            </tr>
                            
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                           
                
                            
                           <?php endif; ?>
                           
                            
                        
                       </tbody>
                    </table>
                </div>

                </div>
            </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"> Update</button>
      </div>
  </div>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\combos\show.blade.php ENDPATH**/ ?>