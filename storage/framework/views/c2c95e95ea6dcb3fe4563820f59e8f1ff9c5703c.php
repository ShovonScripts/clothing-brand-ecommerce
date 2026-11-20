<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Coupon Code Update</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="<?php echo e(route('admin.coupon_codes.update',[$item->id])); ?>" method="POST" id="ajax_form">
      <?php echo csrf_field(); ?>
      <?php echo e(method_field('PATCH')); ?>

      <div class="modal-body">
            <div class="mb-3">
                <label  class="form-label">Coupon Code</label>
                <input type="text" name="code" value="<?php echo e($item->code); ?>" class="form-control" placeholder="Coupon Code">
            </div>
            
            <div class="mb-3">
                <label  class="form-label">Discount Type</label>
              <select class="form-control" name="discount_type">
                	<option value="fixed" <?php echo e($item->discount_type=='fixed'?'selected':''); ?>>Fixed</option>
                	<option value="percentage" <?php echo e($item->discount_type=='percentage'?'selected':''); ?>>Percentage</option>
              </select>
            </div>
            
            <div class="mb-3">
                <label  class="form-label">Discount Amount</label>
                <input type="number" step="any" name="amount" value="<?php echo e($item->amount); ?>" class="form-control">
            </div>
            
            
            <div class="mb-3">
                <label  class="form-label">Minimum Purchase</label>
                <input type="number" step="any" name="minimum_amount" class="form-control" value="<?php echo e($item->minimum_amount); ?>">
            </div>
            
            
            
            <div class="mb-3">
                <label  class="form-label">Date Start</label>
                <input type="date" step="any" name="start" value="<?php echo e($item->start); ?>" class="form-control">
            </div>
            
            <div class="mb-3">
                <label  class="form-label">Date End</label>
                <input type="date" step="any" name="end" value="<?php echo e($item->end); ?>" class="form-control">
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Update</button>
      </div>
    </form>
  </div>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\coupon_codes\edit.blade.php ENDPATH**/ ?>