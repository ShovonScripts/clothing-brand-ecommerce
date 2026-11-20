
<?php $__env->startSection('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <h4 class="page-title mb-1">Hello, <?php echo e(auth()->user()->first_name.' '.auth()->user()->last_name); ?></h4>
                <p class="text-muted mb-0">Welcome back! Here's what's happening with your store today.</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.create')): ?>
                    <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary"><i class="mdi mdi-plus me-1"></i> Add Product</a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order.create')): ?>
                    <a href="<?php echo e(route('admin.orders.create')); ?>" class="btn btn-info"><i class="mdi mdi-plus me-1"></i> New Order</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row d-none" id="loader">
    <div class="col-12 text-center py-5">
        <div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
</div> 

<div id="dashboard_data"></div>

<!-- Orders Management Section -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Filter Toolbar -->
                <form class="filter-toolbar" id="filter_form" method="GET">
                    <div class="search-input">
                        <label for="search" class="visually-hidden">Search orders</label>
                        <input type="search" class="form-control" id="search" placeholder="Search orders..." name="q" value="<?php echo e(request('q', '')); ?>">
                    </div>
                    <div>
                        <label for="status-select" class="visually-hidden">Filter by status</label>
                        <select class="form-select select-sm" id="status-select" name="status">
                            <option value="">All Status</option>
                            <?php $__currentLoopData = getOrderStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php echo e(request('status') == $key ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="<?php echo e(url('admin/orders')); ?>" class="btn btn-light">Reset</a>
                </form>

                <!-- Actions -->
                <div class="page-actions mb-3">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orderStatusUPdate')): ?>
                    <a class="btn_modal btn btn-info" href="<?php echo e(route('admin.assignUser')); ?>"><i class="mdi mdi-account-multiple-plus me-1"></i> Assign User</a>
                    <?php endif; ?>
                    <a class="btn_modal btn btn-warning" href="<?php echo e(route('admin.orderStatusUpdateMulti')); ?>"><i class="mdi mdi-swap-horizontal me-1"></i> Bulk Status</a>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order.delete')): ?>
                    <a class="multi_order_delete btn btn-danger" href="<?php echo e(route('admin.deleteAllOrder')); ?>"><i class="mdi mdi-delete-empty me-1"></i> Delete Selected</a>
                    <?php endif; ?>
                    <?php $isPending = \App\Models\Order::where(['status' => 'pending'])->first(); ?>
                    <a class="multi_order_delete btn btn-success <?php echo e($isPending ? 'disabled' : ''); ?>" href="javascript: void(0);"><i class="mdi mdi-printer me-1"></i> Print</a>
                    <a type="button" href="<?php echo e(route('admin.orderExport')); ?>" class="btn btn-light"><i class="mdi mdi-file-export me-1"></i> Export</a>
                </div>

                <!-- Orders Table -->
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 40px;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input check_all" value="">
                                    </div>
                                </th>
                                <th style="width: 60px;">Action</th>
                                <th>Invoice ID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>SKU</th>
                                <th>Status</th>
                                <th>View</th>
                                <th>Assigned</th>
                                <th>Courier</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="order_checkbox form-check-input" value="<?php echo e($item->id); ?>">
                                </td>

                                <td>
                                    <a href="<?php echo e($item->status === 'pending' ? 'javascript:void(0)' : route('admin.orders.show', [$item->id])); ?>" target="<?php echo e($item->status === 'pending' ? '' : '_blank'); ?>" class="action-icon" title="<?php echo e($item->status === 'pending' ? 'Pending invoice cannot be printed' : 'Print Invoice'); ?>">
                                        <i class="mdi mdi-printer"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.orders.edit', [$item->id])); ?>" class="action-icon" title="Edit"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order.delete')): ?>
                                    <a href="<?php echo e(route('admin.orders.destroy', [$item->id])); ?>" class="action-icon delete" title="Delete"> <i class="mdi mdi-delete"></i></a>
                                    <?php endif; ?>
                                </td>
                                <td><strong>#<?php echo e($item->invoice_no); ?></strong></td>
                                <td><?php echo e(\Carbon\Carbon::parse($item->created_at)->diffForHumans()); ?></td>
                                <td>
                                    <?php echo e($item->first_name.' '.$item->last_name); ?><br>
                                    <small class="text-muted"><?php echo e($item->shipping_address); ?></small><br>
                                    <?php echo e($item->mobile); ?> <a class="btn btn-sm btn-primary ms-1" href="tel:<?php echo e($item->mobile); ?>"><span class="ms-1">Call</span></a>
                                </td>
                                <td>
                                    <?php
                                        $skus = [];
                                        foreach($item->details as $detail) {
                                            $sku = $detail->product['sku'] ?? '';
                                            if($sku) $skus[] = $sku;
                                        }
                                    ?>
                                    <?php if(empty($skus)): ?>
                                        <span class="text-danger">Unavailable</span>
                                    <?php else: ?>
                                        <?php echo e(implode(', ', $skus)); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a class="btn_modal" href="<?php echo e(route('admin.orderStatus', $item->id)); ?>">
                                        <span class="status-pill status-<?php echo e(strtolower(str_replace('_', '_', $item->status))); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $item->status))); ?></span>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('admin.orders.view', $item->id)); ?>" target="_blank">
                                        <span class="status-pill status-view">View Order</span>  
                                    </a>
                                </td>
                                <td><?php echo e($item->assign?$item->assign->username:'—'); ?></td>
                                <td><?php echo e($item->courier?$item->courier->name:'—'); ?></td>
                                <td style="color: var(--admin-text); font-weight: 600;">
                                    ৳ <?php echo e(number_format($item->final_amount ?? 0, 0)); ?>

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="12" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="mdi mdi-cart-outline"></i>
                                        <p>No orders found.</p>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div> <!-- end row -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('backend/js/order.js')); ?>"></script>
