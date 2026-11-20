<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'images' => [],
    'mainImage' => null,
    'thumbnails' => [],
    'aspectRatio' => '1',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'images' => [],
    'mainImage' => null,
    'thumbnails' => [],
    'aspectRatio' => '1',
]); ?>
<?php foreach (array_filter(([
    'images' => [],
    'mainImage' => null,
    'thumbnails' => [],
    'aspectRatio' => '1',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$mainImg = $mainImage ?? ($images[0] ?? null);
$thumbs = $thumbnails ?: $images;
$galleryId = 'gm-gallery-' . uniqid();
?>

<div <?php echo e($attributes->merge(['class' => 'gm-gallery', 'id' => $galleryId])); ?>>
    <div class="gm-gallery__main" style="aspect-ratio: <?php echo e($aspectRatio); ?>;">
        <?php if($mainImg): ?>
            <img
                src="<?php echo e($mainImg); ?>"
                alt=""
                class="gm-gallery__main-image"
                loading="eager"
                width="800"
                height="800"
            >
        <?php else: ?>
            <div class="gm-skeleton gm-skeleton--box" aria-hidden="true"></div>
        <?php endif; ?>

        <?php if(count($thumbs) > 1): ?>
            <a
                href="<?php echo e($mainImg); ?>"
                target="_blank"
                rel="noopener"
                class="gm-gallery__zoom-trigger"
                aria-label="Open full-size image"
                data-gm-gallery-zoom-open
            >
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
            </a>

            <span class="gm-gallery__swipe-hint" aria-hidden="true">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="4 20 12 12 20 20"></polyline></svg>
                Swipe
            </span>
        <?php endif; ?>
    </div>

    <?php if(count($thumbs) > 1): ?>
        <div class="gm-gallery__thumbnails" role="tablist" aria-label="Product images">
            <?php $__currentLoopData = $thumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $thumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button
                    type="button"
                    role="tab"
                    class="gm-gallery__thumbnail <?php echo e($index === 0 ? 'gm-gallery__thumbnail--active' : ''); ?>"
                    aria-selected="<?php echo e($index === 0 ? 'true' : 'false'); ?>"
                    aria-controls="<?php echo e($galleryId); ?>-panel-<?php echo e($index); ?>"
                    id="<?php echo e($galleryId); ?>-tab-<?php echo e($index); ?>"
                    data-gm-gallery-thumb="<?php echo e($index); ?>"
                    style="aspect-ratio: 1;"
                >
                    <img src="<?php echo e($thumb); ?>" alt="" class="gm-gallery__thumbnail-image" loading="lazy" width="120" height="120">
                </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    (function() {
        const gallery = document.getElementById('<?php echo e($galleryId); ?>');
        if (!gallery) return;

        const mainImg = gallery.querySelector('.gm-gallery__main-image');
        const thumbs = gallery.querySelectorAll('.gm-gallery__thumbnail');
        const zoomTrigger = gallery.querySelector('[data-gm-gallery-zoom-open]');

        function setMain(index) {
            const thumb = thumbs[index];
            if (!thumb || !mainImg) return;

            const img = thumb.querySelector('img');
            if (!img) return;

            // Images are served as uploaded (no resized variants), so show the same file.
            mainImg.src = img.src;
            mainImg.alt = img.alt;
            if (zoomTrigger) zoomTrigger.href = img.src;

            thumbs.forEach((t, i) => {
                t.classList.toggle('gm-gallery__thumbnail--active', i === index);
                t.setAttribute('aria-selected', i === index);
            });
        }

        thumbs.forEach((thumb, index) => {
            thumb.addEventListener('click', () => setMain(index));
            thumb.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    setMain(index);
                }
            });
        });

        // Keyboard navigation
        gallery.addEventListener('keydown', (e) => {
            const active = gallery.querySelector('.gm-gallery__thumbnail--active');
            if (!active) return;
            const index = Array.from(thumbs).indexOf(active);
            let newIndex = index;
            if (e.key === 'ArrowRight') newIndex = (index + 1) % thumbs.length;
            if (e.key === 'ArrowLeft') newIndex = (index - 1 + thumbs.length) % thumbs.length;
            if (newIndex !== index) {
                e.preventDefault();
                setMain(newIndex);
                thumbs[newIndex].focus();
            }
        });

        // Swipe support for mobile
        let touchStartX = 0;
        const mainEl = gallery.querySelector('.gm-gallery__main');
        if (mainEl) {
            mainEl.addEventListener('touchstart', (e) => { touchStartX = e.touches[0].clientX; }, { passive: true });
            mainEl.addEventListener('touchend', (e) => {
                const touchEndX = e.changedTouches[0].clientX;
                const diff = touchStartX - touchEndX;
                if (Math.abs(diff) > 50) {
                    const active = gallery.querySelector('.gm-gallery__thumbnail--active');
                    if (!active) return;
                    const index = Array.from(thumbs).indexOf(active);
                    const newIndex = diff > 0 ? (index + 1) % thumbs.length : (index - 1 + thumbs.length) % thumbs.length;
                    setMain(newIndex);
                }
            }, { passive: true });
        }
    })();
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\gallery.blade.php ENDPATH**/ ?>