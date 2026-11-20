<!DOCTYPE html>
<html lang="en">
<?php $info = \App\Models\Information::first(); ?>
<head>
        <meta charset="utf-8" />
        <title><?php echo e($info->site_name ?? 'Admin Panel'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Admin Panel" name="description" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.ico')); ?>">

        <!-- Font: Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- third party css -->
        <link href="<?php echo e(asset('backend/css/vendor/jquery-jvectormap-1.2.2.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- App css -->
        <link href="<?php echo e(asset('backend/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('backend/css/app-creative.min.css')); ?>" rel="stylesheet" type="text/css" id="app-style" />
        <!-- Custom Admin UI overrides -->
        <link href="<?php echo e(asset('backend/css/admin-ui.css')); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

        <?php echo $__env->yieldPushContent('css'); ?>

    </head>

    <body class="loading" data-layout="detached" data-layout-color="light" data-rightbar-onstart="false">
        <!-- Topbar Start -->
        <div class="navbar-custom topnav-navbar">
            <div class="container-fluid">
                <!-- LOGO -->
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="topnav-logo">
                    <span class="topnav-logo-lg">
                        <img src="<?php echo e(asset('images/logo.png')); ?>" alt="<?php echo e($info->site_name ?? 'Logo'); ?>" height="36">
                    </span>
                    <span class="topnav-logo-sm">
                        <img src="<?php echo e(asset('images/logo.png')); ?>" alt="" height="28">
                    </span>
                </a>

                <ul class="list-unstyled topbar-menu float-end mb-0">

                    <li class="dropdown notification-list d-xl-none">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="dripicons-search noti-icon"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                            <form class="p-3">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Search">
                            </form>
                        </div>
                    </li>

                    <li class="notification-list">
                        <a class="nav-link" href="<?php echo e(route('front.home')); ?>" target="_blank" title="View Store">
                            <i class="dripicons-home noti-icon"></i>
                        </a>
                    </li>
                   
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="dripicons-user noti-icon"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome, <?php echo e(auth()->user()->first_name ?? 'Admin'); ?>!</h6>
                            </div>
                            <a href="<?php echo e(route('admin.profile')); ?>" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-circle me-1"></i><span>My Account</span>
                            </a>                            
                            <a href="<?php echo e(route('admin.password')); ?>" class="dropdown-item notify-item">
                                <i class="mdi mdi-key-change me-1"></i><span>Change Password</span>
                            </a>
                            <a href="<?php echo e(route('admin.settings.index')); ?>" class="dropdown-item notify-item">
                                <i class="mdi mdi-cog me-1"></i><span>Settings</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item notify-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-logout me-1"></i><span>Logout</span>
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </li>

                </ul>
                <a class="button-menu-mobile disable-btn">
                    <div class="lines"><span></span><span></span><span></span></div>
                </a>
            </div>
        </div>
        <!-- end Topbar -->
        
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- Begin page -->
            <div class="wrapper">
                <!-- ========== Left Sidebar Start ========== -->
                <div class="leftside-menu leftside-menu-detached">
                    <div class="leftbar-user">
                        <a href="javascript: void(0);">
                            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" height="42" style="border-radius: 50%; border: 2px solid var(--admin-accent); object-fit: cover;">
                            <span class="leftbar-user-name"><?php echo e(auth()->user()->first_name ?? 'Admin'); ?></span>                   
                            <span class="leftbar-user-name"><?php echo e(auth()->user()->username ?? ''); ?></span>                 
                        </a>
                    </div>
                    <!--- Sidemenu -->
                    <?php echo $__env->make('backend.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="clearfix"></div>
                </div>
                <!-- Left Sidebar End -->

                <div class="content-page">
                    <div class="content">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div> <!-- End Content -->

                    <!-- Footer Start -->
                    <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    &copy; <?php echo e(date('Y')); ?> <?php echo e($info->site_name ?? 'Admin Panel'); ?>. All rights reserved.
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end footer-links d-none d-md-block">
                                        <a href="javascript: void(0);" style="color: var(--admin-muted);">About</a>
                                        <a href="javascript: void(0);" style="color: var(--admin-muted);" class="ms-3">Support</a>
                                        <a href="javascript: void(0);" style="color: var(--admin-muted);" class="ms-3">Contact</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- end Footer -->

                </div> <!-- content-page -->

            </div> <!-- end wrapper-->
        </div>
        <!-- END Container -->

        <!-- Right Sidebar - HIDDEN -->
        <div class="end-bar" style="display:none;"></div>
        <div class="rightbar-overlay" style="display:none;"></div>

        <div class="modal fade" id="common_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>

        <?php echo $__env->make('backend.partials.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Auto-expand active sidebar group -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var activeLink = document.querySelector('.side-nav-second-level .active a');
            if (activeLink) {
                var collapse = activeLink.closest('.collapse');
                if (collapse) {
                    var bsCollapse = new bootstrap.Collapse(collapse, { toggle: true });
                }
                activeLink.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        });
        </script>
        
    </body>
</html><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\app.blade.php ENDPATH**/ ?>