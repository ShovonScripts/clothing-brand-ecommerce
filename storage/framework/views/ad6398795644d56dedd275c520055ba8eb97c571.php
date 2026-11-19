

<?php $__env->startSection('title', 'Shop — GENTRY'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-wrapper">
    <div class="axil-breadcrumb-area">
        <div class="container-fluid">
            <ul class="axil-breadcrumb">
                <li class="axil-breadcrumb-item"><a href="<?php echo e(route('front.home')); ?>">Home</a></li>
                <li class="separator"></li>
                <li class="axil-breadcrumb-item active" aria-current="page">Shop</li>
            </ul>
        </div>
    </div>

    <div class="axil-shop-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <aside class="axil-shop-sidebar" id="gm-shop-sidebar">
                        <div class="sidebar-header d-lg-none">
                            <h5>Filters</h5>
                            <button class="sidebar-close filter-close-btn" type="button" aria-label="Close filters"><i class="fas fa-times"></i></button>
                        </div>

                        <div class="toggle-list product-categories active">
                            <h6 class="title">Category</h6>
                            <div class="shop-submenu">
                                <ul>
                                    <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="category <?php echo e(request('category_id') == $cat->id ? 'current-cat' : ''); ?>" data-value="<?php echo e($cat->id); ?>"><a><?php echo e($cat->name); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>

                        <?php if($types->count()): ?>
                        <div class="toggle-list product-categories active">
                            <h6 class="title">Brand</h6>
                            <div class="shop-submenu">
                                <ul>
                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="brand <?php echo e(request('brand_id') == $type->id ? 'current-cat' : ''); ?>" data-value="<?php echo e($type->id); ?>"><a><?php echo e($type->name); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="toggle-list product-size active">
                            <h6 class="title">Size</h6>
                            <div class="shop-submenu">
                                <ul>
                                    <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="size" data-value="<?php echo e($size->id); ?>"><a><?php echo e($size->title); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>

                        <a href="<?php echo e(route('front.products.index')); ?>" class="axil-btn gm-btn--ghost">Reset filters</a>
                    </aside>
                </div>

                <div class="col-lg-9 products-block">
                    <div class="axil-shop-top">
                        <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap:12px">
                            <p class="filter-results mb-0">The full collection</p>
                            <div class="d-flex align-items-center" style="gap:12px">
                                <button class="product-filter-mobile filter-toggle d-lg-none" type="button"><i class="fas fa-filter"></i> Filter</button>
                                <select class="single-select" aria-label="Sort products">
                                    <option value="desc" selected>Newest first</option>
                                    <option value="asc">Oldest first</option>
                                    <option value="name">Name A–Z</option>
                                    <option value="price_low">Price: low to high</option>
                                    <option value="price_high">Price: high to low</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row row--15" id="product_data"></div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        fetchData();

        $('li.category, li.brand').click(function () {
            $(this).toggleClass('current-cat');
            fetchData();
        });

        $('li.size').click(function () {
            $(this).toggleClass('chosen');
            fetchData();
        });

        $('select.single-select').change(function () {
            fetchData();
        });

        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetchData(page);
        });

        $(document).on('click', '.filter-toggle', function () {
            $('#gm-shop-sidebar').addClass('gm-open');
            $('body').addClass('gm-filter-open');
            if (!$('.gm-filter-backdrop').length) {
                $('body').append('<div class="gm-filter-backdrop"></div>');
            }
        });

        $(document).on('click', '.filter-close-btn, .gm-filter-backdrop', function () {
            $('#gm-shop-sidebar').removeClass('gm-open');
            $('body').removeClass('gm-filter-open');
            $('.gm-filter-backdrop').remove();
        });

        // Close sidebar on mobile after selecting a filter
        $(document).on('click', '.axil-shop-sidebar li.category a, .axil-shop-sidebar li.brand a, .axil-shop-sidebar li.size a', function () {
            if (window.innerWidth < 992) {
                $('#gm-shop-sidebar').removeClass('gm-open');
                $('body').removeClass('gm-filter-open');
                $('.gm-filter-backdrop').remove();
            }
        });
    });

    function fetchData(page) {
        var size_id = $('li.chosen').map(function () { return $(this).data('value'); }).get();
        var cat_id = $('li.category.current-cat').map(function () { return $(this).data('value'); }).get();
        var brand_id = $('li.brand.current-cat').map(function () { return $(this).data('value'); }).get();
        var q = $('input#search2').val();
        var shorting = $('select.single-select').val();

        $.ajax({
            type: 'GET',
            url: '<?php echo e(route("front.products.index")); ?>?page=' + (page || 1),
            data: { cat_id: cat_id, size_id: size_id, q: q, shorting: shorting, brand_id: brand_id },
            success: function (res) {
                $('div#product_data').html(res);
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/products/index.blade.php ENDPATH**/ ?>