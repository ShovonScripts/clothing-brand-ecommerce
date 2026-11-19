<?php
use App\Models\Information;
use App\Models\Category;
  $information = Information::first();
  $navCategories = Category::whereNull('parent_id')->with('subcats')->orderBy('id')->get();
?>

<div class="gm-announce">
    <div class="container-fluid">
        <div class="gm-announce-left">
            <a href="<?php echo e(route('front.contactUs')); ?>">Client services</a>
        </div>
        <div class="gm-announce-mid">Complimentary delivery on orders over <?php echo e($information->currency == 'BDT' ? '৳5,000' : '$100'); ?> — easy 14-day returns</div>
        <div class="gm-announce-right">
            <a href="<?php echo e(route('front.contactUs')); ?>"><?php echo e($information->owner_phone); ?></a>
            <a href="<?php echo e(route('front.products.index')); ?>">Store locator</a>
        </div>
    </div>
</div>

<header class="gm-header" id="gm-header">
    <div class="container-fluid">
        <div class="gm-header-inner">
            <div class="gm-header-left">
                <button class="gm-icon-btn gm-menu-toggle" type="button" aria-label="Open menu" data-gm-drawer-open>
                    <i class="fas fa-bars"></i>
                </button>
                <a href="<?php echo e(route('front.home')); ?>" class="gm-logo" aria-label="<?php echo e($information->site_name); ?>">
                    <img src="<?php echo e(asset('uploads/img/'.$information->site_logo)); ?>" alt="<?php echo e($information->site_name); ?>">
                </a>
            </div>

            <div class="gm-header-center">
                <ul class="gm-nav">
                    <li><a href="<?php echo e(route('front.home')); ?>">Home</a></li>
                    <li>
                        <a href="<?php echo e(route('front.products.index')); ?>">Shop <i class="far fa-chevron-down" style="font-size:8px"></i></a>
                        <?php if($navCategories->count()): ?>
                        <ul class="gm-dropdown">
                            <?php $__currentLoopData = $navCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(route('front.products.index')); ?>?category_id=<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(route('front.products.index')); ?>">View all</a></li>
                        </ul>
                        <?php endif; ?>
                    </li>
                    <li><a href="<?php echo e(route('front.products.index')); ?>?shorting=desc">New in</a></li>
                    <?php $__currentLoopData = $navCategories->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e(route('front.subCategories', [$cat->url])); ?>"><?php echo e($cat->name); ?></a>
                        <?php if($cat->subcats->count()): ?>
                        <ul class="gm-dropdown">
                            <?php $__currentLoopData = $cat->subcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(route('front.products.index')); ?>?category_id=<?php echo e($cat->id); ?>&sub_category_id=<?php echo e($sub->id); ?>"><?php echo e($sub->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(route('front.aboutUs')); ?>">Our story</a></li>
                    <li class="is-sale"><a href="<?php echo e(route('front.discountProduct')); ?>">Sale</a></li>
                </ul>
            </div>

            <div class="gm-header-right">
                <button class="gm-icon-btn gm-search-trigger" type="button" aria-label="Search" data-gm-search-toggle>
                    <i class="far fa-search"></i>
                </button>
                <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="gm-icon-btn gm-account-link" aria-label="Sign in">
                    <i class="far fa-user"></i>
                </a>
                <?php else: ?>
                <a href="<?php echo e(route('front.dashboard.index')); ?>" class="gm-icon-btn gm-account-link" aria-label="My account">
                    <i class="far fa-user"></i>
                </a>
                <?php endif; ?>
                <a href="<?php echo e(route('front.carts.index')); ?>?segment=<?php echo e(request()->segment(1)); ?>" class="gm-icon-btn gm-cart-link cart-dropdown-btn" aria-label="Shopping bag">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="gm-cart-badge cart-count"><?php echo e(getTotalCart()); ?></span>
                </a>
            </div>
        </div>
    </div>

    <div class="gm-search-panel" id="gm-search-panel">
        <div class="container-fluid">
            <form action="<?php echo e(route('front.products.index')); ?>" class="gm-search-form" role="search">
                <i class="far fa-search" style="color:#6f6a63"></i>
                <input type="search" name="q" value="<?php echo e(request('q') ?? ''); ?>" placeholder="Search shirts, tailoring, knitwear…" autocomplete="off" aria-label="Search products">
                <button type="submit" class="gm-btn">Search</button>
            </form>
        </div>
    </div>
