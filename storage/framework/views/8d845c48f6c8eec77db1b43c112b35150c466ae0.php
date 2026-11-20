<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'announceLeft' => null,
    'announceMid' => null,
    'announceRight' => null,
    'logo' => null,
    'logoAlt' => 'GENTRY',
    'navigation' => [],
    'searchEnabled' => true,
    'cartCount' => 0,
    'user' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'announceLeft' => null,
    'announceMid' => null,
    'announceRight' => null,
    'logo' => null,
    'logoAlt' => 'GENTRY',
    'navigation' => [],
    'searchEnabled' => true,
    'cartCount' => 0,
    'user' => null,
]); ?>
<?php foreach (array_filter(([
    'announceLeft' => null,
    'announceMid' => null,
    'announceRight' => null,
    'logo' => null,
    'logoAlt' => 'GENTRY',
    'navigation' => [],
    'searchEnabled' => true,
    'cartCount' => 0,
    'user' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$announceLeft = $announceLeft ?? ['Client services' => route('front.contactUs')];
$announceRight = $announceRight ?? [
    'phone' => ['label' => config('app.phone') ?? '+880 1234 567890', 'href' => route('front.contactUs')],
    'store' => ['label' => 'Store locator', 'href' => route('front.products.index')],
];
?>

<div class="gm-announce" role="region" aria-label="Announcements">
    <div class="gm-container gm-announce__inner">
        <div class="gm-announce__left">
            <?php $__currentLoopData = $announceLeft; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($url); ?>" class="gm-announce__link"><?php echo e($label); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="gm-announce__mid"><?php echo e($announceMid ?? 'Complimentary delivery on orders over ৳5,000 — easy 14-day returns'); ?></div>
        <div class="gm-announce__right">
            <?php $__currentLoopData = $announceRight; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($item['href']); ?>" class="gm-announce__link"><?php echo e($item['label']); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<header class="gm-header" id="gm-header" role="banner">
    <div class="gm-container gm-header__inner">
        <div class="gm-header__left">
            <button type="button" class="gm-icon-btn gm-menu-toggle" aria-label="Open menu" data-gm-drawer-open="mobile-nav">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </button>
            <a href="<?php echo e(route('front.home')); ?>" class="gm-logo" aria-label="<?php echo e($logoAlt); ?>">
                <?php if($logo): ?>
                    <img src="<?php echo e($logo); ?>" alt="<?php echo e($logoAlt); ?>">
                <?php else: ?>
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
                <?php endif; ?>
            </a>
        </div>

        <nav class="gm-header__center" aria-label="Main navigation">
            <ul class="gm-nav">
                <?php $__currentLoopData = $navigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="gm-nav__item">
                        <?php if(isset($item['children'])): ?>
                            <a href="<?php echo e($item['href'] ?? '#'); ?>" class="gm-nav__link"><?php echo e($item['label']); ?></a>
                            <ul class="gm-dropdown" role="menu">
                                <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="gm-dropdown__item">
                                        <a href="<?php echo e($child['href']); ?>" class="gm-dropdown__link" role="menuitem"><?php echo e($child['label']); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($item['viewAll'])): ?>
                                    <li class="gm-dropdown__item">
                                        <a href="<?php echo e($item['viewAll']['href']); ?>" class="gm-dropdown__link gm-dropdown__link--view-all" role="menuitem"><?php echo e($item['viewAll']['label']); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        <?php else: ?>
                            <a href="<?php echo e($item['href']); ?>" class="gm-nav__link<?php echo e(isset($item['sale']) && $item['sale'] ? ' gm-nav__link--sale' : ''); ?>"><?php echo e($item['label']); ?></a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </nav>

        <div class="gm-header__right">
            <?php if($searchEnabled): ?>
                <button type="button" class="gm-icon-btn gm-search-trigger" aria-label="Search" data-gm-search-toggle>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </button>
            <?php endif; ?>

            <?php if($user): ?>
                <a href="<?php echo e(route('front.dashboard.index')); ?>" class="gm-icon-btn gm-account-link" aria-label="My account">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="gm-icon-btn gm-account-link" aria-label="Sign in">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </a>
            <?php endif; ?>

            <a href="<?php echo e(route('front.carts.index')); ?>" class="gm-icon-btn gm-cart-link" aria-label="Shopping bag (<?php echo e($cartCount); ?> items)">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                <?php if($cartCount > 0): ?>
                    <span class="gm-cart-badge cart-count"><?php echo e($cartCount); ?></span>
                <?php endif; ?>
            </a>
        </div>
    </div>

    <?php if($searchEnabled): ?>
        <div class="gm-search-panel" id="gm-search-panel" role="search" aria-label="Site search">
            <div class="gm-container">
                <form action="<?php echo e(route('front.products.index')); ?>" class="gm-search-form" role="search">
                    <svg class="gm-search-form__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="search" name="q" class="gm-search-form__input" placeholder="Search shirts, tailoring, knitwear…" autocomplete="off" aria-label="Search products" value="<?php echo e(request('q') ?? ''); ?>">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','type' => 'submit','class' => 'gm-search-form__submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','type' => 'submit','class' => 'gm-search-form__submit']); ?>Search <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </form>
            </div>
        </div>
    <?php endif; ?>
</header>

<?php $__env->startPush('scripts'); ?>
<script>
    (function() {
        // Search panel toggle
        const searchBtn = document.querySelector('[data-gm-search-toggle]');
        const searchPanel = document.getElementById('gm-search-panel');
        if (searchBtn && searchPanel) {
            searchBtn.addEventListener('click', () => {
                searchPanel.classList.toggle('gm-search-panel--open');
                const input = searchPanel.querySelector('input');
                if (searchPanel.classList.contains('gm-search-panel--open') && input) input.focus();
            });
        }

        // Header scroll effect
        const header = document.getElementById('gm-header');
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 100) {
                header.classList.add('gm-header--scrolled');
            } else {
                header.classList.remove('gm-header--scrolled');
            }
            lastScroll = currentScroll;
        }, { passive: true });
    })();
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\components\ui\header.blade.php ENDPATH**/ ?>