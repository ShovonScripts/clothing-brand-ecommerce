@extends('frontend.app')

@section('title', 'My Wishlist — GENTRY')

@section('content')
<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Dashboard', 'url' => route('front.dashboard.index')],
            ['label' => 'Wishlist'],
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
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l-.06-.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06.06a1.65 1.65 0 0 0 .33-1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
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
                <div class="gm-dashboard-header" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: var(--s-3); margin-bottom: var(--s-6);">
                    <div>
                        <h1 style="font-size: var(--t-2xl); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);">My Wishlist</h1>
                        <p style="color: var(--c-ink-500); margin: 0;">{{ $wishlist->count() }} item{{ $wishlist->count() !== 1 ? 's' : '' }} saved</p>
                    </div>
                    @if($wishlist->count())
                        <form method="POST" action="{{ route('front.wishlist.clear') }}" style="margin: 0;" onsubmit="return confirm('Are you sure you want to clear your wishlist?')">
                            @csrf
                            <x-ui.button variant="ghost" size="sm" type="submit">Clear All</x-ui.button>
                        </form>
                    @endif
                </div>

                @if($wishlist->count())
                    <div class="gm-wishlist-grid" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;">
                        <x-ui.product-grid>
                            @foreach($wishlist as $item)
                                @php
                                    $product = $item->product;
                                    $data = getProductInfo($product);
                                @endphp
                                <x-ui.product-card
                                    :product="$product"
                                    :image="getImage('products', $product->image)"
                                    :name="$product->name"
                                    :price="$data['price']"
                                    :originalPrice="$data['discount_amount'] > 0 ? $data['old_price'] : null"
                                    :category="optional($product->category)->name"
                                    :badges="[['variant' => 'sale', 'label' => 'Sale']]"
                                    :href="route('front.products.show', [$product->id])"
                                    :wishlistId="'wishlist_' . $product->id"
                                    :inWishlist="true"
                                    :onRemove="true"
                                />
                            @endforeach
                        </x-ui.product-grid>
                    </div>

                    {{-- Move all to cart --}}
                    <div style="margin-top: var(--s-5); text-align: right;">
                        <form method="POST" action="{{ route('front.wishlist.moveAllToCart') }}">
                            @csrf
                            <x-ui.button variant="primary" size="md" type="submit">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                Move All to Bag
                            </x-ui.button>
                        </form>
                    </div>
                @else
                    <x-ui.empty-state
                        type="wishlist"
                        title="Your wishlist is empty"
                        message="Save items you love for later. They'll appear here."
                        action="Start Shopping"
                        :actionUrl="route('front.products.index')"
                    />
                @endif
            </div>
        </div>
    </x-ui.section>
</main>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Remove wishlist item handler
        document.addEventListener('remove-wishlist-item', function(e) {
            const { productId } = e.detail;
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('product_id', productId);

            fetch('{{ route("front.wishlist.remove", [":id"]) }}'.replace(':id', productId), {
                method: 'POST',
                body: formData,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (window.toastr) toastr.success(data.msg || 'Removed from wishlist');
                    window.location.reload();
                } else {
                    if (window.toastr) toastr.error(data.msg || 'Failed to remove item');
                }
            })
            .catch(err => {
                console.error('Remove failed:', err);
                if (window.toastr) toastr.error('Something went wrong');
            });
        });

        // Move all to cart
        document.querySelector('form[action*="moveAllToCart"]')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (window.toastr) toastr.success(data.msg || 'Items moved to cart');
                    window.location.reload();
                } else {
                    if (window.toastr) toastr.error(data.msg || 'Failed to move items');
                }
            })
            .catch(err => {
                console.error('Move failed:', err);
                if (window.toastr) toastr.error('Something went wrong');
            });
        });
    });
</script>
@endpush