</header>

<div class="gm-drawer-overlay" data-gm-drawer-close></div>
<aside class="gm-drawer" id="gm-drawer" aria-label="Mobile menu">
    <div class="gm-drawer-head">
        <a href="<?php echo e(route('front.home')); ?>" class="gm-drawer-logo">
            <img src="<?php echo e(asset('uploads/img/'.$information->site_logo)); ?>" alt="<?php echo e($information->site_name); ?>">
        </a>
        <button type="button" class="gm-drawer-close" aria-label="Close menu" data-gm-drawer-close><i class="fas fa-times"></i></button>
    </div>

    <form action="<?php echo e(route('front.products.index')); ?>" class="gm-search-form" style="padding:0 0 20px" role="search">
        <input type="search" name="q" value="<?php echo e(request('q') ?? ''); ?>" placeholder="Search the collection…" aria-label="Search products">
        <button type="submit" class="gm-icon-btn" aria-label="Search"><i class="far fa-search"></i></button>
    </form>

    <ul class="gm-drawer-nav">
        <li><a href="<?php echo e(route('front.home')); ?>">Home</a></li>
        <li><a href="<?php echo e(route('front.products.index')); ?>">Shop all</a></li>
        <li><a href="<?php echo e(route('front.products.index')); ?>?shorting=desc">New in</a></li>
        <?php $__currentLoopData = $navCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <a href="<?php echo e(route('front.products.index')); ?>?category_id=<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></a>
            <?php if($cat->subcats->count()): ?>
            <ul class="gm-drawer-sub">
                <?php $__currentLoopData = $cat->subcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e(route('front.products.index')); ?>?category_id=<?php echo e($cat->id); ?>&sub_category_id=<?php echo e($sub->id); ?>"><?php echo e($sub->name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php endif; ?>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <li><a href="<?php echo e(route('front.discountProduct')); ?>" style="color:var(--gm-accent)">Sale</a></li>
        <li><a href="<?php echo e(route('front.aboutUs')); ?>">Our story</a></li>
        <li><a href="<?php echo e(route('front.contactUs')); ?>">Contact</a></li>
    </ul>

    <div class="gm-drawer-actions">
        <?php if(auth()->guard()->guest()): ?>
        <a href="<?php echo e(route('login')); ?>" class="gm-btn gm-btn--ghost">Sign in</a>
        <?php else: ?>
        <a href="<?php echo e(route('front.dashboard.index')); ?>" class="gm-btn gm-btn--ghost">My account</a>
        <?php endif; ?>
        <a href="<?php echo e(route('front.carts.index')); ?>" class="gm-btn">View bag (<?php echo e(getTotalCart()); ?>)</a>
    </div>
</aside>

<script>
    (function () {
        var body = document.body;
        var openBtn = document.querySelector('[data-gm-drawer-open]');
        var closeEls = document.querySelectorAll('[data-gm-drawer-close]');
        var searchBtn = document.querySelector('[data-gm-search-toggle]');
        var searchPanel = document.getElementById('gm-search-panel');

        function openDrawer() { body.classList.add('gm-drawer-open'); }
        function closeDrawer() { body.classList.remove('gm-drawer-open'); }

        if (openBtn) openBtn.addEventListener('click', openDrawer);
        closeEls.forEach(function (el) { el.addEventListener('click', closeDrawer); });

        if (searchBtn && searchPanel) {
            searchBtn.addEventListener('click', function () {
                searchPanel.classList.toggle('is-open');
                var input = searchPanel.querySelector('input');
                if (searchPanel.classList.contains('is-open') && input) input.focus();
            });
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeDrawer();
                if (searchPanel) searchPanel.classList.remove('is-open');
            }
        });
    })();
</script>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/partials/header.blade.php ENDPATH**/ ?>