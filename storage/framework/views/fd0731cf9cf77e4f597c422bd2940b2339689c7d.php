<?php $__env->startSection('title', 'Contact — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<?php $info = \App\Models\Information::first(); ?>
<main class="main-wrapper">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.breadcrumb','data' => ['items' => [
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Contact'],
        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Contact'],
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
                <h1 class="gm-page__title">We're here to help.</h1>
                <p class="gm-page__subtitle">Questions about fit, an order or a return? Send us a note and a real person will reply within one business day.</p>
            </div>

            <div class="gm-contact-grid">
                <div class="gm-contact-card">
                    <span class="gm-eyebrow">Client services</span>
                    <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4);">Visit or call</h3>
                    <div class="gm-contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <div>
                            <span>Studio</span>
                            <p><?php echo e($info->address); ?></p>
                        </div>
                    </div>
                    <div class="gm-contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <div>
                            <span>Phone</span>
                            <a href="tel:<?php echo e($info->owner_phone); ?>"><?php echo e($info->owner_phone); ?></a>
                        </div>
                    </div>
                    <div class="gm-contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <div>
                            <span>Email</span>
                            <a href="mailto:<?php echo e($info->owner_email); ?>"><?php echo e($info->owner_email); ?></a>
                        </div>
                    </div>
                    <div class="gm-contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <div>
                            <span>Hours</span>
                            <p>Saturday – Thursday, 10:00 – 19:00</p>
                        </div>
                    </div>
                </div>

                <div class="gm-contact-form-wrapper">
                    <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4);">Write to us</h3>

                    <form id="ajax_form" method="POST" action="<?php echo e(route('front.contact')); ?>" class="gm-form" novalidate>
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact-name">Name <span class="gm-label__required" aria-hidden="true">*</span></label>
                                    <input type="text" name="name" id="contact-name" required class="gm-input">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact-phone">Phone <span class="gm-label__required" aria-hidden="true">*</span></label>
                                    <input type="tel" name="phone" id="contact-phone" placeholder="01XXXXXXXXX" required class="gm-input">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contact-email">Email</label>
                                    <input type="email" name="email" id="contact-email" class="gm-input">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contact-message">Message <span class="gm-label__required" aria-hidden="true">*</span></label>
                                    <textarea name="message" id="contact-message" rows="6" required class="gm-textarea"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','size' => 'lg','full' => true,'type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','full' => true,'type' => 'submit']); ?>Send message <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </form>
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

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('ajax_form');
        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            const formData = new FormData(form);

            submitBtn.disabled = true;
            submitBtn.classList.add('gm-btn--loading');

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (window.toastr) toastr.success(data.msg || 'Message sent successfully');
                    form.reset();
                } else {
                    if (window.toastr) toastr.error(data.msg || 'Failed to send message');
                }
            })
            .catch(err => {
                console.error('Contact form error:', err);
                if (window.toastr) toastr.error('Something went wrong');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.classList.remove('gm-btn--loading');
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\frontend\contact_us.blade.php ENDPATH**/ ?>