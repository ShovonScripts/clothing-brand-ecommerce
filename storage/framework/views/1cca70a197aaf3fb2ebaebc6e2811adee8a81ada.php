<?php $__env->startSection('title', 'Privacy Policy — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-wrapper">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.breadcrumb','data' => ['items' => [
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Privacy Policy'],
        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Privacy Policy'],
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
                <h1 class="gm-page__title">Privacy Policy</h1>
                <p class="gm-page__subtitle">Your privacy matters to us. This policy explains what information we collect, why we collect it, and how we keep it safe.</p>
            </div>

            <div class="gm-prose gm-prose--narrow">
                <h2>What we collect</h2>
                <p>When you place an order or create an account, we collect your name, phone number, email address and delivery address. We also collect basic technical information such as your browser type and the pages you visit, so we can improve the store.</p>

                <h2>How we use it</h2>
                <ul>
                    <li>To process and deliver your orders.</li>
                    <li>To send order updates and, if you opt in, occasional marketing emails.</li>
                    <li>To respond to your questions and support requests.</li>
                    <li>To detect and prevent fraud and abuse.</li>
                </ul>

                <h2>Sharing</h2>
                <p>We share information only with partners who help us run the store — payment processors, couriers and analytics providers. We never sell your personal information.</p>

                <h2>Your choices</h2>
                <p>You can unsubscribe from marketing at any time, request a copy of the information we hold about you, or ask us to delete it. Contact us at <a href="mailto:<?php echo e(optional(\App\Models\Information::first())->owner_email); ?>"><?php echo e(optional(\App\Models\Information::first())->owner_email); ?></a>.</p>

                <h2>Security</h2>
                <p>We use industry-standard safeguards to protect your information. No method of transmission over the internet is completely secure, but we work continuously to protect your data.</p>

                <p style="margin-top: 2.5em; color: var(--c-ink-500);"><em>Last updated: <?php echo e(now()->format('F Y')); ?></em></p>
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
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\frontend\privacy_policy.blade.php ENDPATH**/ ?>