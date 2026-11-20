<?php $cart = session()->get('cart', []); ?>
<style>
  .cart-body{
    flex: 1 1 auto;
    padding: 1rem 2rem;
  }
</style>
<aside class="card">
  <article class="cart-body">
    <header class="mb-4">
      <h4 class="card-title" style="font-size: 16px;"> Details </h4>
    </header>
    <div class="row">
      <div class="table-responsive bg-white">
        <table class="table border-bottom">
          <thead>
            <tr>
              <th class="product-image">Image</th>
              <th class="product-name">Product</th>
              <th class="product-price">Price</th>
              <th class="product-quanity">Quantity</th>
              <th class="product-total">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $total=0;
            $discount=0;
            ?>
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $price=$item['price']*$item['quantity'];
            $total +=$price;
            $discount +=$item['discount']*$item['quantity'];
            ?>
            <tr class="cart-item">
              <td class="product-image" style="display: flex; flex-direction: row-reverse;">
                <a href="<?php echo e(route('front.products.show', [$item['product_id'] ])); ?>" >
                  <img class="lazyload" src="<?php echo e(getImage('products', $item['image'])); ?>" style="max-width: 50px">
                </a>
                <a data-href="<?php echo e(route('front.carts.destroy',[$key])); ?>" class="btn btn-danger remove_item" type="button"><i class="fa fa-trash"></i></a> 
              </td>

              <td class="product-name">
                <span class="d-block"><?php echo e($item['name']); ?></span>
              </td>

              <td class="product-price">
                <span class="d-block"><?php echo e(priceFormate($item['price'])); ?></span>
              </td>

              <td class="product-quantity" data-title="Qty">
                <div class="pro-qty" data-segment="<?php echo e(request()->segment(1)); ?>" data-href="<?php echo e(route('front.carts.edit',[$key])); ?>">
                  <span class="dec qtybtn">-</span>
                  <input type="number" class="quantity-input" value="<?php echo e($item['quantity']); ?>">
                  <span class="inc qtybtn">+</span>
                </div>
              </td>
              <td class="product-total">
                <span><?php echo e(priceFormate($price)); ?></span>
              </td>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>
  </article>

  <article class="card-body border-top total_section">
    <div class="row">
      <div class="col-md-6 col-6 mb-3"><p class="h6 text-dark">Subtotal:</p></div>
      <div class="col-md-6 col-6 mb-3"><p class="h6 text-dark"><?php echo e(priceFormate($total)); ?></p></div>
      <div class="col-md-6 col-6 mb-3"><p class="h6 text-dark">Delivery charge: </p></div>
      <div class="col-md-6 col-6 mb-3"><p class="h6 text-danger delivery_charge">৳0</p></div>
      <div class="col-md-6 col-6 mb-3"><p class="h6 text-dark">Total:</p></div>
      <div class="col-md-6 col-6 mb-3"><p class="h6 text-dark total"><?php echo e(priceFormate($total)); ?></p></div>
      <input type="hidden" value="<?php echo e($total); ?>" id="subtotal">
      <input type="hidden" value="<?php echo e($total); ?>" name="amount" id="amount">

    </div>

  </article>

</aside><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/cart/details.blade.php ENDPATH**/ ?>