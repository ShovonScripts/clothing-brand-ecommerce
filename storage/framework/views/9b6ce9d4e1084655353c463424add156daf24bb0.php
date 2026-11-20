<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Report</title>
</head>
<body>
    <table>
      	<?php $total = 0; ?>
        <thead>
            <tr>
                <tr>
                    <th width="12%" style="font-size: 11px;">Invoice No</th>
                    <th width="12%" style="font-size: 11px;">Customer</th>
                    <th width="10%" style="font-size: 11px;">Phone</th>
                    <th width="25%" style="font-size: 11px;">Address</th>
                    <th width="15%" style="font-size: 11px;">Product</th>
                    <th width="15%" style="font-size: 11px;">Quantity</th>
                    <th width="6%" style="font-size: 11px;">Total</th>
            	</tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>                               
              <td style="font-size: 11px;color: #000;"><a href="<?php echo e(route('admin.orders.show',[$item->order->id])); ?>" target="_blank" class="fw-bold" style="color: #000;">#<?php echo e($item->order->invoice_no); ?></a> </td>
              <td style="font-size: 11px;color: #000;"><?php echo e($item->order->first_name); ?></td>
              <td style="font-size: 11px;color: #000;"><?php echo e($item->order->mobile); ?></td>
              <td style="font-size: 11px;color: #000;"><?php echo e($item->order->shipping_address); ?></td>
              <td style="font-size: 11px;color: #000;"><?php echo e($item->product->name); ?></td>
              <td style="font-size: 11px;color: #000;"><?php echo e($item->quantity); ?></td>

              <?php 
              $row_total = $item->unit_price * $item->quantity;
              $total += $row_total;
              ?>
              <td style="font-size: 11px;color: #000;"><?php echo e($row_total); ?></td>                             
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <center>
              <h3 class='text-danger'>No data found</h3>
            </center>
            <?php endif; ?>
            <tr>
              <td colspan="7" class="text-center"><h5>Total Amount : <span class="text-danger"><?php echo e($total); ?></span></h5></td>
            </tr>
        </tbody>
    </table>
</body>
</html><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\reports\order_report_export.blade.php ENDPATH**/ ?>