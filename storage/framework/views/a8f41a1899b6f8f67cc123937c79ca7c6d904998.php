<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Home Image Update</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="<?php echo e(route('admin.home_section_images.update',[$item->id])); ?>" method="POST" id="ajax_form">
      <?php echo csrf_field(); ?>
      <?php echo e(method_field('PATCH')); ?>

      <div class="modal-body">

          <div class="mb-3">
              <label  class="form-label">Desktop Image</label>
              <input type="file" name="image" class="form-control">
          </div>
          
            <div class="mb-3">
                <label  class="form-label">Mobile Image</label>
                <input type="file" name="mobile_image" class="form-control">
            </div>

          <div class="mb-3">
              <label  class="form-label">Sections</label>
              <select class="form-control" name="section">
                  <?php $__currentLoopData = getSectionLists(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($key); ?>" <?php echo e($item->section==$key ?'selected':''); ?>><?php echo e($i); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
          </div>

          
          
            <div class="mb-3">
                <label  class="form-label">Link</label>
                <input type="text" name="link" class="form-control" value="<?php echo e($item->link); ?>">
            </div>
            
            <div class="mb-3">

                  <input type="checkbox" class="form-check-input" id="exampleCheck1" name="is_for_small" value="1" <?php echo e($item->section=='1' ?'checked':''); ?>>
                  <label class="form-check-label" for="exampleCheck1"> Is For Small </label>
    
              </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Update</button>
      </div>
    </form>
  </div>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\home_section_images\edit.blade.php ENDPATH**/ ?>