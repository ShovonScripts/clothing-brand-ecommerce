

<?php $__env->startSection('title', 'Privacy Policy — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-wrapper">
    <div class="axil-breadcrumb-area">
        <div class="container-fluid">
            <ul class="axil-breadcrumb">
                <li class="axil-breadcrumb-item"><a href="<?php echo e(route('front.home')); ?>">Home</a></li>
                <li class="separator"></li>
                <li class="axil-breadcrumb-item active" aria-current="page">Privacy policy</li>
            </ul>
        </div>
    </div>

    <section class="gm-page">
        <div class="container-fluid">
            <div class="gm-page-narrow gm-prose">
                <span class="gm-eyebrow">Legal</span>
                <h1>Privacy policy</h1>
                <p>Your privacy matters to us. This policy explains what information we collect, why we collect it, and how we keep it safe.</p>

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

                <p style="margin-top:2.5em;color:#6f6a63"><em>Last updated: <?php echo e(now()->format('F Y')); ?></em></p>
            </div>
        </div>
    </section>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/privacy_policy.blade.php ENDPATH**/ ?>