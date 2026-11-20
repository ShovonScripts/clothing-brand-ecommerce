

<?php $__env->startSection('title', 'Shopping Bag — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<?php
    // Frontend\CartController@index passes $cart: the session cart, an array keyed by
    // variation id. Each line's "price" is already the selling price after any product
    // discount; "discount" is how much was taken off per unit (informational only).
    $cart = $cart ?? session('cart', []);
    $itemCount = count($cart);
    $subtotal = 0;
    $savings = 0;
    foreach ($cart as $line) {
        $subtotal += $line['price'] * $line['quantity'];
        $savings += ($line['discount'] ?? 0) * $line['quantity'];
    }
?>

<main class="main-wrapper">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.breadcrumb','data' => ['items' => [
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Shopping Bag'],
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Shopping Bag'],
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
        <?php if($itemCount): ?>
            <div class="gm-cart-layout">
                <section class="gm-cart-items" aria-labelledby="gm-cart-title" data-gm-cart>
                    <header class="gm-cart-header">
                        <h1 id="gm-cart-title" class="gm-cart-title"><?php echo e($itemCount); ?> <?php echo e(\Illuminate\Support\Str::plural('item', $itemCount)); ?> in your bag</h1>
                        <a href="<?php echo e(route('front.carts.clearAll')); ?>" class="gm-cart-clear" data-gm-confirm="Remove every item from your bag?">Clear bag</a>
                    </header>

                    <div class="gm-cart-list">
                        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.cart-line','data' => ['id' => $key,'image' => getImage('products', $line['image']),'name' => $line['name'],'href' => route('front.products.show', [$line['product_id']]),'variant' => ['Size' => $line['size'] ?? null, 'Color' => $line['color'] ?? null],'price' => $line['price'],'originalPrice' => ($line['discount'] ?? 0) > 0 ? $line['price'] + $line['discount'] : null,'quantity' => $line['quantity']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.cart-line'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($key),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(getImage('products', $line['image'])),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($line['name']),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('front.products.show', [$line['product_id']])),'variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Size' => $line['size'] ?? null, 'Color' => $line['color'] ?? null]),'price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($line['price']),'originalPrice' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($line['discount'] ?? 0) > 0 ? $line['price'] + $line['discount'] : null),'quantity' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($line['quantity'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </section>

                <aside class="gm-cart-summary" aria-label="Order summary">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.order-summary','data' => ['variant' => 'cart','subtotal' => $subtotal,'savings' => $savings,'actionText' => 'Proceed to checkout','actionUrl' => route('front.checkouts.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.order-summary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'cart','subtotal' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subtotal),'savings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($savings),'actionText' => 'Proceed to checkout','actionUrl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('front.checkouts.index'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </aside>
            </div>
        <?php else: ?>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.empty-state','data' => ['type' => 'cart','title' => 'Your bag is empty','message' => 'Looks like you haven\'t added anything yet.','action' => 'Start shopping','actionUrl' => route('front.products.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'cart','title' => 'Your bag is empty','message' => 'Looks like you haven\'t added anything yet.','action' => 'Start shopping','actionUrl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('front.products.index'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        <?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    const cart = document.querySelector('[data-gm-cart]');
    if (!cart) return;

    // Frontend\CartController: edit = GET /carts/{variation}/edit?quantity=N (0 removes),
    // destroy = DELETE /carts/{variation}. Both answer JSON {success, msg, item}.
    const editUrl = <?php echo json_encode(route('front.carts.edit', ['cart' => '__ID__']), 512) ?>;
    const destroyUrl = <?php echo json_encode(route('front.carts.destroy', ['cart' => '__ID__']), 512) ?>;
    const token = document.querySelector('meta[name="csrf-token"]')?.content;

    function notify(ok, msg) {
        if (window.toastr) toastr[ok ? 'success' : 'error'](msg);
    }

    function busy(line, on) {
        line?.classList.toggle('is-busy', on);
        line?.querySelectorAll('button, input').forEach((el) => { el.disabled = on; });
    }

    function handle(res, line) {
        if (res && res.success) {
            // Totals, line counts and the header badge all come from the server.
            window.location.reload();
        } else {
            busy(line, false);
            notify(false, (res && res.msg) || 'Could not update your bag.');
        }
    }

    cart.addEventListener('change', (e) => {
        const input = e.target.closest('[data-gm-cart-qty]');
        if (!input) return;
        const line = input.closest('.gm-cart-line');
        busy(line, true);
        fetch(editUrl.replace('__ID__', input.dataset.gmCartQty) + '?quantity=' + encodeURIComponent(input.value), {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
        })
            .then((r) => r.json())
            .then((res) => handle(res, line))
            .catch(() => handle(null, line));
    });

    cart.addEventListener('click', (e) => {
        const remove = e.target.closest('[data-gm-cart-remove]');
        if (remove) {
            const line = remove.closest('.gm-cart-line');
            busy(line, true);
            const body = new FormData();
            body.append('_method', 'DELETE');
            body.append('_token', token);
            fetch(destroyUrl.replace('__ID__', remove.dataset.gmCartRemove), {
                method: 'POST',
                body,
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': token },
            })
                .then((r) => r.json())
                .then((res) => handle(res, line))
                .catch(() => handle(null, line));
            return;
        }

        const confirmLink = e.target.closest('[data-gm-confirm]');
        if (confirmLink && !window.confirm(confirmLink.dataset.gmConfirm)) e.preventDefault();
    });
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\frontend\cart\index.blade.php ENDPATH**/ ?>