<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Order Payments </h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="<?php echo e(route('admin.order_payments.update',[$order->id])); ?>" method="POST" id="ajax_form">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PATCH'); ?>
      <div class="modal-body">
          
          <div class="row">
            <div class="col-md-4">
              <div class="well">
                <strong>Customer : </strong><?php echo e($order->first_name.' '.$order->last_name); ?><br>
                <strong>Mobile : </strong><?php echo e($order->mobile); ?> <br/>
                 <?php if(!empty($order->payments[0]->tnx_id)): ?>
                	<strong>Trx id : </strong><?php echo e($order->payments[0]->tnx_id ?? ''); ?>

                 <?php endif; ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="well">
                <strong> Invoice No : </strong><?php echo e($order->invoice_no); ?><br>
                <strong>Status: </strong><?php echo e($order->status); ?>

              </div>
            </div>
            <div class="col-md-4">
              <div class="well">
                <strong>Total Amount: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($order->final_amount); ?></span><br>
                <strong>Note : </strong> </strong><span><?php echo e($order->note); ?></span><br>
              </div>
            </div>
          </div>

          <hr>
          <div class="row payment_row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Amount :*</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </span>
                  <input type="number" name="amount" class="form-control" step="any" value="<?php echo e($due); ?>">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                
                <label>Paid on:*</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                  <input type="date" name="date" class="form-control" value="<?php echo e(date('Y-m-d')); ?>">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Pay Via:*</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </span>
                  <select class="form-control" name="method">
                    <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>"> <?php echo e($method); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="col-md-12">
              <div class="form-group">
                <label> Payment Note :</label>
                <textarea rows="3" name="note" class="form-control"></textarea>
              </div>
            </div>

          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Update</button>
      </div>
    </form>
  </div>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\orders\payment.blade.php ENDPATH**/ ?>