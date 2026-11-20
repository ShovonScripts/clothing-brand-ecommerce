
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                    <li class="breadcrumb-item active">Settings</li>
                </ol>
            </div>
            <h4 class="page-title">Settings</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="<?php echo e(route('admin.roles.index')); ?>" class="btn btn-secondary">Back</a><br><br>
                 <?php if(Session::has('msg')): ?>
                    <div class="alert alert-success">
                        <strong ><?php echo e(Session::get('msg')); ?></strong>
                    </div>
                 <?php endif; ?>
                <form action="<?php echo e(route('admin.settings.update', [$information->id])); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="role">Site Name</strong>
                                <input type="text" id="site_name" class="form-control" name="site_name" placeholder="Site name..." value="<?php echo e($information->site_name); ?>">
                            </div>
                            <?php $__errorArgs = ['site_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

					                       <div class="col-md-6">
                        <div class="form-group">
                            <strong for="role">Site Logo</strong>
                            <input type="file" id="site_logo" class="form-control" name="site_logo" placeholder="Site logo...">
                        </div>
                        <div class="mt-2">
                            <img src="<?php echo e(asset('uploads/img/'.$information->site_logo)); ?>" height="100" width="100" id="preview_img"/>
                        </div>
                            <?php $__errorArgs = ['site_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div> 
					
					
					                       <div class="col-md-6">
                        <div class="form-group">
                            <strong for="role">Site Favicon</strong>
                            <input type="file" id="favicon" class="form-control" name="favicon" placeholder="Site Favicon...">
                        </div>
                        <div class="mt-2">
                            <img src="<?php echo e(asset('uploads/img/'.$information->favicon)); ?>" height="100" width="100" id="preview_img"/>
                        </div>
                            <?php $__errorArgs = ['favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
					
					                       <div class="col-md-6">
                        <div class="form-group">
                            <strong for="role">OG Images</strong>
                            <input type="file" id="og_images" class="form-control" name="og_images" placeholder="OG Images...">
                        </div>
                        <div class="mt-2">
                            <img src="<?php echo e(asset('uploads/img/'.$information->og_images)); ?>" height="100" width="100" id="preview_img"/>
                        </div>
                            <?php $__errorArgs = ['og_images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div> 
					
					
					
                    </div>   
                     <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="role">Site Phone</strong>
                                <input type="text" id="owner_phone" class="form-control" name="owner_phone" placeholder="Site phone..." value="<?php echo e($information->owner_phone); ?>">
                            </div>
                             <?php $__errorArgs = ['owner_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="role">Site Email</strong>
                                <input type="email" id="owner_email" class="form-control" name="owner_email" placeholder="Site email..." value="<?php echo e($information->owner_email); ?>">
                            </div>
                             <?php $__errorArgs = ['owner_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>   
                    </div>   
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="role">Site Address</strong>
                                <textarea name="address" id="address" rows="5" class="form-control" placeholder="Address..."><?php echo e($information->address); ?></textarea>
                            </div>
                             <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="role">Site Tracking Code</strong>
                                <textarea name="tracking_code" id="tracking_code" rows="5" class="form-control" placeholder="Site tracking code..."><?php echo e($information->tracking_code); ?></textarea>
                            </div>
                             <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="role">Facebook Pixel Setup Code</strong>
                                <textarea name="pixel" id="pixel" rows="5" class="form-control" placeholder="Facebook Pixel code..."><?php echo e($information->pixel); ?></textarea>
                            </div>
                             <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="role">Search Console Setup Code</strong>
                                <textarea name="search_console" id="search_console" rows="5" class="form-control" placeholder="Search Console code..."><?php echo e($information->search_console); ?></textarea>
                            </div>
                             <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                      <div class="col-md-6">
                            <div class="form-group">
                                <strong for="copyright">Copyright Text</strong>
                                <textarea name="copyright" id="copyright" rows="5" class="form-control" placeholder="Copyright"><?php echo e($information->copyright); ?></textarea>
                            </div>
                             <?php $__errorArgs = ['copyright'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                      <div class="col-md-6">
                            <div class="form-group">
                                <strong for="facebook">Facebook Link</strong>
                                <textarea name="facebook" id="facebook" rows="3" class="form-control" placeholder="Facebook Link"><?php echo e($information->facebook); ?></textarea>
                            </div>
                             <?php $__errorArgs = ['facebook'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                      <div class="col-md-6">
                            <div class="form-group">
                                <strong for="instagram">Instagram Link</strong>
                                <textarea name="instagram" id="instagram" rows="3" class="form-control" placeholder="Instagram Link"><?php echo e($information->instagram); ?></textarea>
                            </div>
                             <?php $__errorArgs = ['instagram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                      <div class="col-md-6">
                            <div class="form-group">
                                <strong for="youtube">Youtube Link</strong>
                                <textarea name="youtube" id="youtube" rows="3" class="form-control" placeholder="Youtube Link"><?php echo e($information->youtube); ?></textarea>
                            </div>
                             <?php $__errorArgs = ['youtube'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                      
                      <div class="col-md-4">
                            <div class="form-group">
                                <strong for="role">Recommend Product Show</strong>
                                <input type="text" id="recommend_num" class="form-control" name="recommend_num" placeholder="" value="<?php echo e($information->recommend_num); ?>">
                            </div>
                             <?php $__errorArgs = ['recommend_num'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                     <div class="col-md-4">
                            <div class="form-group">
                                <strong for="role">Best Offer Product Show</strong>
                                <input type="text" id="discount_num" class="form-control" name="discount_num" placeholder="" value="<?php echo e($information->discount_num); ?>">
                            </div>
                             <?php $__errorArgs = ['discount_num'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                      
                      <div class="col-md-4">
                            <div class="form-group">
                                <strong for="role">New Arrival Product Show</strong>
                                <input type="text" id="newarrival_num" class="form-control" name="newarrival_num" placeholder="" value="<?php echo e($information->newarrival_num); ?>">
                            </div>
                             <?php $__errorArgs = ['newarrival_num'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                      
                      
                    </div>
                  
                  <div class="row mb-2">
                    <!--<div class="col-md-3">-->
                    <!--        <div class="form-group">-->
                    <!--           <strong for="role">BKash Number</strong>-->
                    <!--           <input type="text" id="bkash_number" class="form-control" name="bkash_number" placeholder="Site phone..." value="<?php echo e($information->bkash_number); ?>"> -->
                    <!--         </div>-->
                    <!--         <?php $__errorArgs = ['bkash_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
                    <!--         <p class="text-danger">-->
                    <!--             <?php echo e($message); ?>-->
                    <!--         </p>-->
                    <!--        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
                    <!--    </div>-->
                    <!--<div class="col-md-3">-->
                    <!--        <div class="form-group">-->
                    <!--           <strong for="role">Nogod Number</strong>-->
                    <!--           <input type="text" id="nogod_number" class="form-control" name="nogod_number" placeholder="Site phone..." value="<?php echo e($information->nogod_number); ?>"> -->
                    <!--         </div>-->
                    <!--         <?php $__errorArgs = ['nogod'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
                    <!--         <p class="text-danger">-->
                    <!--             <?php echo e($message); ?>-->
                    <!--         </p>-->
                    <!--        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
                    <!--    </div>-->
                    <!--<div class="col-md-3">-->
                    <!--        <div class="form-group">-->
                    <!--           <strong for="role">Rocket Number</strong>-->
                    <!--           <input type="text" id="rocket_number" class="form-control" name="rocket_number" placeholder="Site phone..." value="<?php echo e($information->rocket_number); ?>"> -->
                    <!--         </div>-->
                    <!--         <?php $__errorArgs = ['rocket'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
                    <!--         <p class="text-danger">-->
                    <!--             <?php echo e($message); ?>-->
                    <!--         </p>-->
                    <!--        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
                    <!--    </div>-->
                    <!--<div class="col-md-3">-->
                    <!--        <div class="form-group">-->
                    <!--           <strong for="role">Paypal Account</strong>-->
                    <!--           <input type="text" id="paypal_account" class="form-control" name="paypal_account" placeholder="Site phone..." value="<?php echo e($information->paypal_account); ?>"> -->
                    <!--         </div>-->
                    <!--         <?php $__errorArgs = ['paypal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
                    <!--         <p class="text-danger">-->
                    <!--             <?php echo e($message); ?>-->
                    <!--         </p>-->
                    <!--        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
                    <!--    </div>-->
                    <!--<div class="col-md-3">-->
                    <!--        <div class="form-group">-->
                    <!--           <strong for="role">Stripe Account</strong>-->
                    <!--           <input type="text" id="stripe_account" class="form-control" name="stripe_account" placeholder="Site phone..." value="<?php echo e($information->stripe_account); ?>"> -->
                    <!--         </div>-->
                    <!--         <?php $__errorArgs = ['stripe_account'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
                    <!--         <p class="text-danger">-->
                    <!--             <?php echo e($message); ?>-->
                    <!--         </p>-->
                    <!--        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
                    <!--    </div>-->
                    
                  </div>
                  
                  
                  
                   <div class="row mb-2">
                    <!--<div class="col-md-3">-->
                    <!--        <div class="form-group">-->
                    <!--           <strong for="role">BKash Number</strong>-->
                    <!--            <select class="form-select" name="bkash">-->
                    <!--            <option value="1" <?php echo e($information->bkash == 1 ?'selected':''); ?> >On</option>                               -->
                    <!--            <option value="0" <?php echo e($information->bkash == 0 ?'selected':''); ?> >Off</option>                                -->
                    <!--           </select>-->
                    <!--         </div>-->
                    <!--         <?php $__errorArgs = ['bkash'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
                    <!--         <p class="text-danger">-->
                    <!--             <?php echo e($message); ?>-->
                    <!--         </p>-->
                    <!--        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
                    <!--    </div>-->
                    <!--<div class="col-md-3">-->
                    <!--        <div class="form-group">-->
                    <!--           <strong for="role">Nogod</strong>-->
                    <!--            <select class="form-select" name="nogod">-->
                    <!--            <option value="1" <?php echo e($information->nogod == 1 ?'selected':''); ?> >On</option>                               -->
                    <!--            <option value="0" <?php echo e($information->nogod == 0 ?'selected':''); ?> >Off</option>                                -->
                    <!--           </select>-->
                    <!--        </div>-->
                    <!--         <?php $__errorArgs = ['nogod'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
                    <!--         <p class="text-danger">-->
                    <!--             <?php echo e($message); ?>-->
                    <!--         </p>-->
                    <!--        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
                    <!--    </div>-->
                    <!--<div class="col-md-3">-->
                    <!--        <div class="form-group">-->
                    <!--           <strong for="role">Rocket</strong>-->
                    <!--            <select class="form-select" name="rocket">-->
                    <!--            <option value="1" <?php echo e($information->rocket == 1 ?'selected':''); ?>>On</option>                               -->
                    <!--            <option value="0" <?php echo e($information->rocket == 0 ?'selected':''); ?>>Off</option>                                -->
                    <!--           </select>-->
                    <!--        </div>-->
                    <!--         <?php $__errorArgs = ['rocket'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
                    <!--         <p class="text-danger">-->
                    <!--             <?php echo e($message); ?>-->
                    <!--         </p>-->
                    <!--        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
                    <!--    </div>-->
                    <!--<div class="col-md-3">-->
                    <!--        <div class="form-group">-->
                    <!--           <strong for="role">Paypal</strong>-->
                    <!--            <select class="form-select" name="paypal">-->
                    <!--            <option value="1" <?php echo e($information->paypal == 1 ?'selected':''); ?> >On</option>                               -->
                    <!--            <option value="0" <?php echo e($information->paypal == 0 ?'selected':''); ?> >Off</option>                                -->
                    <!--           </select>-->
                    <!--        </div>-->
                    <!--         <?php $__errorArgs = ['paypal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
                    <!--         <p class="text-danger">-->
                    <!--             <?php echo e($message); ?>-->
                    <!--         </p>-->
                    <!--        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
                    <!--    </div>-->
                     
                    <!-- <div class="col-md-3">-->
                    <!--        <div class="form-group">-->
                    <!--           <strong for="role">Stripe</strong>-->
                    <!--            <select class="form-select" name="stripe">-->
                    <!--            <option value="1" <?php echo e($information->stripe == 1 ?'selected':''); ?> >On</option>                               -->
                    <!--            <option value="0" <?php echo e($information->stripe == 0 ?'selected':''); ?> >Off</option>                                -->
                    <!--           </select>-->
                    <!--        </div>-->
                    <!--         <?php $__errorArgs = ['stripe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
                    <!--         <p class="text-danger">-->
                    <!--             <?php echo e($message); ?>-->
                    <!--         </p>-->
                    <!--        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
                    <!--    </div>-->
                     <div class="col-md-3">
                            <div class="form-group">
                               <strong for="role">Currency</strong>
                                <select class="form-select" name="currency">
                                <option value="BDT" <?php echo e($information->currency == 'BDT' ?'selected':''); ?> >BDT</option>   
                                <option value="Dollar" <?php echo e($information->currency == 'Dollar' ?'selected':''); ?> >Dollar</option>                               
                                <option value="Euro" <?php echo e($information->currency == 'Euro' ?'selected':''); ?> >Euro</option>  
                                <option value="Rupee" <?php echo e($information->currency == 'Rupee' ?'selected':''); ?> >Rupee</option>
                               </select>
                            </div>
                             <?php $__errorArgs = ['stripe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                  </div>
                  
                  <div class="row mb-2">
                    <div class="col-md-3">
                            <div class="form-group">
                               <strong for="role">Support Number 1</strong>
                               <input type="text" id="supp_num1" class="form-control" name="supp_num1" placeholder="Site phone..." value="<?php echo e($information->supp_num1); ?>">
                             </div>
                             <?php $__errorArgs = ['bkash'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    <div class="col-md-3">
                            <div class="form-group">
                               <strong for="role">Support Number 2</strong>
                                <input type="text" id="supp_num2" class="form-control" name="supp_num2" placeholder="Site phone..." value="<?php echo e($information->supp_num2); ?>">
                             </div>
                             <?php $__errorArgs = ['bkash'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    <div class="col-md-3">
                            <div class="form-group">
                               <strong for="role">Support Number 3</strong>
                                <input type="text" id="supp_num3" class="form-control" name="supp_num3" placeholder="Site phone..." value="<?php echo e($information->supp_num3); ?>">
                             </div>
                             <?php $__errorArgs = ['bkash'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    <div class="col-md-3">
                            <div class="form-group">
                               <strong for="role">Number Visible</strong>
                                <input type="text" id="number_visibility" class="form-control" name="number_visibility" placeholder="Visible Number..." value="<?php echo e($information->number_visibility); ?>">
                             </div>
                             <?php $__errorArgs = ['bkash'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <p class="text-danger">
                                 <?php echo e($message); ?>

                             </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <h5 class="text-danger mt-3">These fields only for Redx Courier Service</h5>
                    <div class="col-md-6">
                      <div class="form-group">
                        <strong for="redx_api_base_url">Redx API Base URL</strong>
                        <textarea name="redx_api_base_url" id="redx_api_base_url" rows="1" class="form-control" placeholder="https://sandbox.redx.com.bd/v1.0.0-beta"><?php echo e($information->redx_api_base_url); ?></textarea>
                      </div>
                      <?php $__errorArgs = ['redx_api_base_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger">
                        <?php echo e($message); ?>

                      </p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <strong for="redx_api_access_token">Redx API Access Token</strong>
                        <textarea name="redx_api_access_token" id="redx_api_access_token" rows="4" class="form-control" placeholder="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI3Nzc2MjAiLCJpYXQiOjE2NzI4MTgyMDIsImlzcyI6IkVyeEZSY2VuemNOMkZrcmdyYXBUM1p6ZXN4emx2NnBOIiwic2hvcF9pZCI6Nzc3NjIwLCJ1c2VyX2lkIjoxNjQzNDY0fQ.1PO9zwZ-Wgy7bgzMfJ414EiEdqVCnSDJoodNXe1NNOU"><?php echo e($information->redx_api_access_token); ?></textarea>
                      </div>
                      <?php $__errorArgs = ['redx_api_access_token'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger">
                        <?php echo e($message); ?>

                      </p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
               </div> 
                 <h5 class="text-danger mt-3">These fields only for Pathao Courier Service</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <strong for="pathao_api_base_url">Pathao API Base URL</strong>
                        <textarea name="pathao_api_base_url" id="pathao_api_base_url" rows="1" class="form-control" placeholder="https://sandbox.redx.com.bd/v1.0.0-beta">
                          <?php echo e($information->pathao_api_base_url); ?>

                        </textarea>
                      </div>
                      <?php $__errorArgs = ['pathao_api_base_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger">
                        <?php echo e($message); ?>

                      </p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <strong for="pathao_api_access_token">Pathao API Access Token</strong>
                        <textarea name="pathao_api_access_token" id="pathao_api_access_token" rows="4" class="form-control" placeholder="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI3Nzc2MjAiLCJpYXQiOjE2NzI4MTgyMDIsImlzcyI6IkVyeEZSY2VuemNOMkZrcmdyYXBUM1p6ZXN4emx2NnBOIiwic2hvcF9pZCI6Nzc3NjIwLCJ1c2VyX2lkIjoxNjQzNDY0fQ.1PO9zwZ-Wgy7bgzMfJ414EiEdqVCnSDJoodNXe1NNOU">
                          <?php echo e($information->pathao_api_access_token); ?>

                        </textarea>
                      </div>
                      <?php $__errorArgs = ['pathao_api_access_token'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger">
                        <?php echo e($message); ?>

                      </p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <strong for="pathao_store_id">Pathao API Store ID</strong>
                        <input type="text" name="pathao_store_id" id="pathao_store_id" value="<?php echo e($information->pathao_store_id); ?>" class="form-control" placeholder="Pathao store id">
                      </div>
                      <?php $__errorArgs = ['pathao_store_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger">
                        <?php echo e($message); ?>

                      </p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
               </div>
               
               <h5 class="text-danger mt-3">These fields only for Stead-Fast Courier Service</h5>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <strong for="pathao_api_base_url">Stead Fast API Base URL</strong>
                        <textarea name="steadfast_api_base_url" id="steadfast_api_base_url" rows="2" class="form-control" placeholder="https://sandbox.redx.com.bd/v1.0.0-beta"><?php echo e($information->steadfast_api_base_url); ?></textarea></div>
                      <?php $__errorArgs = ['steadfast_api_base_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger">
                        <?php echo e($message); ?>

                      </p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <strong for="pathao_api_access_token">Stead Fast API Key</strong>
                        <textarea name="steadfast_api_key" id="steadfast_api_key" rows="2" class="form-control" placeholder="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI3Nzc2MjAiLCJpYXQiOjE2NzI4MTgyMDIsImlzcyI6IkVyeEZSY2VuemNOMkZrcmdyYXBUM1p6ZXN4emx2NnBOIiwic2hvcF9pZCI6Nzc3NjIwLCJ1c2VyX2lkIjoxNjQzNDY0fQ.1PO9zwZ-Wgy7bgzMfJ414EiEdqVCnSDJoodNXe1NNOU"><?php echo e($information->steadfast_api_key); ?></textarea>
                      </div>
                      <?php $__errorArgs = ['pathao_api_access_token'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger">
                        <?php echo e($message); ?>

                      </p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <strong for="pathao_api_access_token">Stead Fast Secret Key</strong>
                        <textarea name="steadfast_secret_key" id="steadfast_secret_key" rows="2" class="form-control" placeholder="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI3Nzc2MjAiLCJpYXQiOjE2NzI4MTgyMDIsImlzcyI6IkVyeEZSY2VuemNOMkZrcmdyYXBUM1p6ZXN4emx2NnBOIiwic2hvcF9pZCI6Nzc3NjIwLCJ1c2VyX2lkIjoxNjQzNDY0fQ.1PO9zwZ-Wgy7bgzMfJ414EiEdqVCnSDJoodNXe1NNOU"><?php echo e($information->steadfast_secret_key); ?></textarea>
                      </div>
                      <?php $__errorArgs = ['steadfast_secret_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger">
                        <?php echo e($message); ?>

                      </p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div> 
               </div>
      
                    <hr>
                    <br>
                    <input type="submit" value="Update" class="btn btn-success">
                    <hr>
                </form>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div> <!-- end row -->
<?php $__env->stopSection(); ?> 

<?php $__env->startPush('js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
       $("#site_logo").change(function(e){
          let file = e.target.files[0];
          let temp = URL.createObjectURL(file);
          $("#preview_img").attr('src', temp);
       });
    });
  
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/informations/index.blade.php ENDPATH**/ ?>