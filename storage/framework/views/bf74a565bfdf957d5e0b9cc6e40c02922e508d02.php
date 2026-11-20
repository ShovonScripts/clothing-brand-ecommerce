
<?php $user = auth()->user(); ?>
<aside class="gm-dashboard-sidebar">
    <div class="gm-dashboard-profile" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); margin-bottom: var(--s-4); text-align: center;">
        <div class="gm-dashboard-avatar" style="width: 80px; height: 80px; border-radius: 50%; background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--s-3); color: var(--c-accent); font-size: var(--t-2xl); font-weight: 500; font-family: var(--f-display);">
            <?php echo e(strtoupper(mb_substr($user->first_name ?? 'U', 0, 1))); ?>

        </div>
        <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);"><?php echo e(full_name($user)); ?></h3>
        <?php if($user->created_at): ?>
            <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: 0;">Member since <?php echo e($user->created_at->format('F Y')); ?></p>
        <?php endif; ?>
    </div>

    <?php
        $links = [
            ['route' => 'front.dashboard.index', 'match' => 'front.dashboard.*', 'label' => 'Dashboard'],
            ['route' => 'front.orders.index', 'match' => 'front.orders.*', 'label' => 'Orders'],
            ['route' => 'front.wishlist.index', 'match' => 'front.wishlist.*', 'label' => 'Wishlist'],
            ['route' => 'front.account_details.index', 'match' => 'front.account_details.*', 'label' => 'Account details'],
        ];
        $itemStyle = 'display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); font-weight: 500; text-decoration: none; border-bottom: 1px solid var(--c-line);';
    ?>
    <nav class="gm-dashboard-nav" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;" aria-label="Account">
        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route($link['route'])); ?>" class="gm-dashboard-nav-item <?php echo e(request()->routeIs($link['match']) ? 'active' : ''); ?>"
               style="<?php echo e($itemStyle); ?>" <?php if(request()->routeIs($link['match'])): ?> aria-current="page" <?php endif; ?>>
                <?php echo e($link['label']); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <form method="POST" action="<?php echo e(route('logout')); ?>" style="margin: 0;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="gm-dashboard-nav-item gm-dashboard-nav-item--logout"
                    style="<?php echo e($itemStyle); ?> color: var(--c-danger); background: none; border: none; width: 100%; text-align: left; cursor: pointer;">
                Log out
            </button>
        </form>
    </nav>
</aside>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\frontend\dashboard\partials\sidebar.blade.php ENDPATH**/ ?>