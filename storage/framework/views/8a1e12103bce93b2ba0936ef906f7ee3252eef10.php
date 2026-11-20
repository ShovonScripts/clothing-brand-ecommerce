
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>                                    
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input check_all" value="">
                                      </label>
                                    </div>
                                </th>
                              	<th style="width:7%">Action</th>
                                <th>Invoice ID</th>
                                <th>Date Order</th>
                                <th>Customers</th>
                                <th>Product SKU</th>
                                <th>Status</th>
                                <th>Payment Status</th>
                                <th>Assign User</th>
                                <th style="width:15%">Courier</th>
                                <th>Amount</th>                                                          
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $received_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="order_checkbox" value="<?php echo e($item->id); ?>">                                    
                                </td>
                              	<td>
                                    <a href="<?php echo e($item->status === 'pending' ? 'javascript:void(0)' : route('admin.orders.show',[$item->id])); ?>" target="<?php echo e($item->status === 'pending' ? '' : '_blank'); ?>" class="action-icon " title="<?php echo e($item->status === 'pending' ? 'pending invoice will not be printed' : 'Print Invoice'); ?>"> <i class="fa fa-print" aria-hidden="true"></i></a>
                                    <a href="<?php echo e(route('admin.orders.edit',[$item->id])); ?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order.delete')): ?>
                                    <a href="<?php echo e(route('admin.orders.destroy',[$item->id])); ?>" class="delete action-icon"> <i class="mdi mdi-delete"></i></a>
                                    <?php endif; ?>
                                </td>
                                <td style="color: #000;">#<?php echo e($item->invoice_no); ?></td>
                              	<td style="color: #000;"><?php echo e(dateFormate($item->date)); ?></td>
                                <td style="color: #000;"><?php echo e($item->first_name.' '.$item->last_name); ?><br>
                                    <?php echo e($item->shipping_address); ?><br>
                                    <?php echo e($item->mobile); ?>

                                </td>
                              <td>
                                <?php $__currentLoopData = $item->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                             
                                   <?php if($detail->product['sku'] == ''): ?>
                                     Unavailable
                                   <?php else: ?>
                                    <?php echo e($detail->product['sku']); ?>, 
                                   <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                </td>
                                <td><a class="btn_modal" href="<?php echo e(route('admin.orderStatus', $item->id)); ?>">
                                        <h5 class="my-0"><span class="badge badge-info-lighten"><?php echo e($item->status); ?></span></h5>
                                    </a>
                                </td>
                                <td><a class="btn_modal" href="<?php echo e(route('admin.order_payments.edit', $item->id)); ?>">
                                        <h5 class="my-0"><span class="badge badge-danger-lighten"><?php echo e($item->payment_status); ?></span></h5>    
                                    </a>
                                </td>

                                <td style="color: #000;"><?php echo e($item->assign?$item->assign->username:''); ?></td>
                                <td style="color: #000;"><?php echo e($item->courier?$item->courier->name:''); ?> <br><?php echo e($item->courier_tracking_id ?? ''); ?>

                                  <br> <?php echo e($item->area_name ?? ''); ?>

                              	</td>
								<td style="color: #000;">
                                  <?php 
                                    $final_amount = $item->final_amount;                                    
                                    $fa = intval($final_amount);                                    
                                   echo $fa;                                    
                                  ?>                             
                              </td>  
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                  	 </div>
  <script>
    $(".check_all").on('change',function(){
      $(".order_checkbox").prop('checked',$(this).is(":checked"));
    });
    
</script>  
                <?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/orders/received_order.blade.php ENDPATH**/ ?>