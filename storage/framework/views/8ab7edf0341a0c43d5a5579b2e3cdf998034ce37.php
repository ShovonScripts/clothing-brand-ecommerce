<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Catgeory Update</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="<?php echo e(route('admin.sizes.update',[$item->id])); ?>" method="POST" id="ajax_form">
      <?php echo csrf_field(); ?>
      <?php echo e(method_field('PATCH')); ?>

      <div class="modal-body">
          <div class="form-group mb-3">
              <input type="text" class="form-control" name="title" value="<?php echo e($item->title); ?>">
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Update</button>
      </div>
    </form>
  </div>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\sizes\edit.blade.php ENDPATH**/ ?>