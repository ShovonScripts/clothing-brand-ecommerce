<?php $__env->startSection('title', 'Dashboard — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-wrapper">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.breadcrumb','data' => ['items' => [
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Dashboard'],
        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Dashboard'],
        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.section','data' => ['size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'md']); ?>
        <div class="gm-dashboard-layout" style="display: grid; grid-template-columns: 280px 1fr; gap: var(--s-8);">
            
            <aside class="gm-dashboard-sidebar" style="position: sticky; top: calc(var(--header-h) + var(--s-4));">
                <div class="gm-dashboard-profile" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); margin-bottom: var(--s-4); text-align: center;">
                    <div class="gm-dashboard-avatar" style="width: 80px; height: 80px; border-radius: 50%; background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--s-3); color: var(--c-accent); font-size: var(--t-2xl); font-weight: 500; font-family: var(--f-display);">
                        <?php echo e(strtoupper(auth()->user()->first_name[0] ?? 'U')); ?>

                    </div>
                    <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);"><?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?></h3>
                    <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: 0;">Member since <?php echo e(auth()->user()->created_at->format('F Y')); ?></p>
                </div>

                <nav class="gm-dashboard-nav" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;" aria-label="Dashboard navigation">
                    <a href="<?php echo e(route('front.dashboard.index')); ?>" class="gm-dashboard-nav-item <?php echo e(request()->routeIs('front.dashboard.index') ? 'active' : ''); ?>" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); font-weight: 500; text-decoration: none; border-bottom: 1px solid var(--c-line); transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="<?php echo e(route('front.orders.index')); ?>" class="gm-dashboard-nav-item <?php echo e(request()->routeIs('front.orders*') ? 'active' : ''); ?>" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); font-weight: 500; text-decoration: none; border-bottom: 1px solid var(--c-line); transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                        <span>Orders</span>
                    </a>
                    <a href="<?php echo e(route('front.wishlist.index')); ?>" class="gm-dashboard-nav-item <?php echo e(request()->routeIs('front.wishlist*') ? 'active' : ''); ?>" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); font-weight: 500; text-decoration: none; border-bottom: 1px solid var(--c-line); transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                        <span>Wishlist</span>
                    </a>
                    <a href="<?php echo e(route('front.account_details.index')); ?>" class="gm-dashboard-nav-item <?php echo e(request()->routeIs('front.account_details*') ? 'active' : ''); ?>" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); font-weight: 500; text-decoration: none; border-bottom: 1px solid var(--c-line); transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        <span>Account Details</span>
                    </a>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                        <?php echo csrf_field(); ?>
                    </form>
                    <button type="submit" form="logout-form" class="gm-dashboard-nav-item gm-dashboard-nav-item--logout" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-danger); font-size: var(--t-sm); font-weight: 500; background: none; border: none; width: 100%; text-align: left; cursor: pointer; transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span>Logout</span>
                    </button>
                </nav>
            </aside>

            
            <div class="gm-dashboard-main">
                <div class="gm-dashboard-header" style="margin-bottom: var(--s-6);">
                    <h1 style="font-size: var(--t-2xl); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);">Dashboard</h1>
                    <p style="color: var(--c-ink-500); margin: 0;">Welcome back, <?php echo e(auth()->user()->first_name); ?>. Here's what's happening with your account.</p>
                </div>

                
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.grid','data' => ['columns' => 4,'gap' => 4,'autoFit' => true,'minWidth' => 180,'style' => 'margin-bottom: var(--s-6);']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['columns' => 4,'gap' => 4,'autoFit' => true,'minWidth' => 180,'style' => 'margin-bottom: var(--s-6);']); ?>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.stat-card','data' => ['label' => 'Total Orders','value' => $totalOrders ?? 0,'icon' => '<svg width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z\'></path><polyline points=\'3.27 6.96 12 12.01 20.73 6.96\'></polyline><line x1=\'12\' y1=\'22.08\' x2=\'12\' y2=\'12\'></line></svg>']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Orders','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($totalOrders ?? 0),'icon' => '<svg width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z\'></path><polyline points=\'3.27 6.96 12 12.01 20.73 6.96\'></polyline><line x1=\'12\' y1=\'22.08\' x2=\'12\' y2=\'12\'></line></svg>']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.stat-card','data' => ['label' => 'Total Spent','value' => '<?php echo e($currencySymbol); ?> ' . number_format($totalSpent ?? 0, 2),'icon' => '<svg width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><line x1=\'12\' y1=\'1\' x2=\'12\' y2=\'23\'></line><path d=\'M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6\'></path></svg>']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Spent','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('{{ $currencySymbol }} ' . number_format($totalSpent ?? 0, 2)),'icon' => '<svg width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><line x1=\'12\' y1=\'1\' x2=\'12\' y2=\'23\'></line><path d=\'M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6\'></path></svg>']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.stat-card','data' => ['label' => 'Wishlist Items','value' => $wishlistCount ?? 0,'icon' => '<svg width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z\'></path></svg>']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Wishlist Items','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($wishlistCount ?? 0),'icon' => '<svg width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z\'></path></svg>']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.stat-card','data' => ['label' => 'Pending Orders','value' => $pendingOrders ?? 0,'icon' => '<svg width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><circle cx=\'12\' cy=\'12\' r=\'10\'></circle><polyline points=\'12 6 12 12 16 14\'></polyline></svg>','variant' => 'warn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Pending Orders','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pendingOrders ?? 0),'icon' => '<svg width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><circle cx=\'12\' cy=\'12\' r=\'10\'></circle><polyline points=\'12 6 12 12 16 14\'></polyline></svg>','variant' => 'warn']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                
                <div class="gm-dashboard-section" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;">
                    <div class="gm-dashboard-section-header" style="display: flex; align-items: center; justify-content: space-between; padding: var(--s-4) var(--s-5); border-bottom: 1px solid var(--c-line);">
                        <h2 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0;">Recent Orders</h2>
                        <a href="<?php echo e(route('front.orders.index')); ?>" class="gm-link gm-link--sm" style="color: var(--c-accent); font-size: var(--t-sm); font-weight: 500; text-transform: uppercase; letter-spacing: var(--ls-wide);">View All</a>
                    </div>

                    <?php if($recentOrders->count()): ?>
                        <div class="gm-dashboard-table" style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="border-bottom: 1px solid var(--c-line);">
                                        <th style="padding: var(--s-3) var(--s-4); text-align: left; font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500);">Order</th>
                                        <th style="padding: var(--s-3) var(--s-4); text-align: left; font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500);">Date</th>
                                        <th style="padding: var(--s-3) var(--s-4); text-align: left; font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500);">Status</th>
                                        <th style="padding: var(--s-3) var(--s-4); text-align: left; font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500);">Items</th>
                                        <th style="padding: var(--s-3) var(--s-4); text-align: right; font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500);">Total</th>
                                        <th style="padding: var(--s-3) var(--s-4); text-align: right; font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-ink-500);"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr style="border-bottom: 1px solid var(--c-line); transition: background var(--d-fast);">
                                            <td style="padding: var(--s-3) var(--s-4); font-weight: 500; color: var(--c-ink-900); font-family: var(--f-display);">#<?php echo e($order->invoice_no); ?></td>
                                            <td style="padding: var(--s-3) var(--s-4); color: var(--c-ink-700);"><?php echo e($order->date->format('M j, Y')); ?></td>
                                            <td style="padding: var(--s-3) var(--s-4);">
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => $order->status_badge_variant ?? 'neutral']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order->status_badge_variant ?? 'neutral')]); ?><?php echo e($order->status); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            </td>
                                            <td style="padding: var(--s-3) var(--s-4); color: var(--c-ink-700);"><?php echo e($order->details->count()); ?></td>
                                            <td style="padding: var(--s-3) var(--s-4); text-align: right; font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900);"><?php echo e($currencySymbol); ?> <?php echo e(number_format($order->final_amount, 2)); ?></td>
                                            <td style="padding: var(--s-3) var(--s-4); text-align: right;">
                                                <a href="<?php echo e(route('front.orders.show', [$order->id])); ?>" class="gm-btn gm-btn--ghost gm-btn--sm">View</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="gm-empty-state gm-empty-state--inline gm-empty-state--orders" style="padding: var(--s-8) var(--s-4);">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.empty-state','data' => ['type' => 'orders','title' => 'No orders yet','message' => 'When you place an order, it\'ll show up here.','action' => 'Start Shopping','actionUrl' => route('front.products.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'orders','title' => 'No orders yet','message' => 'When you place an order, it\'ll show up here.','action' => 'Start Shopping','actionUrl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('front.products.index'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="gm-dashboard-section" style="margin-top: var(--s-6);">
                    <h2 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4);">Quick Actions</h2>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.grid','data' => ['columns' => 4,'gap' => 3,'autoFit' => true,'minWidth' => 160]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['columns' => 4,'gap' => 3,'autoFit' => true,'minWidth' => 160]); ?>
                        <a href="<?php echo e(route('front.products.index')); ?>" class="gm-dashboard-action" style="display: flex; flex-direction: column; align-items: center; gap: var(--s-2); padding: var(--s-5); background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); text-decoration: none; color: var(--c-ink-900); transition: all var(--d-fast) var(--e-out);">
                            <div style="width: 48px; height: 48px; border-radius: var(--r-md); background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; color: var(--c-accent);">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                            </div>
                            <span style="font-weight: 500; text-align: center;">Shop Now</span>
                        </a>
                        <a href="<?php echo e(route('front.orders.index')); ?>" class="gm-dashboard-action" style="display: flex; flex-direction: column; align-items: center; gap: var(--s-2); padding: var(--s-5); background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); text-decoration: none; color: var(--c-ink-900); transition: all var(--d-fast) var(--e-out);">
                            <div style="width: 48px; height: 48px; border-radius: var(--r-md); background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; color: var(--c-accent);">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                            </div>
                            <span style="font-weight: 500; text-align: center;">My Orders</span>
                        </a>
                        <a href="<?php echo e(route('front.wishlist.index')); ?>" class="gm-dashboard-action" style="display: flex; flex-direction: column; align-items: center; gap: var(--s-2); padding: var(--s-5); background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); text-decoration: none; color: var(--c-ink-900); transition: all var(--d-fast) var(--e-out);">
                            <div style="width: 48px; height: 48px; border-radius: var(--r-md); background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; color: var(--c-accent);">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            </div>
                            <span style="font-weight: 500; text-align: center;">Wishlist</span>
                        </a>
                        <a href="<?php echo e(route('front.account_details.index')); ?>" class="gm-dashboard-action" style="display: flex; flex-direction: column; align-items: center; gap: var(--s-2); padding: var(--s-5); background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); text-decoration: none; color: var(--c-ink-900); transition: all var(--d-fast) var(--e-out);">
                            <div style="width: 48px; height: 48px; border-radius: var(--r-md); background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; color: var(--c-accent);">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            </div>
                            <span style="font-weight: 500; text-align: center;">Account Settings</span>
                        </a>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
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
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\frontend\dashboard\index.blade.php ENDPATH**/ ?>