@extends('frontend.app')

@section('title', 'Checkout — GENTRY')

@section('content')
@php
use App\Models\Information;
use App\Models\BanglaText;
$info = Information::first();
$bangla_text = BanglaText::first();
$coupon_visibility = $info->coupon_visibility;

$cart = session()->get('cart', []);
$subtotal = 0;
$discount = 0;
foreach($cart as $item) {
    $subtotal += $item['price'] * $item['quantity'];
    $discount += ($item['discount'] ?? 0) * $item['quantity'];
}

$charges = $charges ?? collect();
$hasNonFreeShipping = false;
foreach($cart as $item) {
    if (empty($item['is_free_shipping'])) {
        $hasNonFreeShipping = true;
        break;
    }
}

$selectedChargeId = old('delivery_charge_id', $hasNonFreeShipping ? $charges->first()?->id : 0);
$selectedCharge = $charges->firstWhere('id', $selectedChargeId);
$chargeAmount = $selectedCharge ? $selectedCharge->amount : 0;

$couponDiscount = getCouponDiscount() ?? 0;
$total = $subtotal - $discount - $couponDiscount + $chargeAmount;
$currencySymbol = match($info->currency) {
    'BDT' => '৳',
    'Dollar' => '$',
    'Euro' => '€',
    'Rupee' => '₹',
    default => ''
};
@endphp

