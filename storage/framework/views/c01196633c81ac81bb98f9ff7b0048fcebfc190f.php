<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'currentPage' => 1,
    'lastPage' => 1,
    'total' => 0,
    'perPage' => 15,
    'onPageChange' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'currentPage' => 1,
    'lastPage' => 1,
    'total' => 0,
    'perPage' => 15,
    'onPageChange' => null,
]); ?>
<?php foreach (array_filter(([
    'currentPage' => 1,
    'lastPage' => 1,
    'total' => 0,
    'perPage' => 15,
    'onPageChange' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$range = 2;
$start = max(1, $currentPage - $range);
$end = min($lastPage, $currentPage + $range);

if ($start > 1) $start = max(1, $end - 2 * $range);
if ($end < $lastPage) $end = min($lastPage, $start + 2 * $range);
?>

<nav <?php echo e($attributes->merge(['class' => 'gm-pagination', 'aria-label' => 'Pagination'])); ?>>
    <ul class="gm-pagination__list">
        
        <li class="gm-pagination__item">
            <button
                type="button"
                class="gm-pagination__btn"
                <?php echo e($currentPage <= 1 ? 'disabled' : ''); ?>

                aria-label="Previous page"
            >
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
        </li>

        
        <?php if($start > 1): ?>
            <li class="gm-pagination__item">
                <button
                    type="button"
                    class="gm-pagination__link"
                >1</button>
            </li>
            <?php if($start > 2): ?>
                <li class="gm-pagination__item"><span class="gm-pagination__ellipsis" aria-hidden="true">…</span></li>
            <?php endif; ?>
        <?php endif; ?>

        
        <?php for($i = $start; $i <= $end; $i++): ?>
            <li class="gm-pagination__item">
                <?php if($i === $currentPage): ?>
                    <span class="gm-pagination__btn" aria-current="page"><?php echo e($i); ?></span>
                <?php else: ?>
                    <button
                        type="button"
                        class="gm-pagination__link"
                    ><?php echo e($i); ?></button>
                <?php endif; ?>
            </li>
        <?php endfor; ?>

        
        <?php if($end < $lastPage): ?>
            <?php if($end < $lastPage - 1): ?>
                <li class="gm-pagination__item"><span class="gm-pagination__ellipsis" aria-hidden="true">…</span></li>
            <?php endif; ?>
            <li class="gm-pagination__item">
                <button
                    type="button"
                    class="gm-pagination__link"
                ><?php echo e($lastPage); ?></button>
            </li>
        <?php endif; ?>

        
        <li class="gm-pagination__item">
            <button
                type="button"
                class="gm-pagination__btn"
                <?php echo e($currentPage >= $lastPage ? 'disabled' : ''); ?>

                aria-label="Next page"
            >
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
        </li>
    </ul>

    <?php if($total > 0): ?>
        <div class="gm-pagination__info" aria-live="polite">
            Showing <?php echo e(($currentPage - 1) * $perPage + 1); ?> to <?php echo e(min($currentPage * $perPage, $total)); ?> of <?php echo e($total); ?> results
        </div>
    <?php endif; ?>
</nav><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\pagination.blade.php ENDPATH**/ ?>