<?php $__env->startSection('title', 'Returns & Exchanges — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-wrapper">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.breadcrumb','data' => ['items' => [
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Returns & Exchanges'],
        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Returns & Exchanges'],
        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.section','data' => ['size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'lg']); ?>
        <div class="gm-container">
            <div class="gm-page__header">
                <span class="gm-eyebrow">Client services</span>
                <h1 class="gm-page__title">Returns & Exchanges</h1>
                <p class="gm-page__subtitle">We want you to love what you wear. If something isn't right, you have 14 days from delivery to return or exchange it.</p>
            </div>

            <div class="gm-prose gm-prose--narrow">
                <h2>Eligibility</h2>
                <ul>
                    <li>Items must be unworn, unwashed and in their original condition.</li>
                    <li>Original tags and packaging must be intact.</li>
                    <li>Proof of purchase or order number is required.</li>
                </ul>

                <h2>How to start a return</h2>
                <ol>
                    <li>Contact client services with your order number and the item you'd like to return.</li>
                    <li>We will confirm eligibility and arrange a pickup where available.</li>
                    <li>Once the item is received and inspected, we will process your exchange or refund within 3–5 business days.</li>
                </ol>

                <h2>Refunds</h2>
                <p>Refunds are issued to the original payment method. Cash-on-delivery orders are refunded by bank transfer or store credit. Delivery charges are non-refundable unless the item was faulty or incorrect.</p>

                <h2>Exchanges</h2>
                <p>Need a different size or colour? We offer one free exchange per order, subject to stock availability. If your size is unavailable, we will issue a refund or store credit.</p>

                <h2>Faulty items</h2>
                <p>If a garment arrives damaged or develops a fault, contact us within 7 days with photos. We will repair, replace or refund it at no cost to you.</p>

                <p style="margin-top: 2.5em; color: var(--c-ink-500);"><em>Need help? Email <a href="mailto:<?php echo e(optional(\App\Models\Information::first())->owner_email); ?>"><?php echo e(optional(\App\Models\Information::first())->owner_email); ?></a>.</em></p>
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
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\frontend\return_policy.blade.php ENDPATH**/ ?>