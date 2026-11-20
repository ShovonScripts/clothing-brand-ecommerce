<div class="cart-content-wrap">
    <div class="cart-header">
        <h2 class="header-title">Cart review</h2>
        <button class="cart-close sidebar-close"><i class="fas fa-times"></i></button>
    </div>
    <div class="cart-body">
        <ul class="cart-item-list">
            <?php
                $total=0;
            ?>
            <?php if($cart): ?>

            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $total +=$item['price']*$item['quantity'];
                ?>
            <li class="cart-item">
                <div class="item-img">
                    <a href="<?php echo e(route('front.products.show',[$item['product_id']])); ?>">
                      <img src="<?php echo e(getImage('products', $item['image'])); ?>" alt="Commodo Blown Lamp">
                    </a>
                    <form method="POST" action="<?php echo e(route('front.carts.destroy',[$key])); ?>" id="cart_remove_form">
                        <input type="hidden" name="segment" value="<?php echo e($segm); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="close-btn" type="submit"><i class="fas fa-times"></i></button>
                    </form>

                </div>
                <div class="item-content">
                    <h3 class="item-title"><a href="<?php echo e(route('front.products.show',[$item['product_id']])); ?>"><?php echo e($item['name']); ?> <?php echo e($item['size'] ??''); ?> <?php echo e($item['color']??''); ?></a></h3>
                    <div class="item-price"><span class="currency-symbol"></span> <?php echo e(priceFormate($item['price'])); ?></div>
                    <div class="pro-qty item-quantity" data-segment="<?php echo e($segm); ?>" data-href="<?php echo e(route('front.carts.edit',[$key])); ?>">
                        <span class="dec qtybtn">-</span>
                        <input type="number" class="quantity-input" value="<?php echo e($item['quantity']); ?>">
                        <span class="inc qtybtn">+</span>
                    </div>
                </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <li class="cart-item">
                <div class="alert alert-warning"> Your Cart Is Empty !!</div>
            </li>
            <?php endif; ?>


        </ul>
    </div>
    <div class="cart-footer">
        <h3 class="cart-subtotal">
            <span class="subtotal-title">Subtotal:</span>
            <span class="subtotal-amount"><?php echo e(priceFormate($total)); ?></span>
        </h3>
        <div class="group-btn">
            <a href=" <?php echo e(route('front.carts.index')); ?> " class="axil-btn viewcart-btn" style="background: #111111 !important;color: white;">View Cart</a>
            <a href=" <?php echo e(route('front.checkouts.index')); ?> " class="axil-btn btn-bg-secondary checkout-btn">Checkout</a>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\frontend\partials\cart_sidebar.blade.php ENDPATH**/ ?>