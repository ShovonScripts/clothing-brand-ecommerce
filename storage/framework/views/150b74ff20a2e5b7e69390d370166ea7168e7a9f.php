

<?php $__env->startSection('title', 'Shop — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<?php
    // Frontend\ProductController@index passes $cats, $types, $sizes. Products
    // are fetched over AJAX from the same route (rendered by index_data.blade.php),
    // so every filter below uses the parameter names that controller reads:
    // cat_id[], size_id[], brand_id, q, shorting, page.
    $selectedCats = array_map('strval', (array) request('cat_id', []));
    // Links elsewhere on the site use ?category_id= / ?sub_category_id=.
    $linkedCategory = request('sub_category_id') ?: request('category_id');
    if ($linkedCategory) $selectedCats[] = (string) $linkedCategory;
    $selectedCats = array_values(array_unique($selectedCats));

    $topCategoryIds = $cats->pluck('id')->map(fn ($id) => (string) $id)->all();
    // A linked sub-category isn't in the sidebar list; keep it as a hidden filter.
    $hiddenCats = array_diff($selectedCats, $topCategoryIds);

    $filters = [
        'cat_id' => [
            'label' => 'Category',
            'options' => $cats->map(fn ($c) => ['value' => $c->id, 'label' => $c->name])->all(),
        ],
        'brand_id' => [
            'label' => 'Brand',
            'type' => 'radio',
            'options' => collect([['value' => '', 'label' => 'All brands']])
                ->merge($types->map(fn ($t) => ['value' => $t->id, 'label' => $t->name]))->all(),
        ],
        'size_id' => [
            'label' => 'Size',
            'options' => $sizes->map(fn ($s) => ['value' => $s->id, 'label' => $s->title])->all(),
        ],
    ];
    $selected = [
        'cat_id' => $selectedCats,
        'brand_id' => request('brand_id', ''),
        'size_id' => (array) request('size_id', []),
    ];
?>

<main class="main-wrapper">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.breadcrumb','data' => ['items' => [
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Shop'],
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Shop'],
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
        <form id="gm-shop-filters" class="gm-listing-layout" action="<?php echo e(route('front.products.index')); ?>" method="GET" role="search">
            <?php if(request('q')): ?>
                <input type="hidden" name="q" value="<?php echo e(request('q')); ?>">
            <?php endif; ?>
            <?php $__currentLoopData = $hiddenCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="cat_id[]" value="<?php echo e($catId); ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="gm-listing-filters-overlay" data-gm-shop-filters-close></div>
            <div class="gm-listing-filters" id="gm-shop-filter-panel" aria-label="Product filters">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.filter-sidebar','data' => ['filters' => $filters,'selected' => $selected]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.filter-sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['filters' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filters),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($selected)]); ?>
                    <div class="gm-listing-filters__footer">
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','full' => true,'class' => 'gm-listing-apply','dataGmShopFiltersClose' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','full' => true,'class' => 'gm-listing-apply','data-gm-shop-filters-close' => true]); ?>Show results <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>

            <div class="gm-listing-main">
                <div class="gm-listing-toolbar">
                    <?php if(request('q')): ?>
                        <p class="gm-listing-query">Results for “<?php echo e(request('q')); ?>”</p>
                    <?php endif; ?>

                    <div class="gm-listing-controls">
                        <button type="button" class="gm-btn gm-btn--secondary gm-btn--sm gm-listing-filter-toggle"
                                aria-controls="gm-shop-filter-panel" aria-expanded="false" data-gm-shop-filters-open>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                            Filters
                        </button>

                        <label class="visually-hidden" for="gm-shop-sort">Sort products</label>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.select','data' => ['id' => 'gm-shop-sort','name' => 'shorting','placeholder' => '','value' => request('shorting', 'desc'),'options' => [
                                'desc' => 'Newest first',
                                'asc' => 'Oldest first',
                                'name' => 'Name A–Z',
                                'price_low' => 'Price: low to high',
                                'price_high' => 'Price: high to low',
                            ],'class' => 'gm-listing-sort']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'gm-shop-sort','name' => 'shorting','placeholder' => '','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request('shorting', 'desc')),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                                'desc' => 'Newest first',
                                'asc' => 'Oldest first',
                                'name' => 'Name A–Z',
                                'price_low' => 'Price: low to high',
                                'price_high' => 'Price: high to low',
                            ]),'class' => 'gm-listing-sort']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>
                </div>

                <div id="gm-shop-products" class="gm-listing-products" aria-live="polite" aria-busy="true">
                    <p class="gm-listing-results">Loading products…</p>
                </div>
            </div>
        </form>
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
(function () {
    const form = document.getElementById('gm-shop-filters');
    const target = document.getElementById('gm-shop-products');
    if (!form || !target) return;

    const panel = document.getElementById('gm-shop-filter-panel');
    const overlay = form.querySelector('.gm-listing-filters-overlay');
    const toggle = form.querySelector('[data-gm-shop-filters-open]');
    let inflight = null;

    function params(page) {
        const p = new URLSearchParams(new FormData(form));
        // An empty radio value ("All brands") means no brand filter.
        if (!p.get('brand_id')) p.delete('brand_id');
        p.set('page', page || 1);
        return p;
    }

    function load(page) {
        const p = params(page);
        inflight?.abort();
        inflight = new AbortController();
        target.setAttribute('aria-busy', 'true');

        fetch(form.action + '?' + p.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' },
            signal: inflight.signal,
        })
            .then((res) => { if (!res.ok) throw new Error(res.status); return res.text(); })
            .then((html) => {
                target.innerHTML = html;
                target.setAttribute('aria-busy', 'false');
                if (p.get('page') === '1') p.delete('page');
                history.replaceState(null, '', form.action + (p.toString() ? '?' + p : ''));
            })
            .catch((err) => {
                if (err.name === 'AbortError') return;
                target.setAttribute('aria-busy', 'false');
                target.innerHTML = '<p class="gm-listing-results">Sorry, products could not be loaded. Please refresh the page.</p>';
            });
    }

    function setPanel(open) {
        panel.classList.toggle('is-open', open);
        overlay.classList.toggle('is-open', open);
        toggle?.setAttribute('aria-expanded', open ? 'true' : 'false');
        document.body.style.overflow = open ? 'hidden' : '';
    }

    form.addEventListener('change', () => load(1));
    form.addEventListener('submit', (e) => { e.preventDefault(); load(1); });

    form.addEventListener('click', (e) => {
        if (e.target.closest('[data-gm-shop-filters-open]')) { setPanel(true); return; }
        if (e.target.closest('[data-gm-shop-filters-close]')) { setPanel(false); return; }
        if (e.target.closest('[data-gm-clear-filters]')) {
            form.querySelectorAll('input[type=checkbox]').forEach((i) => { i.checked = false; });
            form.querySelectorAll('input[type=radio][value=""]').forEach((i) => { i.checked = true; });
            form.querySelectorAll('input[type=hidden][name="cat_id[]"]').forEach((i) => i.remove());
            load(1);
            return;
        }
        const link = e.target.closest('[data-gm-shop-pagination] a[href]');
        if (link) {
            e.preventDefault();
            load(new URL(link.href).searchParams.get('page') || 1);
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });

    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') setPanel(false); });

    load(new URLSearchParams(location.search).get('page') || 1);
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\frontend\products\index.blade.php ENDPATH**/ ?>