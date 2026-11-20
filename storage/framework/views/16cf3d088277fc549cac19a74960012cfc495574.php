
<?php $__env->startSection('content'); ?>


<form  id="order_report_form" method="POST" action="<?php echo e(route('admin.ipblock.submit')); ?>">
    <?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="IpAddress">IP Address</label>
    <input type="text" class="form-control" id="Ipaddress" name="ip_address" placeholder="Which ip you want to Block">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Reason </label>
    
    <textarea name="reason" id=""  class="form-control" cols="30" rows="10"></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

 <table class="table table-striped">
    <thead>
      <tr>
        <th>SL</th>
        <th>IP Address</th>
        <th>Reason </th>
        <th>Action </th>
      </tr>
    </thead>
 
   <tbody>
  <?php $serialNumber = 1; ?>   
 <?php $__currentLoopData = $AllIp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ips): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <tr>
        <td><?php echo e($serialNumber++); ?></td>
        <td><?php echo e($ips->ip_address); ?></td>
        <td><?php echo e($ips->reason); ?></td>
       <td> <a href="<?php echo e(route('admin.ipblock.delete', ['id' => $ips->id])); ?>" class="btn btn-danger">Delete </a>
       		<a href="<?php echo e(route('admin.ipblock.edit', ['id' => $ips->id])); ?>" > </a>
         <a href="#" data-toggle="modal" data-target="#editIpBlockModal<?php echo e($ips->id); ?>" class="btn btn-primary">Edit </a>
       </td>
      </tr>
     
     <div class="modal fade" id="editIpBlockModal<?php echo e($ips->id); ?>" tabindex="-1" role="dialog" aria-labelledby="editIpBlockModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editIpBlockModalLabel">Edit IP Block</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('admin.ipblock.update', ['id' => $ips->id])); ?>" method="POST" class="edit-form">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="form-group">
                            <label for="editIp">IP Address</label>
                            <input type="text" class="form-control" id="editIp" name="ip_address" value="<?php echo e($ips->ip_address); ?>">
                        </div>
                        <div class="form-group">
                            <label for="editReason">Reason</label>
                            <textarea class="form-control" id="editReason" name="reason"><?php echo e($ips->reason); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
     </tbody>
  </table>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.edit-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var data = form.serialize();
            
            $.ajax({
                type: 'PUT',
                url: url,
                data: data,
                success: function(response) {
                    if (response.success) {
                        // Update table row with new data
                        var row = form.closest('tr');
                        row.find('.ip-address').text(response.ip_address);
                        row.find('.reason').text(response.reason);
                        
                        // Close the modal
                        form.closest('.modal').modal('hide');
                    }
                },
                error: function() {
                    alert('Error updating IP block.');
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\reports\ipblock\ipblock.blade.php ENDPATH**/ ?>