<?php $__env->startSection('title', 'Terms & Conditions — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-wrapper">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.breadcrumb','data' => ['items' => [
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Terms & Conditions'],
        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Terms & Conditions'],
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
                <span class="gm-eyebrow">Legal</span>
                <h1 class="gm-page__title">Terms & Conditions</h1>
            </div>

            <div class="gm-prose gm-prose--narrow">
                <?php if($page && $page->body): ?>
                    <?php echo $page->body; ?>

                <?php else: ?>
                    <p>These terms govern your use of the GENTRY website and the purchase of products from it. By placing an order you agree to these terms.</p>

                    <h2>Orders</h2>
                    <p>All orders are subject to acceptance and stock availability. We reserve the right to decline or cancel an order where there is an error in pricing, availability or payment. If we cancel an order, we will refund any payment received.</p>

                    <h2>Pricing</h2>
                    <p>Prices are shown in the currency selected at checkout and include applicable taxes where required. Delivery charges are shown before you confirm your order.</p>

                    <h2>Delivery</h2>
                    <p>We aim to dispatch orders within one business day. Delivery estimates are indicative and not guaranteed. Risk passes to you on delivery.</p>

                    <h2>Returns</h2>
                    <p>Our returns policy forms part of these terms. Please review it before ordering.</p>

                    <h2>Intellectual property</h2>
                    <p>All content on this site — including text, images, logos and designs — is owned by or licensed to GENTRY and may not be reproduced without permission.</p>

                    <h2>Contact</h2>
                    <p>Questions about these terms? Email <a href="mailto:<?php echo e(optional(\App\Models\Information::first())->owner_email); ?>"><?php echo e(optional(\App\Models\Information::first())->owner_email); ?></a>.</p>
                <?php endif; ?>
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
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/term_and_condition.blade.php ENDPATH**/ ?>