<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Multi Status Update </h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="<?php echo e(route('admin.multuOrderStatusUpdate')); ?>" method="POST" id="order_status_update_form">
      <?php echo csrf_field(); ?>
      <div class="modal-body">
          
          <div class="div-group">
              <label>Status</label>
              <select class="form-control" name="status" id="multi_status" required>
                   <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <option value="<?php echo e($key); ?>"> <?php echo e($s); ?> </option>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Submit</button>
      </div>
    </form>
  </div>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/orders/all_status_update.blade.php ENDPATH**/ ?>