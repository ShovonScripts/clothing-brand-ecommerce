@extends('frontend.app')

@section('title', 'Shopping Bag — GENTRY')

@section('content')
@php
$cart = session()->get('cart', []);
$info = \App\Models\Information::first();
$currencySymbol = match($info->currency) {
    'BDT' => '৳',
    'Dollar' => '$',
    'Euro' => '€',
    'Rupee' => '₹',
    default => ''
};
$subtotal = 0;
$discount = 0;
foreach($cart as $item) {
    $subtotal += $item['price'] * $item['quantity'];
    $discount += ($item['discount'] ?? 0) * $item['quantity'];
}
$shipping = $subtotal >= 5000 ? 0 : 100; // Free over 5000
$total = $subtotal - $discount + $shipping;
@endphp

<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Shopping Bag'],
        ]"
    />

    <x-ui.section size="md">
        @if($cart->count())
            <div class="gm-cart-layout" style="display: grid; grid-template-columns: 1fr 380px; gap: var(--s-8); align-items: start;">

                {{-- Cart Items --}}
                <div class="gm-cart-items" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;">
                    <div class="gm-cart-header" style="display: flex; align-items: center; justify-content: space-between; padding: var(--s-4) var(--s-5); border-bottom: 1px solid var(--c-line);">
                        <h2 class="gm-cart-title" style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0;">{{ $cart->count() }} item{{ $cart->count() !== 1 ? 's' : '' }} in your bag</h2>
                        <a href="{{ route('front.carts.clearAll') }}" class="gm-cart-clear" style="font-size: var(--t-sm); color: var(--c-accent); text-decoration: none;" onclick="return confirm('Are you sure you want to clear your cart?')">Clear bag</a>
                    </div>

                    <div class="gm-cart-list">
                        @foreach($cart as $key => $item)
                            @php
                                $lineTotal = $item['price'] * $item['quantity'];
                                $maxQty = $item['is_stock'] ? ($item['stock'] ?? 99) : 99;
                            @endphp
                            <x-ui.cart-line
                                :id="$key"
                                :image="getImage('products', $item['image'])"
                                :name="$item['name']"
                                :href="route('front.products.show', [$item['product_id']])"
                                :variant="['Size' => $item['size'] ?? null, 'Color' => $item['color'] ?? null]"
                                :price="$item['price']"
                                :originalPrice="($item['discount'] ?? 0) > 0 ? ($item['price'] + $item['discount']) : null"
                                :quantity="$item['quantity']"
                                :maxQuantity="$maxQty"
                                :stock="$maxQty"
                                :onQuantityChange="true"
                                :onRemove="true"
                                wire:key="cart-line-{{ $key }}"
                            />
                        @endforeach
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="gm-cart-summary">
                    <x-ui.order-summary
                        :subtotal="$subtotal"
                        :shipping="$shipping"
                        :discount="$discount"
                        :total="$total"
                        :currency="$info->currency"
                        :freeShippingThreshold="5000"
                        variant="cart"
                        actionText="Proceed to Checkout"
                        :actionUrl="route('front.checkouts.index')"
                    />
                </div>
            </div>

            {{-- Continue Shopping --}}
            <div style="margin-top: var(--s-6); text-align: center;">
                <x-ui.button variant="ghost" size="md" href="{{ route('front.products.index') }}">Continue Shopping</x-ui.button>
            </div>
        @else
            <x-ui.empty-state
                type="cart"
                title="Your bag is empty"
                message="Looks like you haven't added anything yet. Start shopping to fill your bag."
                action="Start Shopping"
                :actionUrl="route('front.products.index')"
            />
        @endif
    </x-ui.section>
</main>

@push('scripts')
<script>
    (function() {
        // Quantity change handler
        document.addEventListener('quantity-change', function(e) {
            const { name, value } = e.detail;
            const variationId = name.replace('quantity_', '');
            const formData = new FormData();
            formData.append('quantity', value);
            formData.append('segment', '{{ request()->segment(1) }}');
            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ route("front.carts.edit", [":id"]) }}'.replace(':id', variationId), {
                method: 'POST',
                body: formData,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Update cart count
                    const countEls = document.querySelectorAll('.cart-count, .gm-cart-badge, #gm-sticky-count');
                    countEls.forEach(el => el.textContent = data.item);

                    // Update sidebar and details
                    if (data.html) {
                        const sidebar = document.getElementById('cart-dropdown');
                        if (sidebar) sidebar.innerHTML = data.html;
                    }
                    if (data.html2) {
                        const details = document.querySelector('.gm-cart-items');
                        if (details) {
                            // Re-render would be needed; for now reload page
                            window.location.reload();
                        }
                    }
                } else {
                    if (window.toastr) toastr.error(data.msg || 'Failed to update quantity');
                }
            })
            .catch(err => {
                console.error('Quantity update failed:', err);
                if (window.toastr) toastr.error('Something went wrong');
            });
        });

        // Remove item handler
        document.addEventListener('remove-cart-item', function(e) {
            const { variationId } = e.detail;
            const formData = new FormData();
            formData.append('segment', '{{ request()->segment(1) }}');
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'DELETE');

            fetch('{{ route("front.carts.destroy", [":id"]) }}'.replace(':id', variationId), {
                method: 'POST',
                body: formData,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const countEls = document.querySelectorAll('.cart-count, .gm-cart-badge, #gm-sticky-count');
                    countEls.forEach(el => el.textContent = data.item);
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

        // Cart form submissions (from cart-line component)
        document.querySelectorAll('.gm-cart-line').forEach(line => {
            const form = line.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    if (e.submitter?.name === 'quantity') return; // Handled by quantity-change
                });
            }
        });
    })();
</script>
@endpush