
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
	<div class="container card mt-3">
		<div class="row">
		    <div class="col-12">
		        <div class="page-title-box">
		            <div class="page-title-right">
		                <ol class="breadcrumb m-0">
		                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
		                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
		                    <li class="breadcrumb-item active">Purchase Details</li>
		                </ol>
		            </div>
		            <h4 class="page-title">Purchase Details</h4>
		        </div>
		    </div>
		</div>  
		<div class="row table-responsive">
			<table class="table table-bordered table-hover">
				<thead class="table-light">
					<tr>
						<th>Date</th>
						<th>Supplier</th>
						<th>User</th>
						<th>Note</th>
						<th>Reference No.</th>
						<th>Status</th>
						<th>Discount Type</th>
						<th>Discount Amount</th>
						<th>Shipping Cost</th>
						<th>Total Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($purchase->date); ?></td>
							<td><?php echo e($purchase->name); ?></td>
							<td><?php echo e($purchase->first_name); ?> <?php echo e($purchase->last_name); ?></td>
							<td><?php echo e($purchase->note); ?></td>
							<td><?php echo e($purchase->ref); ?></td>
							<td><?php echo e($purchase->status); ?></td>
							<td><?php echo e($purchase->discount_type); ?></td>
							<td><?php echo e($purchase->discount_amount); ?></td>
							<td><?php echo e($purchase->shipping_cost); ?></td>
							<td><?php echo e($purchase->amount); ?></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
		<hr>
		<h4>Purchase Product List</h4>
		<div class="row table-responsive">
			<table class="table table-bordered table-hover">
				<thead class="table-light">
					<tr>
						<th>Product</th>
						<!-- <th>Size</th> -->
						<th>Quantity</th>
						<th>Unit Pirce</th>
						<th>Total Price</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($item->products->name); ?></td>
						
							<td><?php echo e($item->quantity); ?></td>
							<td><?php echo e($item->unit_price); ?></td>
							<td><?php echo e($item->quantity * $item->unit_price); ?>.00</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
			<hr>
		</div>
	</div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\purchase\show.blade.php ENDPATH**/ ?>