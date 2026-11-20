<!DOCTYPE html>
<html lang="en">
@php $info = \App\Models\Information::first(); @endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | {{ $info->site_name ?? 'GENTRY' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Bodoni+Moda:opsz,wght@6..96,400;6..96,500;6..96,600&display=swap" rel="stylesheet">

    @vite(['resources/scss/admin.scss', 'resources/js/app.js'])
</head>

<body class="gm-admin-login-body">
    <div class="gm-admin-login-wrapper">
        <div class="gm-admin-login-card">
            <div class="gm-admin-login-header">
                <a href="{{ route('front.home') }}" target="_blank" class="gm-admin-login-logo" aria-label="{{ $info->site_name ?? 'GENTRY' }}">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ $info->site_name ?? 'GENTRY' }}" height="48">
                </a>
                <h1 style="font-size: var(--t-2xl); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);">Welcome back</h1>
                <p style="color: var(--c-ink-500); margin: 0;">Sign in to manage your store</p>
            </div>

            <div class="gm-admin-login-body">
                <a href="{{ route('front.home') }}" target="_blank" class="gm-admin-login-back" style="display: inline-flex; align-items: center; gap: var(--s-2); color: var(--c-ink-500); font-size: var(--t-sm); text-decoration: none; margin-bottom: var(--s-5);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    Back to Storefront
                </a>

                @if(session()->has('success'))
                    <x-ui.alert variant="success" dismissible>{{ session()->get('success') }}</x-ui.alert>
                @endif
                @if(session()->has('error'))
                    <x-ui.alert variant="danger" dismissible>{{ session()->get('error') }}</x-ui.alert>
                @endif
                @if($errors->any())
                    <x-ui.alert variant="danger" dismissible>
                        <ul style="margin: 0; padding-inline-start: var(--s-4);">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </x-ui.alert>
                @endif

                <form method="POST" action="{{ route('admin.postLogin') }}" class="gm-admin-login-form" novalidate>
                    @csrf

                    <x-ui.input
                        name="username"
                        label="Username"
                        type="text"
                        placeholder="Enter your username"
                        required
                        :error="$errors->first('username')"
                        autocomplete="username"
                        size="lg"
                        icon='<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>'
                    />

                    <x-ui.input
                        name="password"
                        label="Password"
                        type="password"
                        placeholder="Enter your password"
                        required
                        :error="$errors->first('password')"
                        autocomplete="current-password"
                        size="lg"
                        icon='<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>'
                    />

                    <div style="display: flex; align-items: center; justify-content: space-between; margin: var(--s-4) 0;">
                        <label class="gm-checkbox" style="font-size: var(--t-sm);">
                            <input type="checkbox" name="remember" class="gm-checkbox__input" wire:model="form.remember">
                            <span class="gm-checkbox__box" aria-hidden="true"></span>
                            <span class="gm-checkbox__label">Remember me</span>
                        </label>
                        <a href="{{ route('password.request') }}" style="color: var(--c-accent); font-size: var(--t-sm); text-decoration: none;">Forgot password?</a>
                    </div>

                    <x-ui.button
                        variant="primary"
                        size="lg"
                        full
                        type="submit"
                        :loading="$wire.loggingIn"
                    >
                        Sign In
                    </x-ui.button>
                </form>

                <p style="text-align: center; margin-top: var(--s-5); color: var(--c-ink-500); font-size: var(--t-sm);">
                    Don't have access? Contact your administrator.
                </p>
            </div>
        </div>
    </div>
</body>
</html>