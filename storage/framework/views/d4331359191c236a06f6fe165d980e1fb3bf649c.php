

<?php $__env->startSection('title', 'FAQ — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-wrapper">
    <div class="axil-breadcrumb-area">
        <div class="container-fluid">
            <ul class="axil-breadcrumb">
                <li class="axil-breadcrumb-item"><a href="<?php echo e(route('front.home')); ?>">Home</a></li>
                <li class="separator"></li>
                <li class="axil-breadcrumb-item active" aria-current="page">FAQ</li>
            </ul>
        </div>
    </div>

    <section class="gm-page">
        <div class="container-fluid">
            <div class="gm-section-head gm-section-head--center" style="margin-bottom:40px">
                <span class="gm-eyebrow">Good to know</span>
                <h1 class="gm-title">Frequently asked questions</h1>
                <p class="gm-subtitle">Everything you need to know about ordering, fit, delivery and returns.</p>
            </div>

            <div class="gm-faq">
                <div class="accordion" id="gmFaq">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                How do I choose the right size?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="faqOne" data-bs-parent="#gmFaq">
                            <div class="accordion-body">
                                Each product page includes a size guide with chest, waist and length measurements. If you are between sizes, we recommend sizing up for a relaxed fit or staying true to size for a tailored fit. Our client services team is happy to advise — just send us your usual size and the piece you're considering.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                When will my order arrive?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faqTwo" data-bs-parent="#gmFaq">
                            <div class="accordion-body">
                                Orders placed before 3pm are dispatched the same business day. Delivery within the city typically takes 1–2 business days, and 2–4 business days elsewhere. You will receive a tracking link by SMS as soon as your order leaves our studio.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                What is your returns policy?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faqThree" data-bs-parent="#gmFaq">
                            <div class="accordion-body">
                                You may return unworn, unwashed items with original tags within 14 days of delivery for an exchange or refund. Sale items are eligible for exchange or store credit. To start a return, contact client services with your order number and we will arrange a pickup.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                                Do you offer free delivery?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" aria-labelledby="faqFour" data-bs-parent="#gmFaq">
                            <div class="accordion-body">
                                Yes. Delivery is complimentary on orders over ৳5,000. Below that, a flat delivery fee applies and is shown at checkout before you confirm your order.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" aria-controls="faq5">
                                Which payment methods do you accept?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" aria-labelledby="faqFive" data-bs-parent="#gmFaq">
                            <div class="accordion-body">
                                We accept cash on delivery, bKash and major cards. All online payments are processed over an encrypted connection. You can choose your preferred method at checkout.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false" aria-controls="faq6">
                                How should I care for my garments?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" aria-labelledby="faqSix" data-bs-parent="#gmFaq">
                            <div class="accordion-body">
                                Wash at a low temperature, inside out, and line dry where possible. Tailoring should be dry cleaned sparingly. Knitwear should be folded rather than hung. Care instructions are printed on the inside label of every piece.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/faq.blade.php ENDPATH**/ ?>