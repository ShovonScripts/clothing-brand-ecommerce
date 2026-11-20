

<?php $__env->startSection('title', 'Checkout — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<?php
    // Frontend\CheckoutController@index passes $cart (session cart, keyed by variation id)
    // and $charges (delivery areas). The form posts to CheckoutController@store, which
    // charges:  Σ(price × qty) + delivery charge − coupon.  Line "price" is already the
    // reduced price, so product discounts must NOT be subtracted again here.
    // Field names below are the ones that controller validates — do not rename them.
    $info = \App\Models\Information::first();
    $bangla_text = \App\Models\BanglaText::first();

    $cart = $cart ?? session('cart', []);
    $charges = $charges ?? collect();

    $subtotal = 0;
    $savings = 0;
    $needsDelivery = false;
    foreach ($cart as $line) {
        $subtotal += $line['price'] * $line['quantity'];
        $savings += ($line['discount'] ?? 0) * $line['quantity'];
        if (empty($line['is_free_shipping'])) $needsDelivery = true;
    }

    $selectedChargeId = old('delivery_charge_id', $needsDelivery ? optional($charges->first())->id : 0);
    $chargeAmount = $needsDelivery ? (float) optional($charges->firstWhere('id', $selectedChargeId))->amount : 0;
    $couponDiscount = (float) (getCouponDiscount() ?? 0);
    $total = $subtotal + $chargeAmount - $couponDiscount;

    $mobileMethods = [
        'bkash' => ['Bkash', $info->bkash_number ?? null],
        'rocket' => ['Rocket', $info->rocket_number ?? null],
        'nogod' => ['Nogod', $info->nogod_number ?? null],
    ];
    $oldMethod = old('payment_method', 'cash');
?>

<main class="main-wrapper">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.breadcrumb','data' => ['items' => [
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Shopping Bag', 'url' => route('front.carts.index')],
        ['label' => 'Checkout'],
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Shopping Bag', 'url' => route('front.carts.index')],
        ['label' => 'Checkout'],
    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.section','data' => ['size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'md']); ?>
        <div class="gm-checkout-layout">
            <form method="POST" action="<?php echo e(route('front.checkouts.store')); ?>" id="checkout_form" class="gm-checkout-form" novalidate
                  data-subtotal="<?php echo e($subtotal); ?>" data-coupon="<?php echo e($couponDiscount); ?>"
                  data-currency="<?php echo e(trim(str_replace('0', '', priceFormate(0)))); ?>">
                <?php echo csrf_field(); ?>
                
                <input type="hidden" name="ip_address" id="ip_address" value="<?php echo e(request()->ip()); ?>">

                <section class="gm-checkout-section">
                    <h2 class="gm-checkout-section__title"><?php echo e($bangla_text->checkout_form_top_text ?? 'Contact information'); ?></h2>

                    <div class="gm-checkout-fields gm-checkout-fields--2">
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.input','data' => ['name' => 'first_name','label' => $bangla_text->name_text ?? 'Full name','placeholder' => 'Your full name','required' => true,'autocomplete' => 'name','error' => $errors->first('first_name')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'first_name','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bangla_text->name_text ?? 'Full name'),'placeholder' => 'Your full name','required' => true,'autocomplete' => 'name','error' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->first('first_name'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.input','data' => ['name' => 'mobile','type' => 'tel','label' => $bangla_text->mobile_text ?? 'Mobile number','placeholder' => '01XXXXXXXXX','required' => true,'autocomplete' => 'tel','inputmode' => 'numeric','error' => $errors->first('mobile')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mobile','type' => 'tel','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bangla_text->mobile_text ?? 'Mobile number'),'placeholder' => '01XXXXXXXXX','required' => true,'autocomplete' => 'tel','inputmode' => 'numeric','error' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->first('mobile'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>

                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.input','data' => ['name' => 'shipping_address','label' => $bangla_text->address_text ?? 'Delivery address','placeholder' => 'House, road, area, city','required' => true,'autocomplete' => 'street-address','error' => $errors->first('shipping_address')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'shipping_address','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bangla_text->address_text ?? 'Delivery address'),'placeholder' => 'House, road, area, city','required' => true,'autocomplete' => 'street-address','error' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->first('shipping_address'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </section>

                <section class="gm-checkout-section">
                    <h2 class="gm-checkout-section__title">Delivery</h2>

                    <?php if($needsDelivery && $charges->isNotEmpty()): ?>
                        <div class="gm-checkout-options" role="radiogroup" aria-label="Delivery area">
                            <?php $__currentLoopData = $charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="gm-checkout-option">
                                    <input type="radio" name="delivery_charge_id" value="<?php echo e($charge->id); ?>" data-charge="<?php echo e($charge->amount); ?>"
                                           class="gm-checkout-option__input" <?php if($charge->id == $selectedChargeId): echo 'checked'; endif; ?>>
                                    <span class="gm-checkout-option__body">
                                        <span class="gm-checkout-option__title"><?php echo e($charge->title); ?></span>
                                    </span>
                                    <span class="gm-checkout-option__price"><?php echo e(priceFormate($charge->amount)); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="gm-checkout-note">
                            <?php echo e($needsDelivery ? 'Delivery charge will be confirmed by our team.' : 'Free delivery on this order.'); ?>

                        </p>
                        <input type="hidden" name="delivery_charge_id" value="0">
                    <?php endif; ?>
                </section>

                <?php if(($info->coupon_visibility ?? null) == '1'): ?>
                    <section class="gm-checkout-section">
                        <h2 class="gm-checkout-section__title">Have a coupon?</h2>
                        <?php if(auth()->guard()->check()): ?>
                            
                            <div class="gm-checkout-coupon">
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.input','data' => ['id' => 'coupon_code','name' => 'coupon_code','placeholder' => 'Enter coupon code']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'coupon_code','name' => 'coupon_code','placeholder' => 'Enter coupon code']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'secondary','id' => 'coupon_apply']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','id' => 'coupon_apply']); ?>Apply <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            </div>
                        <?php else: ?>
                            <p class="gm-checkout-note"><a href="<?php echo e(route('login')); ?>">Sign in</a> to use a coupon code.</p>
                        <?php endif; ?>
                    </section>
                <?php endif; ?>

                <section class="gm-checkout-section">
                    <h2 class="gm-checkout-section__title">Payment</h2>

                    <div class="gm-checkout-options" role="radiogroup" aria-label="Payment method">
                        <label class="gm-checkout-option">
                            <input type="radio" name="payment_method" value="cash" class="gm-checkout-option__input" <?php if($oldMethod === 'cash'): echo 'checked'; endif; ?>>
                            <span class="gm-checkout-option__body">
                                <span class="gm-checkout-option__title">Cash on delivery</span>
                                <span class="gm-checkout-option__meta">Pay when you receive your order</span>
                            </span>
                        </label>

                        <?php $__currentLoopData = $mobileMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => [$label, $number]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($info->{$value} ?? false): ?>
                                <label class="gm-checkout-option">
                                    <input type="radio" name="payment_method" value="<?php echo e($value); ?>" class="gm-checkout-option__input" <?php if($oldMethod === $value): echo 'checked'; endif; ?>>
                                    <span class="gm-checkout-option__body">
                                        <span class="gm-checkout-option__title"><?php echo e($label); ?></span>
                                        <?php if($number): ?><span class="gm-checkout-option__meta">Send money to <?php echo e($number); ?></span><?php endif; ?>
                                    </span>
                                </label>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </div>

                    <div class="gm-checkout-mobile-pay" id="payment_input" <?php if(!array_key_exists($oldMethod, $mobileMethods)): ?> hidden <?php endif; ?>>
                        <p class="gm-checkout-note">After sending the money, enter your account number and the transaction ID.</p>
                        <div class="gm-checkout-fields gm-checkout-fields--2">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.input','data' => ['name' => 'pay_num','label' => 'Your account number','placeholder' => '01XXXXXXXXX','inputmode' => 'numeric']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'pay_num','label' => 'Your account number','placeholder' => '01XXXXXXXXX','inputmode' => 'numeric']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.input','data' => ['name' => 'tnx_id','label' => 'Transaction ID','placeholder' => 'e.g. 8N7A6C5B4D']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'tnx_id','label' => 'Transaction ID','placeholder' => 'e.g. 8N7A6C5B4D']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                    </div>
                </section>

                <div class="gm-checkout-actions">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','size' => 'lg','full' => true,'type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','full' => true,'type' => 'submit']); ?>
                        <?php echo e($bangla_text->order_confirm_text ?? 'Place order'); ?> · <span data-gm-summary="total"><?php echo e(priceFormate($total)); ?></span>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>
            </form>

            <aside class="gm-checkout-summary" aria-label="Order summary">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.order-summary','data' => ['variant' => 'checkout','subtotal' => $subtotal,'shipping' => $chargeAmount,'discount' => $couponDiscount,'savings' => $savings,'total' => $total]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.order-summary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'checkout','subtotal' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subtotal),'shipping' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($chargeAmount),'discount' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($couponDiscount),'savings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($savings),'total' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($total)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                <div class="gm-checkout-items">
                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.cart-line','data' => ['id' => $key,'image' => getImage('products', $line['image']),'name' => $line['name'],'href' => route('front.products.show', [$line['product_id']]),'variant' => ['Size' => $line['size'] ?? null, 'Color' => $line['color'] ?? null],'price' => $line['price'],'originalPrice' => ($line['discount'] ?? 0) > 0 ? $line['price'] + $line['discount'] : null,'quantity' => $line['quantity'],'editable' => false,'drawer' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.cart-line'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($key),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(getImage('products', $line['image'])),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($line['name']),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('front.products.show', [$line['product_id']])),'variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Size' => $line['size'] ?? null, 'Color' => $line['color'] ?? null]),'price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($line['price']),'originalPrice' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($line['discount'] ?? 0) > 0 ? $line['price'] + $line['discount'] : null),'quantity' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($line['quantity']),'editable' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'drawer' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <a class="gm-checkout-edit" href="<?php echo e(route('front.carts.index')); ?>">Edit bag</a>
                </div>
            </aside>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<script src="<?php echo e(asset('frontend/js/checkout.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    const form = document.getElementById('checkout_form');
    if (!form) return;

    // Prefer the public IP when the lookup works; the server-side value stays otherwise.
    fetch('https://api.ipify.org?format=json')
        .then((r) => r.json())
        .then((d) => { if (d && d.ip) document.getElementById('ip_address').value = d.ip; })
        .catch(() => {});

    const subtotal = parseFloat(form.dataset.subtotal) || 0;
    const coupon = parseFloat(form.dataset.coupon) || 0;
    // Same output as the priceFormate() helper: store currency symbol, no decimals.
    const money = (v) => (form.dataset.currency || '') + Math.round(v).toLocaleString('en-US');

    // Keep the summary in step with the chosen delivery area (same formula as the server).
    form.addEventListener('change', (e) => {
        if (e.target.matches('input[name="delivery_charge_id"]')) {
            const charge = parseFloat(e.target.dataset.charge) || 0;
            document.querySelectorAll('[data-gm-summary="shipping"]').forEach((el) => { el.textContent = charge > 0 ? money(charge) : 'Free'; });
            document.querySelectorAll('[data-gm-summary="total"]').forEach((el) => { el.textContent = money(subtotal + charge - coupon); });
        }

        if (e.target.matches('input[name="payment_method"]')) {
            const mobile = ['bkash', 'rocket', 'nogod'].includes(e.target.value);
            document.getElementById('payment_input').hidden = !mobile;
        }
    });
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\frontend\cart\checkout.blade.php ENDPATH**/ ?>