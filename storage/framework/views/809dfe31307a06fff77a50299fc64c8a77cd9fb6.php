<!DOCTYPE html>
<html lang="en">
<?php $info = \App\Models\Information::first(); ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | <?php echo e($info->site_name ?? 'Admin Panel'); ?></title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --admin-accent: #15bf81;
            --admin-accent-hover: #10a871;
            --admin-dark: #111827;
            --admin-surface: #ffffff;
            --admin-bg: #f4f6fb;
            --admin-border: #e5e7eb;
            --admin-text: #1f2937;
            --admin-muted: #6b7280;
            --admin-radius: 16px;
        }
        
        * { box-sizing: border-box; }
        
        body, html {
            margin: 0; padding: 0; height: 100%;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--admin-bg);
        }
        
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .login-card {
            width: 100%;
            max-width: 440px;
            background: var(--admin-surface);
            border-radius: var(--admin-radius);
            box-shadow: 0 20px 60px rgba(17,24,39,.1);
            border: 1px solid var(--admin-border);
            overflow: hidden;
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--admin-dark) 0%, #1e293b 100%);
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
        }
        
        .login-logo {
            width: 72px; height: 72px;
            border-radius: 16px;
            background: var(--admin-surface);
            padding: 10px;
            margin: 0 auto 1.25rem;
            box-shadow: 0 8px 24px rgba(0,0,0,.15);
        }
        
        .login-header h2 { color: #fff; margin: 0; font-size: 1.5rem; font-weight: 700; }
        .login-header p { color: rgba(255,255,255,.6); margin: .5rem 0 0; font-size: .9375rem; }
        
        .login-body { padding: 2.5rem 2rem; }
        
        .form-group { margin-bottom: 1.25rem; }
        .form-label {
            display: block; font-weight: 500; color: var(--admin-text);
            margin-bottom: .5rem; font-size: .875rem;
        }
        
        .input-wrapper { position: relative; }
        .input-wrapper .input-icon {
            position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
            color: var(--admin-muted); font-size: 1.1rem; pointer-events: none;
            transition: color .2s;
        }
        .input-wrapper:focus-within .input-icon { color: var(--admin-accent); }
        
        .form-control {
            width: 100%; padding: .75rem 1rem .75rem 3rem;
            border: 1px solid var(--admin-border); border-radius: 10px;
            font-size: .9375rem; color: var(--admin-text); background: var(--admin-surface);
            transition: border-color .2s, box-shadow .2s;
        }
        .form-control:focus {
            outline: none; border-color: var(--admin-accent);
            box-shadow: 0 0 0 4px rgba(21,191,129,.15);
        }
        .form-control::placeholder { color: var(--admin-muted); }
        
        .form-options { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; }
        .form-check { display: flex; align-items: center; gap: .5rem; }
        .form-check-input {
            width: 18px; height: 18px; border: 1px solid var(--admin-border);
            border-radius: 4px; cursor: pointer; accent-color: var(--admin-accent);
        }
        .form-check-label { font-size: .875rem; color: var(--admin-text); cursor: pointer; }
        
        .forgot-link { font-size: .875rem; color: var(--admin-accent); text-decoration: none; }
        .forgot-link:hover { text-decoration: underline; }
        
        .btn-login {
            width: 100%; padding: .875rem; font-size: .9375rem; font-weight: 600;
            background: var(--admin-accent); color: #fff; border: none; border-radius: 10px;
            cursor: pointer; transition: background .2s, transform .1s, box-shadow .2s;
        }
        .btn-login:hover { background: var(--admin-accent-hover); transform: translateY(-1px); box-shadow: 0 8px 20px rgba(21,191,129,.3); }
        .btn-login:active { transform: translateY(0); }
        .btn-login:disabled { opacity: .6; cursor: not-allowed; }
        
        .alert {
            padding: .875rem 1rem; border-radius: 10px; margin-bottom: 1.25rem;
            font-size: .875rem; border: none;
        }
        .alert-danger { background: rgba(239,68,68,.1); color: #dc2626; }
        .alert-success { background: rgba(16,185,129,.1); color: #059669; }
        
        .login-footer { text-align: center; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--admin-border); }
        .login-footer p { margin: 0; font-size: .8125rem; color: var(--admin-muted); }
        .login-footer a { color: var(--admin-accent); text-decoration: none; font-weight: 500; }
        .login-footer a:hover { text-decoration: underline; }
        
        /* Back link */
        .back-link { display: inline-flex; align-items: center; gap: .5rem; margin-bottom: 1.5rem; color: var(--admin-muted); text-decoration: none; font-size: .875rem; }
        .back-link:hover { color: var(--admin-accent); }
        
        @media (max-width: 480px) {
            .login-wrapper { padding: 1rem; }
            .login-header, .login-body { padding: 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="<?php echo e($info->site_name ?? 'Logo'); ?>" class="login-logo">
                <h2><?php echo e($info->site_name ?? 'Admin Panel'); ?></h2>
                <p>Sign in to manage your store</p>
            </div>
            
            <div class="login-body">
                <a href="<?php echo e(route('front.home')); ?>" class="back-link" target="_blank">
                    <i class="mdi mdi-arrow-left"></i> Back to Store
                </a>
                
                <?php if(session()->has('success')): ?>
                    <div class="alert alert-success"><?php echo e(session()->get('success')); ?></div>
                <?php endif; ?>
                <?php if(session()->has('error')): ?>
                    <div class="alert alert-danger"><?php echo e(session()->get('error')); ?></div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0" style="padding-left: 1.25rem;">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <form method="post" action="<?php echo e(route('admin.postLogin')); ?>" id="loginForm">
                    <?php echo csrf_field(); ?>
                    
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <div class="input-wrapper">
                            <i class="mdi mdi-account input-icon"></i>
                            <input type="text" class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="username" name="username" placeholder="Enter your username" 
                                   value="<?php echo e(old('username')); ?>" required autocomplete="username">
                        </div>
                        <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block" style="margin-top: .375rem; font-size: .8125rem;"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="mdi mdi-lock input-icon"></i>
                            <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="password" name="password" placeholder="Enter your password" 
                                   required autocomplete="current-password">
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block" style="margin-top: .375rem; font-size: .8125rem;"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <div class="form-options">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <a href="<?php echo e(route('password.request')); ?>" class="forgot-link">Forgot Password?</a>
                    </div>
                    
                    <button type="submit" class="btn-login" id="loginBtn">
                        <span class="btn-text">Sign In</span>
                        <span class="btn-loader d-none"><i class="mdi mdi-loading mdi-spin"></i></span>
                    </button>
                </form>
                
                <div class="login-footer">
                    <p>Don't have an account? Contact your administrator.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Loading state on submit
        document.getElementById('loginForm').addEventListener('submit', function() {
            var btn = document.getElementById('loginBtn');
            btn.disabled = true;
            btn.querySelector('.btn-text').classList.add('d-none');
            btn.querySelector('.btn-loader').classList.remove('d-none');
        });
        
        // Auto-focus username
        document.getElementById('username').focus();
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Clothing Ecom\clothing-brand-ecommerce\resources\views/backend/auth/login.blade.php ENDPATH**/ ?>