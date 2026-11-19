<head>

<?php
 use App\Models\Information;
  $information = Information::first();
?>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title', $information->site_name); ?> — Modern Menswear</title>
    <meta name="robots" content="index, follow" />
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'GENTRY is a modern menswear destination. Shop considered shirting, tailoring, knitwear and everyday essentials crafted for the way you live.'); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#111111">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/svg+xml" href="<?php echo e(asset('uploads/img/'.$information->favicon)); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:opsz,wght@6..96,400;6..96,500;6..96,600&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <!-- CSS
    ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/vendor/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/vendor/font-awesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/vendor/flaticon/flaticon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/vendor/slick.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/vendor/slick-theme.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/vendor/jquery-ui.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/vendor/sal.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/vendor/magnific-popup.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/vendor/base.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/style.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/header.css?v=007')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/update.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/newstyle.css?v=1.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/mens.css?v=1.1')); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <?php echo $__env->yieldPushContent('css'); ?>
    <?php echo \App\Models\Information::value('tracking_code'); ?>

    <?php echo \App\Models\Information::value('pixel'); ?>

    <?php echo \App\Models\Information::value('search_console'); ?>

</head>
<?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/frontend/partials/head.blade.php ENDPATH**/ ?>