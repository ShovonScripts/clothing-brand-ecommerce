<?php $cart = session()->get('cart', []); ?>       
<!-- Start Cart Area  -->
        <div class="axil-product-cart-area axil-section-gap">
            <div class="container">
                <div class="axil-product-cart-wrap">
                    <div class="product-table-heading">
                        <h4 class="title">Your Cart</h4>
                        <a href="<?php echo e(route('front.carts.clearAll')); ?>" class="cart-clear" style="color: #111111 !important;" onclick="return confirm('Are you sure?')">Clear Shoping Cart</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table axil-product-table axil-cart-table mb--40">
                            <thead>
                                <tr>
                                    <th scope="col" class="product-remove"></th>
                                    <th scope="col" class="product-thumbnail">Product</th>
                                    <th scope="col" class="product-title"></th>
                                    <th scope="col" class="product-price">Price</th>
                                    <th scope="col" class="product-quantity">Quantity</th>
                                    <th scope="col" class="product-subtotal">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $total=0;
                                ?>
                                <?php if($cart): ?>
                                
                                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $price =$item['price']*$item['quantity'];
                                    $total +=$price;
                                    ?>
                                <tr>
                                    <td class="product-remove">
                                        <form method="POST" action="<?php echo e(route('front.carts.destroy',[$key])); ?>" id="cart_remove_form">
                                            <input type="hidden" name="segment" value="<?php echo e(request()->segment(1)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="remove-wishlist" type="submit"><i class="fas fa-times"></i></button> 
                                        </form>
                                    </td>
                                    <td class="product-thumbnail"><a href="single-product.php">
                                        <img src=" <?php echo e(getImage('products', $item['image'])); ?> " alt="Digital Product"></a>
                                    </td>
                                    <td class="product-title"><a href="single-product.php"> <?php echo e($item['name']); ?> <?php echo e($item['size'] ??''); ?> <?php echo e($item['color']??''); ?> </a></td>
                                    <td class="product-price" data-title="Price"><?php echo e(priceFormate($item['price'])); ?></td>
                                    <td class="product-quantity" data-title="Qty">
                                        <div class="pro-qty" data-segment="<?php echo e(request()->segment(1)); ?>" data-href="<?php echo e(route('front.carts.edit',[$key])); ?>">
                                            <span class="dec qtybtn">-</span>
                                            <input type="number" class="quantity-input" value="<?php echo e($item['quantity']); ?>">
                                            <span class="inc qtybtn">+</span>
                                        </div>
                                    </td>
                                    <td class="product-subtotal" data-title="Subtotal"><?php echo e(priceFormate($price)); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                            <div class="axil-order-summery mt--80">
                                <h5 class="title mb--20">Order Summary</h5>
                                <div class="summery-table-wrap">
                                    <table class="table summery-table mb--30">
                                        <tbody>
                                            <tr class="order-subtotal">
                                                <td>Subtotal</td>
                                                <td><?php echo e(priceFormate($total)); ?></td>
                                            </tr>
                                            <tr class="order-shipping">
                                                <td>Shipping</td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="radio" id="radio1" name="shipping" checked>
                                                        <label for="radio1">Free Shippping</label>
                                                    </div>                                                   
                                                    
                                                </td>
                                            </tr>
                                            <tr class="order-tax">
                                                <td>State Tax</td>
                                                <td>$0.00</td>
                                            </tr>
                                            <tr class="order-total">
                                                <td>Total</td>
                                                <td class="order-total-amount"><?php echo e(priceFormate($total)); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="<?php echo e(route('front.checkouts.index')); ?>" class="axil-btn btn-bg-primary checkout-btn">Process to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Cart Area  --><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/cart/other_details.blade.php ENDPATH**/ ?>