@extends('frontend.app')

@section('title', 'Create Account — GENTRY')

@section('content')
<main class="main-wrapper">
    <x-ui.section size="xl">
        <div style="max-width: 480px; margin: 0 auto;">
            <div class="gm-auth-card" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-8);">
                <header class="gm-auth-header" style="text-align: center; margin-bottom: var(--s-6);">
                    <a href="{{ route('front.home') }}" class="gm-auth-logo" style="display: inline-block; margin-bottom: var(--s-4);" aria-label="GENTRY">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
                    </a>
                    <h1 style="font-size: var(--t-2xl); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);">Create your account</h1>
                    <p style="color: var(--c-ink-500); margin: 0;">Join GENTRY for faster checkout & order tracking</p>
                </header>

                <form method="POST" action="{{ route('front.register') }}" class="gm-auth-form" novalidate>
                    @csrf

                    <div class="gm-form-row gm-form-row--2">
                        <x-ui.input
                            name="first_name"
                            label="First Name"
                            placeholder="John"
                            required
                            :error="$errors->first('first_name')"
                            autocomplete="given-name"
                        />
                        <x-ui.input
                            name="last_name"
                            label="Last Name"
                            placeholder="Doe"
                            required
                            :error="$errors->first('last_name')"
                            autocomplete="family-name"
                        />
                    </div>

                    <x-ui.input
                        name="username"
                        label="Username"
                        placeholder="johndoe"
                        required
                        :error="$errors->first('username')"
                        autocomplete="username"
                    />

                    <x-ui.input
                        name="mobile"
                        label="Phone Number"
                        type="tel"
                        placeholder="01XXXXXXXXX"
                        required
                        :error="$errors->first('mobile')"
                        autocomplete="tel"
                    />

                    <x-ui.input
                        name="email"
                        label="Email Address"
                        type="email"
                        placeholder="john@example.com"
                        required
                        :error="$errors->first('email')"
                        autocomplete="email"
                    />

                    <x-ui.input
                        name="password"
                        label="Password"
                        type="password"
                        placeholder="At least 8 characters"
                        required
                        :error="$errors->first('password')"
                        autocomplete="new-password"
                        help="Use 8+ characters with a mix of letters, numbers & symbols"
                    />

                    <x-ui.input
                        name="password_confirmation"
                        label="Confirm Password"
                        type="password"
                        placeholder="Re-enter password"
                        required
                        :error="$errors->first('password_confirmation')"
                        autocomplete="new-password"
                    />

                    <div style="display: flex; align-items: flex-start; gap: var(--s-2); margin: var(--s-4) 0;">
                        <input type="checkbox" name="terms" id="terms" class="gm-checkbox__input" required wire:model="form.terms" style="margin-top: 2px;">
                        <label for="terms" class="gm-checkbox__label" style="font-size: var(--t-sm); line-height: var(--lh-base);">
                            I agree to the <a href="{{ route('front.terms') }}" style="color: var(--c-accent);">Terms of Service</a> and <a href="{{ route('front.privacy') }}" style="color: var(--c-accent);">Privacy Policy</a>
                        </label>
                    </div>

                    <x-ui.button
                        variant="primary"
                        size="lg"
                        full
                        type="submit"
                        :loading="$wire.registering"
                    >
                        Create Account
                    </x-ui.button>
                </form>

                <div class="gm-auth-divider" style="display: flex; align-items: center; gap: var(--s-3); margin: var(--s-6) 0;">
                    <div style="flex: 1; height: 1px; background: var(--c-line);"></div>
                    <span style="font-size: var(--t-xs); color: var(--c-ink-300); text-transform: uppercase; letter-spacing: var(--ls-wide);">Or continue with</span>
                    <div style="flex: 1; height: 1px; background: var(--c-line);"></div>
                </div>

                <div style="display: flex; flex-direction: column; gap: var(--s-2);">
                    <x-ui.button
                        variant="ghost"
                        size="md"
                        full
                        type="button"
                        wire:click="registerWithGoogle"
                    >
                        <svg width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"></path><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"></path><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"></path><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"></path></svg>
                        Continue with Google
                    </x-ui.button>

                    <x-ui.button
                        variant="ghost"
                        size="md"
                        full
                        type="button"
                        wire:click="registerWithFacebook"
                    >
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path></svg>
                        Continue with Facebook
                    </x-ui.button>
                </div>

                <p class="gm-auth-footer" style="text-align: center; margin-top: var(--s-6); color: var(--c-ink-500); font-size: var(--t-sm);">
                    Already have an account? <a href="{{ route('login') }}" style="color: var(--c-accent); font-weight: 500;">Sign in</a>
                </p>
            </div>
        </div>
    </x-ui.section>
</main>
@endsection