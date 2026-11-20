<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    // key => ['label' => 'Category', 'type' => 'checkbox'|'radio', 'options' => [['value' => 1, 'label' => 'Shirts'], ...]]
    // The key is used as the input name: checkbox groups submit "key[]", radio groups submit "key".
    'filters' => [],
    // key => selected value(s) from the current request
    'selected' => [],
    'title' => 'Filters',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    // key => ['label' => 'Category', 'type' => 'checkbox'|'radio', 'options' => [['value' => 1, 'label' => 'Shirts'], ...]]
    // The key is used as the input name: checkbox groups submit "key[]", radio groups submit "key".
    'filters' => [],
    // key => selected value(s) from the current request
    'selected' => [],
    'title' => 'Filters',
]); ?>
<?php foreach (array_filter(([
    // key => ['label' => 'Category', 'type' => 'checkbox'|'radio', 'options' => [['value' => 1, 'label' => 'Shirts'], ...]]
    // The key is used as the input name: checkbox groups submit "key[]", radio groups submit "key".
    'filters' => [],
    // key => selected value(s) from the current request
    'selected' => [],
    'title' => 'Filters',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>


<aside <?php echo e($attributes->merge(['class' => 'gm-filter-sidebar'])); ?> data-gm-filter-sidebar>
    <div class="gm-filter-sidebar__header">
        <h2 class="gm-filter-sidebar__title"><?php echo e($title); ?></h2>
        <button type="button" class="gm-filter-sidebar__clear" data-gm-clear-filters>Clear all</button>
    </div>

    <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $type = ($filter['type'] ?? 'checkbox') === 'radio' ? 'radio' : 'checkbox';
            $inputName = $type === 'checkbox' ? $key . '[]' : $key;
            $current = array_map('strval', (array) ($selected[$key] ?? []));
            $label = $filter['label'] ?? ucfirst($key);
        ?>

        <?php if(!empty($filter['options'])): ?>
            <details class="gm-filter-sidebar__section" open>
                <summary class="gm-filter-sidebar__section-title">
                    <?php echo e($label); ?>

                    <span class="gm-filter-sidebar__section-icon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </span>
                </summary>

                <div class="gm-filter-sidebar__section-content">
                    <div class="gm-filter-group" role="group" aria-label="<?php echo e($label); ?>">
                        <?php $__currentLoopData = $filter['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $value = (string) ($option['value'] ?? $option);
                                $isSelected = in_array($value, $current, true)
                                    || ($type === 'radio' && $value === '' && empty($current));
                            ?>
                            <label class="gm-filter-group__label">
                                <input
                                    type="<?php echo e($type); ?>"
                                    class="gm-filter-group__input"
                                    name="<?php echo e($inputName); ?>"
                                    value="<?php echo e($value); ?>"
                                    <?php if($isSelected): echo 'checked'; endif; ?>
                                >
                                <span class="gm-filter-group__check" aria-hidden="true"></span>
                                <span><?php echo e($option['label'] ?? $value); ?></span>
                                <?php if(isset($option['count'])): ?>
                                    <span class="gm-filter-group__count">(<?php echo e($option['count']); ?>)</span>
                                <?php endif; ?>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </details>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php echo e($slot); ?>

</aside>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/components/ui/filter-sidebar.blade.php ENDPATH**/ ?>