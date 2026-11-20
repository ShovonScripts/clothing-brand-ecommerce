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
                <th>Product</th>
                <th>Type</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Purchase Price</th>
                <th>Sell Price</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td> <?php echo e($item->name); ?></td>
                <td><?php echo e($item->type); ?></td>
                <td><?php echo e($item->category?$item->category->name:''); ?></td>
                <td><?php echo e($item->brand?$item->brand->name:''); ?></td>
                <td><?php echo e($item->purchase_price); ?></td>
                <td><?php echo e($item->sell_price); ?></td>
                <td><?php echo e($item->stocks->sum('quantity')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\products\product_export.blade.php ENDPATH**/ ?>