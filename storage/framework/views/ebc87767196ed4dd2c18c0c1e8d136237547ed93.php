<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'value' => 0,
    'max' => 5,
    'count' => 0,
    'readonly' => true,
    'size' => 'md',
    'showCount' => true,
    'showBreakdown' => false,
    'name' => 'rating',
    'onChange' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'value' => 0,
    'max' => 5,
    'count' => 0,
    'readonly' => true,
    'size' => 'md',
    'showCount' => true,
    'showBreakdown' => false,
    'name' => 'rating',
    'onChange' => null,
]); ?>
<?php foreach (array_filter(([
    'value' => 0,
    'max' => 5,
    'count' => 0,
    'readonly' => true,
    'size' => 'md',
    'showCount' => true,
    'showBreakdown' => false,
    'name' => 'rating',
    'onChange' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-rating', "gm-rating--{$size}"];
if ($readonly) $classes[] = 'gm-rating--readonly';
if ($showCount && !$showBreakdown) $classes[] = 'gm-rating--inline';
$class = implode(' ', $classes);

$fullStars = floor($value);
$hasHalf = ($value - $fullStars) >= 0.5;
$emptyStars = $max - $fullStars - ($hasHalf ? 1 : 0);
?>

<div <?php echo e($attributes->merge(['class' => $class, 'role' => 'img', 'aria-label' => "Rated {$value} out of {$max} stars"])); ?>>
    <div class="gm-rating__stars">
        <?php for($i = 0; $i < $fullStars; $i++): ?>
            <svg class="gm-rating__star gm-rating__star--filled" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
        <?php endfor; ?>

        <?php if($hasHalf): ?>
            <svg class="gm-rating__star gm-rating__star--half" viewBox="0 0 24 24" aria-hidden="true">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" class="gm-rating__star--filled"></polygon>
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" class="gm-rating__star--empty" style="fill: var(--c-line)"></polygon>
            </svg>
        <?php endif; ?>

        <?php for($i = 0; $i < $emptyStars; $i++): ?>
            <svg class="gm-rating__star gm-rating__star--empty" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
        <?php endfor; ?>
    </div>

    <?php if(!$readonly): ?>
        <input type="hidden" name="<?php echo e($name); ?>" value="<?php echo e($value); ?>">
    <?php endif; ?>

    <?php if($showCount): ?>
        <span class="gm-rating__count">(<?php echo e($count); ?>)</span>
    <?php endif; ?>

    <?php if($showBreakdown && $count > 0): ?>
        <div class="gm-rating__breakdown" aria-label="Rating breakdown">
            <?php for($i = $max; $i >= 1; $i--): ?>
                <?php
                    $percent = $count > 0 ? 0 : 0; // Would need actual distribution data
                ?>
                <div class="gm-rating__bar">
                    <span class="gm-rating__bar-label"><?php echo e($i); ?>★</span>
                    <div class="gm-rating__bar-track">
                        <div class="gm-rating__bar-fill" style="width: <?php echo e($percent); ?>%"></div>
                    </div>
                    <span class="gm-rating__bar-count">0</span>
                </div>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>

<?php if(!$readonly): ?>
<?php $__env->startPush('scripts'); ?>
<script>
    (function() {
        const container = document.currentScript?.previousElementSibling;
        if (!container) return;

        const stars = container.querySelectorAll('.gm-rating__star');
        const input = container.querySelector('input[type="hidden"]');
        if (!input) return;

        stars.forEach((star, index) => {
            star.classList.add('gm-rating__star--interactive');
            star.addEventListener('click', () => {
                const value = index + 1;
                input.value = value;
                input.dispatchEvent(new Event('change', { bubbles: true }));

                stars.forEach((s, i) => {
                    s.classList.toggle('gm-rating__star--filled', i < value);
                    s.classList.toggle('gm-rating__star--empty', i >= value);
                    s.classList.remove('gm-rating__star--half');
                });
            });

            star.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowRight' && index < stars.length - 1) {
                    e.preventDefault();
                    stars[index + 1].focus();
                }
                if (e.key === 'ArrowLeft' && index > 0) {
                    e.preventDefault();
                    stars[index - 1].focus();
                }
            });
        });
    })();
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\rating.blade.php ENDPATH**/ ?>