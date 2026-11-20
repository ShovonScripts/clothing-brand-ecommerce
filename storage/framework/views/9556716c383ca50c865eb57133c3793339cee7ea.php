<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Catgeory Update</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="<?php echo e(route('admin.sliders.update',[$item->id])); ?>" method="POST" id="ajax_form">
      <?php echo csrf_field(); ?>
      <?php echo e(method_field('PATCH')); ?>

      <div class="modal-body">
          <div class="form-group">
              <label  class="form-label">Title</label>
              <input type="text" class="form-control" name="title" value="<?php echo e($item->title); ?>">
          </div>

          <div class="form-group">
              <label  class="form-label">Description</label>
              <input type="text" name="description" class="form-control" value="<?php echo e($item->description); ?>">
          </div>

            <div class="form-group">
              <label  class="form-label">Image</label>
              <input type="file" name="image" class="form-control">
            </div>
            
            <div class="mb-3">
                <label  class="form-label">Mobile Image</label>
                <input type="file" name="mobile_image" class="form-control">
            </div>
          
            <div class="mb-3">
                <label  class="form-label">Link</label>
                <input type="text" name="link" class="form-control" value="<?php echo e($item->link); ?>">
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Update</button>
      </div>
    </form>
  </div>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\sliders\edit.blade.php ENDPATH**/ ?>