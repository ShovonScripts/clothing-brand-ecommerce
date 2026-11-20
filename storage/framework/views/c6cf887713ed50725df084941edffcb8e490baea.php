
<?php $__env->startSection('content'); ?>
    <style>
        th,
        td,
        h4,
        .pg_manage,
        .form-label {
            color: black !important;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                        <li class="breadcrumb-item active pg_manage">Page Manage</li>
                    </ol>
                </div>
                <h4 class="page-title">Landing Page Manage</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">


                        <div class="col-xl-8">


                        </div>
                        <div class="col-xl-4">
                            <div class="text-xl-end mt-xl-0 mt-2">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.create')): ?>
                                    <a href="<?php echo e(route('admin.landing_pages.create')); ?>" class="btn btn-danger mb-2 me-2"><i
                                            class="mdi mdi-basket me-1"></i> Add Landing Page</a>
                                <?php endif; ?>
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Page Title</th>
                                    <th>View Page</th>
                                    <th style="width: 125px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td> <?php echo e($key + 1); ?> </td>

                                        <td> <?php echo e($item->title1); ?> </td>
                                        <td> <a href="<?php echo e(route('front.landing_pages.view_page', ['id' => $item->id])); ?>">View Page</a>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.landing_pages.edit', [$item->id])); ?>"
                                                class="action-icon" target="_blank">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                            <a href="<?php echo e(route('admin.landing_pages.destroy', [$item->id])); ?>"
                                                class="delete action-icon"> <i class="mdi mdi-delete"></i></a>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views\backend\landing_pages\index.blade.php ENDPATH**/ ?>