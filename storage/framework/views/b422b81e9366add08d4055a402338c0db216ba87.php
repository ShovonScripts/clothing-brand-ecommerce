

<!-- Button to trigger modal -->
<a href="#" data-toggle="modal" data-target="#editIpBlockModal<?php echo e($ipBlock->id); ?>">Edit</a>

<!-- Modal -->
<div class="modal fade" id="editIpBlockModal<?php echo e($ipBlock->id); ?>" tabindex="-1" role="dialog" aria-labelledby="editIpBlockModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editIpBlockModalLabel">Edit IP Block</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('admin.ipblock.update', ['id' => $ipBlock->id])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    
                    <div class="form-group">
                        <label for="ip_address">IP Address</label>
                        <input type="text" class="form-control" id="ip_address" name="ip_address" value="<?php echo e($ipBlock->ip_address); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required><?php echo e($ipBlock->reason); ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\reports\ipblock\edit.blade.php ENDPATH**/ ?>