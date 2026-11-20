@extends('frontend.app')

@section('title', 'Account Details — GENTRY')

@section('content')
<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Dashboard', 'url' => route('front.dashboard.index')],
            ['label' => 'Account Details'],
        ]"
    />

    <x-ui.section size="md">
        <div class="gm-dashboard-layout" style="display: grid; grid-template-columns: 280px 1fr; gap: var(--s-8);">
            {{-- Sidebar --}}
            <aside class="gm-dashboard-sidebar" style="position: sticky; top: calc(var(--header-h) + var(--s-4));">
                <div class="gm-dashboard-profile" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); margin-bottom: var(--s-4); text-align: center;">
                    <div class="gm-dashboard-avatar" style="width: 80px; height: 80px; border-radius: 50%; background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--s-3); color: var(--c-accent); font-size: var(--t-2xl); font-weight: 500; font-family: var(--f-display);">
                        {{ strtoupper(auth()->user()->first_name[0] ?? 'U') }}
                    </div>
                    <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>
                    <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: 0;">Member since {{ auth()->user()->created_at->format('F Y') }}</p>
                </div>

                <nav class="gm-dashboard-nav" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;" aria-label="Dashboard navigation">
                    <a href="{{ route('front.dashboard.index') }}" class="gm-dashboard-nav-item {{ request()->routeIs('front.dashboard.index') ? 'active' : '' }}" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); font-weight: 500; text-decoration: none; border-bottom: 1px solid var(--c-line); transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('front.orders.index') }}" class="gm-dashboard-nav-item {{ request()->routeIs('front.orders*') ? 'active' : '' }}" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); font-weight: 500; text-decoration: none; border-bottom: 1px solid var(--c-line); transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                        <span>Orders</span>
                    </a>
                    <a href="{{ route('front.wishlist.index') }}" class="gm-dashboard-nav-item {{ request()->routeIs('front.wishlist*') ? 'active' : '' }}" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); font-weight: 500; text-decoration: none; border-bottom: 1px solid var(--c-line); transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                        <span>Wishlist</span>
                    </a>
                    <a href="{{ route('front.account_details.index') }}" class="gm-dashboard-nav-item {{ request()->routeIs('front.account_details*') ? 'active' : '' }}" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); font-weight: 500; text-decoration: none; border-bottom: 1px solid var(--c-line); transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        <span>Account Details</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <button type="submit" form="logout-form" class="gm-dashboard-nav-item gm-dashboard-nav-item--logout" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-danger); font-size: var(--t-sm); font-weight: 500; background: none; border: none; width: 100%; text-align: left; cursor: pointer; transition: all var(--d-fast) var(--e-out);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span>Logout</span>
                    </button>
                </nav>
            </aside>

            {{-- Main Content --}}
            <div class="gm-dashboard-main">
                <div class="gm-dashboard-header" style="margin-bottom: var(--s-6);">
                    <h1 style="font-size: var(--t-2xl); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);">Account Details</h1>
                    <p style="color: var(--c-ink-500); margin: 0;">Manage your personal information and preferences</p>
                </div>

                {{-- Profile Information --}}
                <div class="gm-account-section" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-6); margin-bottom: var(--s-6);">
                    <header style="margin-bottom: var(--s-5); padding-bottom: var(--s-4); border-bottom: 1px solid var(--c-line);">
                        <h2 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);">Profile Information</h2>
                        <p style="color: var(--c-ink-500); margin: 0;">Update your personal details</p>
                    </header>

                    <form method="POST" action="{{ route('front.account_details.update') }}" class="gm-account-form" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="gm-form-row gm-form-row--2">
                            <x-ui.input
                                name="first_name"
                                label="First Name"
                                :value="auth()->user()->first_name"
                                required
                                :error="$errors->first('first_name')"
                                autocomplete="given-name"
                            />
                            <x-ui.input
                                name="last_name"
                                label="Last Name"
                                :value="auth()->user()->last_name"
                                required
                                :error="$errors->first('last_name')"
                                autocomplete="family-name"
                            />
                        </div>

                        <x-ui.input
                            name="username"
                            label="Username"
                            :value="auth()->user()->username"
                            required
                            :error="$errors->first('username')"
                            autocomplete="username"
                        />

                        <x-ui.input
                            name="email"
                            label="Email Address"
                            type="email"
                            :value="auth()->user()->email"
                            required
                            :error="$errors->first('email')"
                            autocomplete="email"
                        />

                        <x-ui.input
                            name="mobile"
                            label="Phone Number"
                            type="tel"
                            :value="auth()->user()->mobile"
                            required
                            :error="$errors->first('mobile')"
                            autocomplete="tel"
                        />

                        <x-ui.button
                            variant="primary"
                            size="md"
                            type="submit"
                        >
                            Save Changes
                        </x-ui.button>
                    </form>
                </div>

                {{-- Change Password --}}
                <div class="gm-account-section" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-6); margin-bottom: var(--s-6);">
                    <header style="margin-bottom: var(--s-5); padding-bottom: var(--s-4); border-bottom: 1px solid var(--c-line);">
                        <h2 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);">Change Password</h2>
                        <p style="color: var(--c-ink-500); margin: 0;">Update your password for security</p>
                    </header>

                    <form method="POST" action="{{ route('front.account_details.password') }}" class="gm-account-form" novalidate>
                        @csrf

                        <x-ui.input
                            name="current_password"
                            label="Current Password"
                            type="password"
                            required
                            :error="$errors->first('current_password')"
                            autocomplete="current-password"
                        />

                        <x-ui.input
                            name="password"
                            label="New Password"
                            type="password"
                            required
                            :error="$errors->first('password')"
                            autocomplete="new-password"
                            help="Use 8+ characters with a mix of letters, numbers & symbols"
                        />

                        <x-ui.input
                            name="password_confirmation"
                            label="Confirm New Password"
                            type="password"
                            required
                            :error="$errors->first('password_confirmation')"
                            autocomplete="new-password"
                        />

                        <x-ui.button
                            variant="primary"
                            size="md"
                            type="submit"
                        >
                            Update Password
                        </x-ui.button>
                    </form>
                </div>

                {{-- Address Book --}}
                <div class="gm-account-section" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-6); margin-bottom: var(--s-6);">
                    <header style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: var(--s-3); margin-bottom: var(--s-5); padding-bottom: var(--s-4); border-bottom: 1px solid var(--c-line);">
                        <div>
                            <h2 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);">Saved Addresses</h2>
                            <p style="color: var(--c-ink-500); margin: 0;">Manage your shipping addresses</p>
                        </div>
                        <x-ui.button
                            variant="secondary"
                            size="sm"
                        >
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            Add Address
                        </x-ui.button>
                    </header>

                    @if($addresses->count())
                        <div class="gm-address-list" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: var(--s-4);">
                            @foreach($addresses as $address)
                                <article class="gm-address-card" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-md); padding: var(--s-4); transition: box-shadow var(--d-base) var(--e-out);">
                                    <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: var(--s-3);">
                                        <div>
                                            <p style="font-weight: 500; color: var(--c-ink-900); margin: 0 0 var(--s-1);">{{ $address->name }}</p>
                                            @if($address->is_default)
                                                <x-ui.badge variant="info" size="xs">Default</x-ui.badge>
                                            @endif
                                        </div>
                                        <div style="display: flex; gap: var(--s-1);">
                                            <button type="button" class="gm-icon-btn gm-icon-btn--sm" aria-label="Edit address">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            </button>
                                            <button type="button" class="gm-icon-btn gm-icon-btn--sm gm-icon-btn--danger" aria-label="Delete address">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <address style="font-style: normal; color: var(--c-ink-700); line-height: var(--lh-base); margin-bottom: var(--s-3);">
                                        <p style="margin: 0 0 var(--s-1);">{{ $address->address }}</p>
                                        <p style="margin: 0 0 var(--s-1);">{{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}</p>
                                        <p style="margin: 0;">{{ $address->country }}</p>
                                        <p style="margin: var(--s-2) 0 0; font-size: var(--t-sm);">Phone: {{ $address->phone }}</p>
                                    </address>
                                    @if(!$address->is_default)
                                        <form method="POST" action="{{ route('front.account_details.address.default', $address->id) }}" style="margin: 0;">
                                            @csrf
                                            @method('PUT')
                                            <x-ui.button
                                                variant="ghost"
                                                size="sm"
                                                full
                                                type="submit"
                                            >
                                                Set as Default
                                            </x-ui.button>
                                        </form>
                                    @endif
                                </article>
                            @endforeach
                        </div>
                    @else
                        <x-ui.empty-state
                            type="default"
                            title="No saved addresses"
                            message="Add an address to speed up checkout."
                            action="Add Address"
                            actionUrl="#"
                        />
                    @endif
                </div>

                {{-- Communication Preferences --}}
                <div class="gm-account-section" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-6);">
                    <header style="margin-bottom: var(--s-5); padding-bottom: var(--s-4); border-bottom: 1px solid var(--c-line);">
                        <h2 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);">Communication Preferences</h2>
                        <p style="color: var(--c-ink-500); margin: 0;">Choose what emails you'd like to receive</p>
                    </header>

                    <div style="display: flex; flex-direction: column; gap: var(--s-4);">
                        <label class="gm-checkbox" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-4); background: var(--c-bg-2); border-radius: var(--r-md); cursor: pointer;">
                            <input type="checkbox" name="email_newsletter" checked class="gm-checkbox__input">
                            <span class="gm-checkbox__box" aria-hidden="true"></span>
                            <div style="flex: 1;">
                                <span class="gm-checkbox__label" style="font-weight: 500;">Newsletter & Promotions</span>
                                <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: var(--s-1) 0 0;">Receive updates about new arrivals, sales, and exclusive offers</p>
                            </div>
                        </label>

                        <label class="gm-checkbox" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-4); background: var(--c-bg-2); border-radius: var(--r-md); cursor: pointer;">
                            <input type="checkbox" name="email_order_updates" checked class="gm-checkbox__input">
                            <span class="gm-checkbox__box" aria-hidden="true"></span>
                            <div style="flex: 1;">
                                <span class="gm-checkbox__label" style="font-weight: 500;">Order Updates</span>
                                <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: var(--s-1) 0 0;">Get notifications about order status, shipping, and delivery</p>
                            </div>
                        </label>

                        <label class="gm-checkbox" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-4); background: var(--c-bg-2); border-radius: var(--r-md); cursor: pointer;">
                            <input type="checkbox" name="email_recommendations" class="gm-checkbox__input">
                            <span class="gm-checkbox__box" aria-hidden="true"></span>
                            <div style="flex: 1;">
                                <span class="gm-checkbox__label" style="font-weight: 500;">Personalized Recommendations</span>
                                <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: var(--s-1) 0 0;">Receive product recommendations based on your browsing history</p>
                            </div>
                        </label>
                    </div>

                    <div style="margin-top: var(--s-5); text-align: right;">
                        <x-ui.button
                            variant="primary"
                            size="md"
                        >
                            Save Preferences
                        </x-ui.button>
                    </div>
                </div>
            </div>
        </div>
    </x-ui.section>
</main>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Address modal handlers would go here
    });
</script>
@endpush