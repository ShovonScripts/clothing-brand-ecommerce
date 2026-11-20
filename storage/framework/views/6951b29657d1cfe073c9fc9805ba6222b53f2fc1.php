<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'columns' => [],
    'rows' => [],
    'striped' => false,
    'hover' => true,
    'responsive' => true,
    'emptyMessage' => 'No records found',
    'actions' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'columns' => [],
    'rows' => [],
    'striped' => false,
    'hover' => true,
    'responsive' => true,
    'emptyMessage' => 'No records found',
    'actions' => null,
]); ?>
<?php foreach (array_filter(([
    'columns' => [],
    'rows' => [],
    'striped' => false,
    'hover' => true,
    'responsive' => true,
    'emptyMessage' => 'No records found',
    'actions' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ['gm-admin-table'];
if ($striped) $classes[] = 'gm-admin-table--striped';
if ($hover) $classes[] = 'gm-admin-table--hover';
if ($responsive) $classes[] = 'gm-admin-table--responsive';
$class = implode(' ', $classes);
?>

<div style="overflow-x: auto;">
    <table <?php echo e($attributes->merge(['class' => $class])); ?>>
        <thead>
            <tr>
                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th
                        style="text-align: <?php echo e($column['align'] ?? 'left'); ?>;"
                        <?php echo e(isset($column['width']) ? 'width="' . $column['width'] . '"' : ''); ?>

                    >
                        <?php echo e($column['label'] ?? ucfirst($column['key'] ?? '')); ?>

                    </th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($actions): ?>
                    <th class="gm-admin-table__cell--actions">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td style="text-align: <?php echo e($column['align'] ?? 'left'); ?>;">
                            <?php if(isset($column['render'])): ?>
                                <?php echo e($column['render']($row)); ?>

                            <?php else: ?>
                                <?php echo e($row[$column['key']] ?? ''); ?>

                            <?php endif; ?>
                        </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($actions): ?>
                        <td class="gm-admin-table__cell--actions">
                            <div class="gm-admin-table__actions">
                                <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $label = $action['label'] ?? '';
                                        $url = $action['url']($row) ?? '#';
                                        $icon = $action['icon'] ?? '';
                                        $class = $action['class'] ?? '';
                                        $attrs = $action['attrs'] ?? [];
                                    ?>
                                    <a
                                        href="<?php echo e($url); ?>"
                                        class="gm-admin-table__action-btn gm-admin-table__action-btn--<?php echo e($action['type'] ?? 'view'); ?> <?php echo e($class); ?>"
                                        <?php echo e(collect($attrs)->map(fn($v, $k) => "$k=\"$v\"")->implode(' ')); ?>

                                        aria-label="<?php echo e($label); ?>"
                                    >
                                        <?php echo $icon; ?>

                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="<?php echo e(count($columns) + ($actions ? 1 : 0)); ?>" style="text-align: center; padding: var(--s-8); color: var(--c-ink-500);">
                        <?php echo e($emptyMessage); ?>

                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\admin\table.blade.php ENDPATH**/ ?>