<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Shopping Bag', 'url' => route('front.carts.index')],
            ['label' => 'Checkout'],
        ]"
    />

    <x-ui.section size="md">
        <div class="gm-checkout-layout" style="display: grid; grid-template-columns: 1fr 420px; gap: var(--s-8); align-items: start;">

            {{-- Checkout Form --}}
            <div class="gm-checkout-form-wrapper">
                <form method="POST" action="{{ route('front.checkouts.store') }}" id="checkout_form" class="gm-checkout-form" novalidate>
                    @csrf

                    {{-- Contact Information --}}
                    <section class="gm-checkout-section" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); margin-bottom: var(--s-5);">
                        <header style="padding-bottom: var(--s-4); margin-bottom: var(--s-4); border-bottom: 1px solid var(--c-line);">
                            <h2 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0;">{{ $bangla_text->checkout_form_top_text ?? 'Contact Information' }}</h2>
                        </header>

                        <div class="gm-form-row gm-form-row--2" style="margin-bottom: var(--s-4);">
                            <x-ui.input
                                name="first_name"
                                label="{{ $bangla_text->name_text ?? 'Full Name' }}"
                                placeholder="John Doe"
                                required
                                :error="$errors->first('first_name')"
                                wire:model="form.first_name"
                            />
                            <x-ui.input
                                name="mobile"
                                label="{{ $bangla_text->mobile_text ?? 'Mobile Number' }}"
                                type="tel"
                                placeholder="01XXXXXXXXX"
                                required
                                :error="$errors->first('mobile')"
                                wire:model="form.mobile"
                            />
                        </div>

                        <x-ui.input
                            name="shipping_address"
                            label="{{ $bangla_text->address_text ?? 'Shipping Address' }}"
                            placeholder="House/Flat, Road, Area, City"
                            required
                            :error="$errors->first('shipping_address')"
                            wire:model="form.shipping_address"
                        />

                        <input type="hidden" name="ip_address" id="ip_address" value="">
                    </section>

                    {{-- Shipping Method --}}
                    <section class="gm-checkout-section" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); margin-bottom: var(--s-5);">
                        <header style="padding-bottom: var(--s-4); margin-bottom: var(--s-4); border-bottom: 1px solid var(--c-line);">
                            <h2 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0;">Delivery Method</h2>
                        </header>

                        @if($hasNonFreeShipping)
                            <div class="gm-shipping-options" style="display: flex; flex-direction: column; gap: var(--s-3);">
                                @foreach($charges as $charge)
                                    <label class="gm-shipping-option" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-4); border: 1px solid var(--c-line); border-radius: var(--r-md); cursor: pointer; transition: all var(--d-fast) var(--e-out);" wire:click="$set('form.delivery_charge_id', {{ $charge->id }})">
                                        <input type="radio"
                                            name="delivery_charge_id"
                                            value="{{ $charge->id }}"
                                            class="gm-radio__input"
                                            @if($charge->id == $selectedChargeId) checked @endif
                                            wire:model="form.delivery_charge_id"
                                            data-charge="{{ $charge->amount }}"
                                        >
                                        <span class="gm-radio__box" aria-hidden="true"></span>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 500; color: var(--c-ink-900);">{{ $charge->title }}</div>
                                            <div style="font-size: var(--t-sm); color: var(--c-ink-500);">{{ $currencySymbol }} {{ number_format($charge->amount, 2) }}</div>
                                        </div>
                                        <span style="font-weight: 600; color: var(--c-ink-900); font-family: var(--f-display);">{{ $currencySymbol }} {{ number_format($charge->amount, 2) }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @else
                            <div class="gm-alert gm-alert--success" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-4);">
                                <svg class="gm-alert__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <div>
                                    <strong>Free Shipping</strong>
                                    <p style="margin: 0; font-size: var(--t-sm);">Your order qualifies for complimentary delivery.</p>
                                </div>
                            </div>
                            <input type="hidden" name="delivery_charge_id" value="0">
                        @endif
                    </section>

                    {{-- Coupon --}}
                    @if($coupon_visibility == '1')
                        <section class="gm-checkout-section" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); margin-bottom: var(--s-5);">
                            <header style="padding-bottom: var(--s-4); margin-bottom: var(--s-4); border-bottom: 1px solid var(--c-line);">
                                <h2 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0; display: flex; align-items: center; gap: var(--s-2);">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path><path d="M8 12h8"></path><path d="M12 8v8"></path></svg>
                                    Have a coupon?
                                </h2>
                            </header>
                            <div class="gm-coupon-form" style="display: flex; gap: var(--s-2); flex-wrap: wrap;">
                                <x-ui.input
                                    name="coupon_code"
                                    placeholder="Enter coupon code"
                                    wire:model="form.coupon_code"
                                />
                                <x-ui.button
                                    variant="secondary"
                                    type="button"
                                    wire:click="applyCoupon"
                                    :loading="$wire.applyingCoupon"
                                >
                                    Apply
                                </x-ui.button>
                            </div>
                            @if($errors->has('coupon_code'))
                                <p class="gm-error-text" style="margin-top: var(--s-2);">{{ $errors->first('coupon_code') }}</p>
                            @endif
                        </section>
                    @endif

                    {{-- Payment Method --}}
                    <section class="gm-checkout-section" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); margin-bottom: var(--s-5);">
                        <header style="padding-bottom: var(--s-4); margin-bottom: var(--s-4); border-bottom: 1px solid var(--c-line);">
                            <h2 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0;">Payment Method</h2>
                        </header>

                        <div class="gm-payment-options" style="display: flex; flex-direction: column; gap: var(--s-3);">
                            @if($info->bkash)
                                <label class="gm-payment-option" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-4); border: 1px solid var(--c-line); border-radius: var(--r-md); cursor: pointer;" wire:click="$set('form.payment_method', 'bkash')">
                                    <input type="radio" name="payment_method" value="bkash" class="gm-radio__input" wire:model="form.payment_method" @if(old('payment_method') == 'bkash') checked @endif>
                                    <span class="gm-radio__box" aria-hidden="true"></span>
                                    <div>
                                        <div style="font-weight: 500; color: var(--c-ink-900);">Bkash</div>
                                        <div style="font-size: var(--t-sm); color: var(--c-ink-500);">{{ $info->bkash_number }}</div>
                                    </div>
                                </label>
                            @endif

                            @if($info->rocket)
                                <label class="gm-payment-option" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-4); border: 1px solid var(--c-line); border-radius: var(--r-md); cursor: pointer;" wire:click="$set('form.payment_method', 'rocket')">
                                    <input type="radio" name="payment_method" value="rocket" class="gm-radio__input" wire:model="form.payment_method" @if(old('payment_method') == 'rocket') checked @endif>
                                    <span class="gm-radio__box" aria-hidden="true"></span>
                                    <div>
                                        <div style="font-weight: 500; color: var(--c-ink-900);">Rocket</div>
                                        <div style="font-size: var(--t-sm); color: var(--c-ink-500);">{{ $info->rocket_number }}</div>
                                    </div>
                                </label>
                            @endif

                            @if($info->nogod)
                                <label class="gm-payment-option" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-4); border: 1px solid var(--c-line); border-radius: var(--r-md); cursor: pointer;" wire:click="$set('form.payment_method', 'nogod')">
                                    <input type="radio" name="payment_method" value="nogod" class="gm-radio__input" wire:model="form.payment_method" @if(old('payment_method') == 'nogod') checked @endif>
                                    <span class="gm-radio__box" aria-hidden="true"></span>
                                    <div>
                                        <div style="font-weight: 500; color: var(--c-ink-900);">Nogod</div>
                                        <div style="font-size: var(--t-sm); color: var(--c-ink-500);">{{ $info->nogod_number }}</div>
                                    </div>
                                </label>
                            @endif

                            @if($info->paypal)
                                <label class="gm-payment-option" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-4); border: 1px solid var(--c-line); border-radius: var(--r-md); cursor: pointer;" wire:click="$set('form.payment_method', 'paypal')">
                                    <input type="radio" name="payment_method" value="paypal" class="gm-radio__input" wire:model="form.payment_method" @if(old('payment_method') == 'paypal') checked @endif>
                                    <span class="gm-radio__box" aria-hidden="true"></span>
                                    <div>
                                        <div style="font-weight: 500; color: var(--c-ink-900);">Paypal</div>
                                        <div style="font-size: var(--t-sm); color: var(--c-ink-500);">{{ $info->paypal_account }}</div>
                                    </div>
                                </label>
                            @endif

                            @if($info->stripe)
                                <label class="gm-payment-option" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-4); border: 1px solid var(--c-line); border-radius: var(--r-md); cursor: pointer;" wire:click="$set('form.payment_method', 'stripe')">
                                    <input type="radio" name="payment_method" value="stripe" class="gm-radio__input" wire:model="form.payment_method" @if(old('payment_method') == 'stripe') checked @endif>
                                    <span class="gm-radio__box" aria-hidden="true"></span>
                                    <div>
                                        <div style="font-weight: 500; color: var(--c-ink-900);">Stripe</div>
                                        <div style="font-size: var(--t-sm); color: var(--c-ink-500);">{{ $info->stripe_account }}</div>
                                    </div>
                                </label>
                            @endif

                            <label class="gm-payment-option" style="display: flex; align-items: center; gap: var(--s-3); padding: var(--s-4); border: 1px solid var(--c-line); border-radius: var(--r-md); cursor: pointer;" wire:click="$set('form.payment_method', 'cash')">
                                <input type="radio" name="payment_method" value="cash" class="gm-radio__input" wire:model="form.payment_method" @if(!old('payment_method') || old('payment_method') == 'cash') checked @endif>
                                <span class="gm-radio__box" aria-hidden="true"></span>
                                <div>
                                    <div style="font-weight: 500; color: var(--c-ink-900);">Cash on Delivery</div>
                                    <div style="font-size: var(--t-sm); color: var(--c-ink-500);">Pay when you receive your order</div>
                                </div>
                            </label>
                        </div>

                        {{-- Payment Details (for non-cash) --}}
                        <div id="payment_input" style="display: none; margin-top: var(--s-4); padding: var(--s-4); background: var(--c-bg-2); border-radius: var(--r-md);" wire:show="form.payment_method != 'cash' && form.payment_method != 'stripe' && form.payment_method != 'paypal'">
                            <div class="gm-form-row gm-form-row--2">
                                <x-ui.input
                                    name="pay_num"
                                    label="Account Number"
                                    placeholder="Enter account number"
                                    wire:model="form.pay_num"
                                />
                                <x-ui.input
                                    name="tnx_id"
                                    label="Transaction Number"
                                    placeholder="Enter transaction number"
                                    wire:model="form.tnx_id"
                                />
                            </div>
                        </div>

                        {{-- Stripe --}}
                        <div id="stripe-element" style="display: none; margin-top: var(--s-4);" wire:show="form.payment_method == 'stripe'">
                            <div id="stripe-card-element"></div>
                            <div id="stripe-errors" class="gm-error-text" style="margin-top: var(--s-2);" role="alert"></div>
                        </div>

                        {{-- PayPal --}}
                        <div id="paypal-button-container" style="display: none; margin-top: var(--s-4);" wire:show="form.payment_method == 'paypal'"></div>
                    </section>

                    {{-- Place Order --}}
                    <div class="gm-checkout-actions" style="display: flex; flex-direction: column; gap: var(--s-3);">
                        <x-ui.button
                            variant="primary"
                            size="lg"
                            full
                            type="submit"
                            :loading="$wire.placingOrder"
                            :disabled="$cart->count() == 0"
                        >
                            {{ $bangla_text->order_confirm_text ?? 'Place Order' }}
                        </x-ui.button>
                    </div>
                </form>
            </div>

            {{-- Order Summary --}}
            <div class="gm-checkout-summary" style="position: sticky; top: calc(var(--header-h) + var(--s-4));">
                <x-ui.order-summary
                    :subtotal="$subtotal"
                    :shipping="$chargeAmount"
                    :discount="$discount + $couponDiscount"
                    :tax="0"
                    :total="$total"
                    :currency="$info->currency"
                    :freeShippingThreshold="5000"
                    variant="checkout"
                    actionText="Place Order"
                    onAction="placeOrder"
                />

                {{-- Order Items --}}
                <div class="gm-checkout-items" style="margin-top: var(--s-5); background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;">
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
                            drawer="true"
                        />
                    @endforeach
                </div>
            </div>
        </div>
    </x-ui.section>
