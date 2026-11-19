

<?php $__env->startSection('title', 'GENTRY — Modern Menswear'); ?>

<?php $__env->startSection('content'); ?>
<?php $information = \App\Models\Information::first(); ?>
<main class="main-wrapper" id="top">

    
    <section class="gm-hero">
        <?php if($sliders->count()): ?>
        <div id="gmHero" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6500">
            <div class="carousel-inner">
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                    <div class="gm-hero-media">
                        <img src="<?php echo e(getImage('sliders', $s->image)); ?>" alt="<?php echo e($s->title ?: 'Gentry collection'); ?>">
                    </div>
                    <div class="container-fluid">
                        <div class="gm-hero-content">
                            <span class="gm-hero-eyebrow">Autumn / Winter Collection</span>
                            <h1 class="gm-hero-title"><?php echo e($s->title ?: 'The New Tailoring'); ?></h1>
                            <p class="gm-hero-text"><?php echo e($s->description ?: 'Considered layers, refined textures and a sharper silhouette — built for the everyday.'); ?></p>
                            <div class="gm-hero-actions">
                                <a href="<?php echo e($s->link ?: route('front.products.index')); ?>" class="gm-btn">Shop the collection</a>
                                <a href="<?php echo e(route('front.aboutUs')); ?>" class="gm-btn gm-btn--light">Our story</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#gmHero" data-bs-slide="prev" aria-label="Previous slide">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#gmHero" data-bs-slide="next" aria-label="Next slide">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
            <?php if($sliders->count() > 1): ?>
            <div class="gm-hero-indicators">
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button type="button" data-bs-target="#gmHero" data-bs-slide-to="<?php echo e($key); ?>" class="<?php echo e($key == 0 ? 'active' : ''); ?>" aria-label="Slide <?php echo e($key + 1); ?>"></button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="gm-hero-media">
                    <img src="<?php echo e(asset('sliders/mens-hero-1.jpg')); ?>" alt="Gentry collection">
                </div>
                <div class="container-fluid">
                    <div class="gm-hero-content">
                        <span class="gm-hero-eyebrow">Autumn / Winter Collection</span>
                        <h1 class="gm-hero-title">The New Tailoring</h1>
                        <p class="gm-hero-text">Considered layers, refined textures and a sharper silhouette — built for the everyday.</p>
                        <div class="gm-hero-actions">
                            <a href="<?php echo e(route('front.products.index')); ?>" class="gm-btn">Shop the collection</a>
                            <a href="<?php echo e(route('front.aboutUs')); ?>" class="gm-btn gm-btn--light">Our story</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </section>

    
    <?php if($cats->count()): ?>
    <section class="gm-section gm-section--tight">
        <div class="container-fluid">
            <div class="gm-section-head">
                <div>
                    <span class="gm-eyebrow">Shop by category</span>
                    <h2 class="gm-title">Built for every day</h2>
                </div>
                <a href="<?php echo e(route('front.products.index')); ?>" class="gm-link">View all <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="gm-cats">
                <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('front.products.index')); ?>?category_id=<?php echo e($cat->id); ?>" class="gm-cat">
                    <div class="gm-cat-media">
                        <img src="<?php echo e(getImage('categories', $cat->image)); ?>" alt="<?php echo e($cat->name); ?>" loading="lazy">
                    </div>
                    <div class="gm-cat-content">
                        <h3 class="gm-cat-title"><?php echo e($cat->name); ?></h3>
                        <span class="gm-cat-count"><?php echo e($cat->products_count ?? 0); ?> items</span>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    
    <?php if($newArrivals->count()): ?>
    <section class="gm-section gm-product-area bg-color-white">
        <div class="container-fluid">
            <div class="gm-section-head">
                <div>
                    <span class="gm-eyebrow">New in</span>
                    <h2 class="gm-title">Fresh arrivals</h2>
                </div>
                <a href="<?php echo e(route('front.products.index')); ?>?shorting=desc" class="gm-link">View all <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="gm-product-grid" data-gm-product-grid>
                <?php $__currentLoopData = $newArrivals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('frontend.products.partials.product_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    
    <?php if($saleProducts->count()): ?>
    <section class="gm-section gm-product-area">
        <div class="container-fluid">
            <div class="gm-section-head">
                <div>
                    <span class="gm-eyebrow">Sale</span>
                    <h2 class="gm-title">Seasonal offers</h2>
                </div>
                <a href="<?php echo e(route('front.discountProduct')); ?>" class="gm-link">View all <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="gm-product-grid" data-gm-product-grid>
                <?php $__currentLoopData = $saleProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('frontend.products.partials.product_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    
    <?php if($recommended->count()): ?>
    <section class="gm-section gm-product-area bg-color-white">
        <div class="container-fluid">
            <div class="gm-section-head">
                <div>
                    <span class="gm-eyebrow">Editor's pick</span>
                    <h2 class="gm-title">Recommended for you</h2>
                </div>
                <a href="<?php echo e(route('front.products.index')); ?>" class="gm-link">View all <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="gm-product-grid" data-gm-product-grid>
                <?php $__currentLoopData = $recommended; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('frontend.products.partials.product_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    
    <section class="gm-section gm-values" aria-labelledby="gm-values-title">
        <div class="container-fluid">
            <h2 id="gm-values-title" class="gm-title gm-visually-hidden">Our promise</h2>
            <div class="gm-values-grid">
                <article class="gm-value">
                    <div class="gm-value-icon">
                        <i class="fas fa-truck" aria-hidden="true"></i>
                    </div>
                    <h3 class="gm-value-title">Free delivery</h3>
                    <p class="gm-value-text">On orders over <?php echo e($information->currency_symbol ?? '৳'); ?>5,000</p>
                </article>
                <article class="gm-value">
                    <div class="gm-value-icon">
                        <i class="fas fa-undo" aria-hidden="true"></i>
                    </div>
                    <h3 class="gm-value-title">Easy returns</h3>
                    <p class="gm-value-text">14 days, no questions</p>
                </article>
                <article class="gm-value">
                    <div class="gm-value-icon">
                        <i class="fas fa-shield-alt" aria-hidden="true"></i>
                    </div>
                    <h3 class="gm-value-title">Secure payment</h3>
                    <p class="gm-value-text">Trusted & encrypted</p>
                </article>
                <article class="gm-value">
                    <div class="gm-value-icon">
                        <i class="fas fa-headset" aria-hidden="true"></i>
                    </div>
                    <h3 class="gm-value-title">Support</h3>
                    <p class="gm-value-text">Mon–Fri, 9–6</p>
                </article>
            </div>
        </div>
    </section>

</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var hero = document.getElementById('gmHero');
        if (hero && window.bootstrap && bootstrap.Carousel) {
            new bootstrap.Carousel(hero, { interval: 6500, ride: 'carousel', touch: true });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/home.blade.php ENDPATH**/ ?>