<script>
$(document).ready(function(){
    $(".check_all").on('change',function(){
        $(".order_checkbox").prop('checked', $(this).is(":checked"));
    });

    $(document).on('submit', 'form#order_status_update_form', function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        let status = $(document).find('select#multi_status').val();
        var order = $('input.order_checkbox:checked').map(function(){ return $(this).val(); });
        var order_ids = order.get();
        
        if(order_ids.length == 0){
            toastr.error('Please Select An Order First !');
            return;
        }
        
        $.ajax({
            type: 'GET',
            url: url,
            data: {status: status, order_ids: order_ids},
            success: function(res){
                if(res.status == true){
                    toastr.success(res.msg);
                    window.location.reload();
                } else if(res.status == false){
                    toastr.error(res.msg);
                }
            }
        });
    });

    $(document).on('submit', 'form#order_assign_form', function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        let assign_user_id = $(document).find('select#assign_user_id').val();
        var order = $('input.order_checkbox:checked').map(function(){ return $(this).val(); });
        var order_ids = order.get();
        
        if(order_ids.length == 0){
            toastr.error('Please Select An Order First !');
            return;
        }
        
        $.ajax({
            type: 'GET',
            url: url,
            data: {assign_user_id: assign_user_id, order_ids: order_ids},
            success: function(res){
                if(res.status == true){
                    toastr.success(res.msg);
                    window.location.reload();
                } else if(res.status == false){
                    toastr.error(res.msg);
                }
            }
        });
    });

    $(document).on('click', 'a.multi_order_delete', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        var order = $('input.order_checkbox:checked').map(function(){ return $(this).val(); });
        var order_ids = order.get();
        
        if(order_ids.length == 0){
            toastr.error('Please Select An Order First !');
            return;
        }
        
        $.ajax({
            type: 'GET',
            url: url,
            data: {order_ids: order_ids},
            success: function(res){
                if(res.status == true){
                    toastr.success(res.msg);
                    window.location.reload();
                } else if(res.status == false){
                    toastr.error(res.msg);
                }
            }
        });
    });

    // Dashboard AJAX load
    let url = "<?php echo e(route('admin.getDashboardData')); ?>";
    $.ajax({
        type: 'GET',
        url: url,
        data: {},
        beforeSend: function() { $('#loader').show(); },
        success: function(res) {
            $('#dashboard_data').html(res);
        },
        error: function(xhr) { },
        complete: function() { $('#loader').hide(); },
        dataType: 'html'
    });    
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\dashboard.blade.php ENDPATH**/ ?>