<?php
use App\Models\Information;
$info = Information::first();
$footerCategories = \App\Models\Category::whereNull('parent_id')->orderBy('id')->take(6)->get();
?>

<section class="gm-newsletter" id="newsletter">
    <div class="container-fluid">
        <div class="gm-newsletter-inner">
            <div>
                <span class="gm-eyebrow">The Gentry Letter</span>
                <h2>Considered style, delivered.</h2>
                <p>New arrivals, private offers and stories from the atelier — once a week, never more.</p>
            </div>
            <form class="gm-newsletter-form" action="<?php echo e(route('front.newsletter')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="gm-newsletter-fields">
                    <input type="email" name="email" placeholder="Your email address" aria-label="Email address" required>
                    <button type="submit" class="gm-btn">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
</section>

<footer class="gm-footer">
    <div class="container-fluid">
        <div class="gm-footer-grid">
            <div>
                <a href="<?php echo e(route('front.home')); ?>" class="gm-footer-logo">
                    <img src="<?php echo e(asset('uploads/img/'.$info->site_logo)); ?>" alt="<?php echo e($info->site_name); ?>">
                </a>
                <p class="gm-footer-about">Modern menswear built on considered design, honest materials and a fit that feels like it was made for you. Designed for the everyday, made to last.</p>
                <div class="gm-footer-social">
                    <?php if($info->facebook): ?><a href="<?php echo e($info->facebook); ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
                    <?php if($info->instagram): ?><a href="<?php echo e($info->instagram); ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a><?php endif; ?>
                    <?php if($info->youtube): ?><a href="<?php echo e($info->youtube); ?>" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a><?php endif; ?>
                </div>
            </div>

            <div>
                <h4 class="gm-footer-title">Shop</h4>
                <ul class="gm-footer-list">
                    <?php $__currentLoopData = $footerCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(route('front.products.index')); ?>?category_id=<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(route('front.products.index')); ?>">All products</a></li>
                    <li><a href="<?php echo e(route('front.discountProduct')); ?>">Sale</a></li>
                </ul>
            </div>

            <div>
                <h4 class="gm-footer-title">Help</h4>
                <ul class="gm-footer-list">
                    <li><a href="<?php echo e(route('front.faq')); ?>">FAQ</a></li>
                    <li><a href="<?php echo e(route('front.returnPolicy')); ?>">Returns & exchanges</a></li>
                    <li><a href="<?php echo e(route('front.products.index')); ?>">Size guide</a></li>
                    <li><a href="<?php echo e(route('front.termCondition')); ?>">Terms & conditions</a></li>
                    <li><a href="<?php echo e(route('front.privacyPolicy')); ?>">Privacy policy</a></li>
                </ul>
            </div>

            <div>
                <h4 class="gm-footer-title">Visit / Contact</h4>
                <ul class="gm-footer-list">
                    <li><span><?php echo e($info->address); ?></span></li>
                    <li><a href="tel:<?php echo e($info->owner_phone); ?>"><?php echo e($info->owner_phone); ?></a></li>
                    <li><a href="mailto:<?php echo e($info->owner_email); ?>"><?php echo e($info->owner_email); ?></a></li>
                    <li><a href="<?php echo e(route('front.contactUs')); ?>">Contact client services</a></li>
                    <li><a href="<?php echo e(route('front.aboutUs')); ?>">Our story</a></li>
                </ul>
            </div>
        </div>

        <div class="gm-footer-bottom">
            <div class="gm-footer-meta">
                <span><?php echo $info->copyright; ?></span>
                <a class="gm-footer-credit" href="https://wa.me/8801841104424" target="_blank" rel="noopener" title="WhatsApp +880 1841 104424" aria-label="Website credit: Shovon on WhatsApp">
                    Website by Shovon <i class="fab fa-whatsapp" aria-hidden="true"></i>
                </a>
            </div>
            <div class="gm-footer-pay">
                <span><i class="fab fa-cc-visa" aria-hidden="true"></i> Visa</span>
                <span><i class="fab fa-cc-mastercard" aria-hidden="true"></i> Mastercard</span>
                <span><i class="fab fa-cc-amex" aria-hidden="true"></i> Amex</span>
                <span>bKash</span>
                <span>COD</span>
            </div>
        </div>
    </div>
</footer>

<div class="cart-dropdown" id="cart-dropdown"></div>

<?php echo $__env->make('frontend.partials.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
(function() {
    'use strict';
    const $ = window.jQuery;
    if (!$) return;

    const $form = $('.gm-newsletter-form');
    if (!$form.length) return;

    $form.on('submit', function(e) {
        e.preventDefault();
        const $btn = $form.find('button[type="submit"]');
        const originalText = $btn.text();

        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            beforeSend: () => {
                $btn.prop('disabled', true).text('Subscribing...');
            },
            success: function(res) {
                if (window.toastr) {
                    if (res.success) {
                        toastr.success(res.msg);
                        $form[0].reset();
                    } else {
                        toastr.error(res.msg || 'Subscription failed');
                    }
                }
            },
            error: function() {
                if (window.toastr) toastr.error('Something went wrong');
            },
            complete: () => {
                $btn.prop('disabled', false).text(originalText);
            }
        });
    });
})();
</script>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\frontend\partials\footer.blade.php ENDPATH**/ ?>