<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Assign User </h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="<?php echo e(route('admin.assignUserStore')); ?>" method="POST" id="order_assign_form">
      <?php echo csrf_field(); ?>
      <div class="modal-body">
          
          <div class="div-group">
              <label>Status</label>
                <select class="form-control" name="assign_user_id" id="assign_user_id">
                   <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <option value="<?php echo e($user->id); ?>"> <?php echo e($user->username); ?> </option>
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
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\orders\assign_user.blade.php ENDPATH**/ ?>