</main>

@push('scripts')
<script>
    (function() {
        // IP address fetch
        fetch('https://api.ipify.org?format=json', {
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            const ipInput = document.getElementById('ip_address');
            if (ipInput) ipInput.value = data.ip;
        })
        .catch(err => console.error('Error fetching IP:', err));

        // Shipping charge change handler
        document.addEventListener('change', function(e) {
            if (e.target.matches('input[name="delivery_charge_id"]')) {
                const charge = parseFloat(e.target.dataset.charge) || 0;
                const subtotal = {{ $subtotal - $discount - $couponDiscount }};
                const total = subtotal + charge;

                document.querySelectorAll('[data-gm-shipping-charge]').forEach(el => {
                    el.textContent = '{{ $currencySymbol }} ' + charge.toLocaleString(undefined, { minimumFractionDigits: 2 });
                });
                document.querySelectorAll('[data-gm-grand-total]').forEach(el => {
                    el.textContent = '{{ $currencySymbol }} ' + total.toLocaleString(undefined, { minimumFractionDigits: 2 });
                });

                // Update hidden amount input
                document.querySelectorAll('input[name="amount"]').forEach(input => {
                    input.value = total.toFixed(2);
                });
            }
        });

        // Payment method change handler
        document.addEventListener('change', function(e) {
            if (e.target.matches('input[name="payment_method"]')) {
                const method = e.target.value;
                const paymentInput = document.getElementById('payment_input');
                const stripeEl = document.getElementById('stripe-element');
                const paypalEl = document.getElementById('paypal-button-container');
                const placeOrderBtn = document.querySelector('#checkout_form button[type="submit"]');

                if (paymentInput) paymentInput.style.display = method === 'cash' || method === 'stripe' || method === 'paypal' ? 'none' : 'block';
                if (stripeEl) stripeEl.style.display = method === 'stripe' ? 'block' : 'none';
                if (paypalEl) paypalEl.style.display = method === 'paypal' ? 'block' : 'none';

                if (placeOrderBtn) {
                    placeOrderBtn.style.display = method === 'stripe' ? 'none' : 'block';
                }

                // Initialize Stripe if needed
                if (method === 'stripe' && window.Stripe && !window.stripeInitialized) {
                    initStripe();
                }
            }
        });

        // Stripe initialization
        function initStripe() {
            if (typeof Stripe === 'undefined') return;
            window.stripeInitialized = true;
            const stripe = Stripe('{{ $info->stripe_key ?? "" }}');
            const elements = stripe.elements();
            const card = elements.create('card', { style: { base: { fontSize: '16px', color: '#101010' } } });
            card.mount('#stripe-card-element');
            card.on('change', e => {
                const errorEl = document.getElementById('stripe-errors');
                if (errorEl) errorEl.textContent = e.error ? e.error.message : '';
            });
            window.stripeCard = card;
        }

        // Form submission
        const form = document.getElementById('checkout_form');
        if (form) {
            form.addEventListener('submit', async function(e) {
                if (window.stripeCard && document.querySelector('input[name="payment_method"]:checked')?.value === 'stripe') {
                    e.preventDefault();
                    const submitBtn = form.querySelector('button[type="submit"]');
                    submitBtn.disabled = true;
                    submitBtn.classList.add('gm-btn--loading');

                    const { error, paymentMethod } = await stripe.createPaymentMethod('card', window.stripeCard);
                    if (error) {
                        const errorEl = document.getElementById('stripe-errors');
                        if (errorEl) errorEl.textContent = error.message;
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('gm-btn--loading');
                    } else {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'stripe_payment_method_id';
                        input.value = paymentMethod.id;
                        form.appendChild(input);
                        form.submit();
                    }
                }
            });
        }

        // Coupon apply
        document.addEventListener('apply-coupon', function() {
            // Handled by Livewire
        });
    })();
</script>
@endpush

@push('scripts-bottom')
@if($info->stripe)
<script src="https://js.stripe.com/v3/" async></script>
@endif
@if($info->paypal)
<script src="https://www.paypal.com/sdk/js?client-id={{ $info->paypal_client_id }}&currency={{ $info->currency == 'BDT' ? 'USD' : $info->currency }}" async></script>
@endif
@endpush