

<?php
    // Frontend\UserOrderController@show passes $item: one of this customer's orders.
    $order = $item;
    $placedAt = $order->created_at ?: ($order->date ? \Illuminate\Support\Carbon::parse($order->date) : null);
    $statusLabels = getOrderStatus();
    $status = (string) $order->status;
    // Real statuses (see getOrderStatus()): pending, processing, on_the_way, on_hold, complete, cancell
    $steps = [
        ['key' => 'placed', 'label' => 'Order placed', 'done' => true],
        ['key' => 'processing', 'label' => 'Processing', 'done' => in_array($status, ['processing', 'on_the_way', 'on_hold', 'complete'], true)],
        ['key' => 'on_the_way', 'label' => 'On the way', 'done' => in_array($status, ['on_the_way', 'complete'], true)],
        ['key' => 'complete', 'label' => 'Delivered', 'done' => $status === 'complete'],
    ];
    $payment = $order->payments->first();
    $details = $order->details()->with('product')->get();
?>

<?php $__env->startSection('title', 'Order #' . $order->invoice_no . ' — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-wrapper">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.breadcrumb','data' => ['items' => [
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Orders', 'url' => route('front.orders.index')],
        ['label' => '#' . $order->invoice_no],
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Orders', 'url' => route('front.orders.index')],
        ['label' => '#' . $order->invoice_no],
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
        <div class="gm-dashboard-layout">
            <?php echo $__env->make('frontend.dashboard.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="gm-dashboard-main">
                <header class="gm-order-head">
                    <div>
                        <h1 class="gm-order-head__title">Order #<?php echo e($order->invoice_no); ?></h1>
                        <?php if($placedAt): ?>
                            <p class="gm-order-head__meta">Placed on <?php echo e($placedAt->format('F j, Y')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="gm-order-head__actions">
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'neutral','size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'neutral','size' => 'lg']); ?><?php echo e($statusLabels[$status] ?? ucfirst(str_replace('_', ' ', $status))); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <a href="<?php echo e(route('front.orders.index')); ?>" class="gm-btn gm-btn--ghost gm-btn--sm">Back to orders</a>
                    </div>
                </header>

                <div class="gm-order-grid">
                    <section class="gm-order-card" aria-labelledby="gm-order-items">
                        <h2 id="gm-order-items" class="gm-order-card__title">Items (<?php echo e($details->count()); ?>)</h2>
                        <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $product = $line->product; ?>
                            <div class="gm-order-line">
                                <a href="<?php echo e($product ? route('front.products.show', [$product->id]) : '#'); ?>" class="gm-order-line__image">
                                    <?php if($product && $product->image): ?>
                                        <img src="<?php echo e(getImage('products', $product->image)); ?>" alt="" width="80" height="80" loading="lazy">
                                    <?php endif; ?>
                                </a>
                                <div class="gm-order-line__info">
                                    <p class="gm-order-line__name"><?php echo e($product->name ?? 'Product no longer available'); ?></p>
                                    <p class="gm-order-line__meta">Qty: <?php echo e($line->quantity); ?> · <?php echo e(priceFormate($line->unit_price)); ?> each</p>
                                </div>
                                <p class="gm-order-line__total"><?php echo e(priceFormate($line->unit_price * $line->quantity)); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </section>

                    <section class="gm-order-card" aria-labelledby="gm-order-summary">
                        <h2 id="gm-order-summary" class="gm-order-card__title">Summary</h2>
                        
                        <dl class="gm-order-totals">
                            <div><dt>Subtotal</dt><dd><?php echo e(priceFormate($order->amount)); ?></dd></div>
                            <?php if($order->discount > 0): ?>
                                <div><dt>Discount</dt><dd>−<?php echo e(priceFormate($order->discount)); ?></dd></div>
                            <?php endif; ?>
                            <div><dt>Delivery</dt><dd><?php echo e($order->shipping_charge > 0 ? priceFormate($order->shipping_charge) : 'Free'); ?></dd></div>
                            <div class="gm-order-totals__total"><dt>Total</dt><dd><?php echo e(priceFormate($order->final_amount)); ?></dd></div>
                        </dl>

                        <h3 class="gm-order-card__subtitle">Payment</h3>
                        <p class="gm-order-card__text">
                            <?php echo e($payment ? ucfirst($payment->method) : 'Cash on delivery'); ?>

                            <?php if($order->payment_status): ?>
                                · <?php echo e(ucfirst(str_replace('_', ' ', $order->payment_status))); ?>

                            <?php endif; ?>
                        </p>
                        <?php if($payment && $payment->tnx_id): ?>
                            <p class="gm-order-card__text gm-order-card__text--muted">Transaction: <?php echo e($payment->tnx_id); ?></p>
                        <?php endif; ?>
                    </section>
                </div>

                <div class="gm-order-grid gm-order-grid--even">
                    <section class="gm-order-card" aria-labelledby="gm-order-address">
                        <h2 id="gm-order-address" class="gm-order-card__title">Delivery address</h2>
                        <address class="gm-order-card__text" style="font-style: normal;">
                            <strong><?php echo e(trim($order->first_name . ' ' . $order->last_name)); ?></strong><br>
                            <?php echo e($order->shipping_address); ?><br>
                            <?php echo e($order->mobile); ?>

                            <?php if($order->email): ?><br><?php echo e($order->email); ?><?php endif; ?>
                        </address>
                    </section>

                    <section class="gm-order-card" aria-labelledby="gm-order-progress">
                        <h2 id="gm-order-progress" class="gm-order-card__title">Progress</h2>
                        <?php if($status === 'cancell'): ?>
                            <p class="gm-order-card__text">This order was cancelled.</p>
                        <?php else: ?>
                            <ol class="gm-order-steps">
                                <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="gm-order-steps__item <?php echo e($step['done'] ? 'is-done' : ''); ?>"><?php echo e($step['label']); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ol>
                            <?php if($status === 'on_hold'): ?>
                                <p class="gm-order-card__text gm-order-card__text--muted">This order is on hold. We'll be in touch.</p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </section>
                </div>
            </div>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/dashboard/show.blade.php ENDPATH**/ ?>