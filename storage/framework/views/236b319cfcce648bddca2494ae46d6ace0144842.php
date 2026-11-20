<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Student Data</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <tr>
                  <th>Invoice ID</th>
                  <th>Date Order</th>
                  <th>Customers</th>
                  <th>Address</th>
                  <th>Mobile</th>

                  <th>Status</th>
                  <th>Payment Status</th>
                  <th>Item</th>
                  <th>Amount</th>
                  <th>Discount</th>

                  <th>Paid</th>
                  <th>Due</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>#<?php echo e($item->invoice_no); ?> </td>
                <td><?php echo e(dateFormate($item->date)); ?></td>
                <td>
                  <?php echo e($item->first_name.' '.$item->last_name); ?>

                </td>
                <td><?php echo e($item->shipping_address); ?></td>
                <td><?php echo e($item->mobile); ?></td>
                <td><?php echo e($item->status); ?></td>
                <td><?php echo e($item->payment_status); ?></td>
                <td><?php echo e($item->details->count()); ?></td>
                <td><?php echo e($item->final_amount); ?></td>
                <td><?php echo e($item->discount); ?></td>
                <td><?php echo e($item->discount); ?></td>
                <td><?php echo e($item->discount); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\orders\order_export.blade.php ENDPATH**/ ?>