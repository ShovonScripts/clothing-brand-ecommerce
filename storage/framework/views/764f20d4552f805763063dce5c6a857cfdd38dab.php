<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Courier Update</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="<?php echo e(route('admin.couriers.update',[$item->id])); ?>" method="POST" id="ajax_form">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PATCH'); ?>
      <div class="modal-body">
          <div class="col-12">
              <div class="form-group">
                  <label>Courier Name</label>
                  <input type="text" name="name" value="<?php echo e($item->name); ?>" class="form-control">
              </div>
          </div>
          <div class="col-12">
              <div class="form-group">
                  <label>Courier Email</label>
                  <input type="email" name="email" value="<?php echo e($item->email); ?>" class="form-control">
              </div>
          </div>
          <div class="col-12">
              <div class="form-group">
                  <label>Courier Phone</label>
                  <input type="text" name="phone" value="<?php echo e($item->phone); ?>" class="form-control">
              </div>
          </div>
          <div class="col-12">
              <div class="form-group">
                  <label>Courier Address</label>
                  <input type="text" name="address" value="<?php echo e($item->address); ?>" class="form-control">
              </div>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Update</button>
      </div>
    </form>
  </div>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\couriers\edit.blade.php ENDPATH**/ ?>