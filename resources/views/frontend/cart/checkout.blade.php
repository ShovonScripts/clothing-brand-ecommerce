@extends('frontend.app')

@section('title', 'Checkout — GENTRY')

@section('content')
@php
    // Frontend\CheckoutController@index passes $cart (session cart, keyed by variation id)
    // and $charges (delivery areas). The form posts to CheckoutController@store, which
    // charges:  Σ(price × qty) + delivery charge − coupon.  Line "price" is already the
    // reduced price, so product discounts must NOT be subtracted again here.
    // Field names below are the ones that controller validates — do not rename them.
    $info = \App\Models\Information::first();
    $bangla_text = \App\Models\BanglaText::first();

    $cart = $cart ?? session('cart', []);
    $charges = $charges ?? collect();

    $subtotal = 0;
    $savings = 0;
    $needsDelivery = false;
    foreach ($cart as $line) {
        $subtotal += $line['price'] * $line['quantity'];
        $savings += ($line['discount'] ?? 0) * $line['quantity'];
        if (empty($line['is_free_shipping'])) $needsDelivery = true;
    }

    $selectedChargeId = old('delivery_charge_id', $needsDelivery ? optional($charges->first())->id : 0);
    $chargeAmount = $needsDelivery ? (float) optional($charges->firstWhere('id', $selectedChargeId))->amount : 0;
    $couponDiscount = (float) (getCouponDiscount() ?? 0);
    $total = $subtotal + $chargeAmount - $couponDiscount;

    $mobileMethods = [
        'bkash' => ['Bkash', $info->bkash_number ?? null],
        'rocket' => ['Rocket', $info->rocket_number ?? null],
        'nogod' => ['Nogod', $info->nogod_number ?? null],
    ];
    $oldMethod = old('payment_method', 'cash');
@endphp

<main class="main-wrapper">
    <x-ui.breadcrumb :items="[
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Shopping Bag', 'url' => route('front.carts.index')],
        ['label' => 'Checkout'],
    ]" />

    <x-ui.section size="md">
        <div class="gm-checkout-layout">
            <form method="POST" action="{{ route('front.checkouts.store') }}" id="checkout_form" class="gm-checkout-form" novalidate
                  data-subtotal="{{ $subtotal }}" data-coupon="{{ $couponDiscount }}"
                  data-currency="{{ trim(str_replace('0', '', priceFormate(0))) }}">
                @csrf
                {{-- Required by the controller. Filled server-side so an order never fails
                     just because the browser blocks the ipify lookup below. --}}
                <input type="hidden" name="ip_address" id="ip_address" value="{{ request()->ip() }}">

                <section class="gm-checkout-section">
                    <h2 class="gm-checkout-section__title">{{ $bangla_text->checkout_form_top_text ?? 'Contact information' }}</h2>

                    <div class="gm-checkout-fields gm-checkout-fields--2">
                        <x-ui.input name="first_name" :label="$bangla_text->name_text ?? 'Full name'" placeholder="Your full name"
                                    required autocomplete="name" :error="$errors->first('first_name')" />
                        <x-ui.input name="mobile" type="tel" :label="$bangla_text->mobile_text ?? 'Mobile number'" placeholder="01XXXXXXXXX"
                                    required autocomplete="tel" inputmode="numeric" :error="$errors->first('mobile')" />
                    </div>

                    <x-ui.input name="shipping_address" :label="$bangla_text->address_text ?? 'Delivery address'" placeholder="House, road, area, city"
                                required autocomplete="street-address" :error="$errors->first('shipping_address')" />
                </section>

                <section class="gm-checkout-section">
                    <h2 class="gm-checkout-section__title">Delivery</h2>

                    @if($needsDelivery && $charges->isNotEmpty())
                        <div class="gm-checkout-options" role="radiogroup" aria-label="Delivery area">
                            @foreach($charges as $charge)
                                <label class="gm-checkout-option">
                                    <input type="radio" name="delivery_charge_id" value="{{ $charge->id }}" data-charge="{{ $charge->amount }}"
                                           class="gm-checkout-option__input" @checked($charge->id == $selectedChargeId)>
                                    <span class="gm-checkout-option__body">
                                        <span class="gm-checkout-option__title">{{ $charge->title }}</span>
                                    </span>
                                    <span class="gm-checkout-option__price">{{ priceFormate($charge->amount) }}</span>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <p class="gm-checkout-note">
                            {{ $needsDelivery ? 'Delivery charge will be confirmed by our team.' : 'Free delivery on this order.' }}
                        </p>
                        <input type="hidden" name="delivery_charge_id" value="0">
                    @endif
                </section>

                @if(($info->coupon_visibility ?? null) == '1')
                    <section class="gm-checkout-section">
                        <h2 class="gm-checkout-section__title">Have a coupon?</h2>
                        @auth
                            {{-- Applied by public/frontend/js/checkout.js (button#coupon_apply → GET /coupon-discount). --}}
                            <div class="gm-checkout-coupon">
                                <x-ui.input id="coupon_code" name="coupon_code" placeholder="Enter coupon code" />
                                <x-ui.button variant="secondary" id="coupon_apply">Apply</x-ui.button>
                            </div>
                        @else
                            <p class="gm-checkout-note"><a href="{{ route('login') }}">Sign in</a> to use a coupon code.</p>
                        @endauth
                    </section>
                @endif

                <section class="gm-checkout-section">
                    <h2 class="gm-checkout-section__title">Payment</h2>

                    <div class="gm-checkout-options" role="radiogroup" aria-label="Payment method">
                        <label class="gm-checkout-option">
                            <input type="radio" name="payment_method" value="cash" class="gm-checkout-option__input" @checked($oldMethod === 'cash')>
                            <span class="gm-checkout-option__body">
                                <span class="gm-checkout-option__title">Cash on delivery</span>
                                <span class="gm-checkout-option__meta">Pay when you receive your order</span>
                            </span>
                        </label>

                        @foreach($mobileMethods as $value => [$label, $number])
                            @if($info->{$value} ?? false)
                                <label class="gm-checkout-option">
                                    <input type="radio" name="payment_method" value="{{ $value }}" class="gm-checkout-option__input" @checked($oldMethod === $value)>
                                    <span class="gm-checkout-option__body">
                                        <span class="gm-checkout-option__title">{{ $label }}</span>
                                        @if($number)<span class="gm-checkout-option__meta">Send money to {{ $number }}</span>@endif
                                    </span>
                                </label>
                            @endif
                        @endforeach
                        {{-- Stripe/PayPal options are intentionally not offered here: the browser side
                             of those flows does not match CheckoutController yet and has never been
                             tested end to end. Rebuild and test them before showing them to customers. --}}
                    </div>

                    <div class="gm-checkout-mobile-pay" id="payment_input" @if(!array_key_exists($oldMethod, $mobileMethods)) hidden @endif>
                        <p class="gm-checkout-note">After sending the money, enter your account number and the transaction ID.</p>
                        <div class="gm-checkout-fields gm-checkout-fields--2">
                            <x-ui.input name="pay_num" label="Your account number" placeholder="01XXXXXXXXX" inputmode="numeric" />
                            <x-ui.input name="tnx_id" label="Transaction ID" placeholder="e.g. 8N7A6C5B4D" />
                        </div>
                    </div>
                </section>

                <div class="gm-checkout-actions">
                    <x-ui.button variant="primary" size="lg" full type="submit">
                        {{ $bangla_text->order_confirm_text ?? 'Place order' }} · <span data-gm-summary="total">{{ priceFormate($total) }}</span>
                    </x-ui.button>
                </div>
            </form>

            <aside class="gm-checkout-summary" aria-label="Order summary">
                <x-ui.order-summary
                    variant="checkout"
                    :subtotal="$subtotal"
                    :shipping="$chargeAmount"
                    :discount="$couponDiscount"
                    :savings="$savings"
                    :total="$total"
                />

                <div class="gm-checkout-items">
                    @foreach($cart as $key => $line)
                        <x-ui.cart-line
                            :id="$key"
                            :image="getImage('products', $line['image'])"
                            :name="$line['name']"
                            :href="route('front.products.show', [$line['product_id']])"
                            :variant="['Size' => $line['size'] ?? null, 'Color' => $line['color'] ?? null]"
                            :price="$line['price']"
                            :originalPrice="($line['discount'] ?? 0) > 0 ? $line['price'] + $line['discount'] : null"
                            :quantity="$line['quantity']"
                            :editable="false"
                            :drawer="true"
                        />
                    @endforeach
                    <a class="gm-checkout-edit" href="{{ route('front.carts.index') }}">Edit bag</a>
                </div>
            </aside>
        </div>
    </x-ui.section>
</main>
@endsection

@push('js')
{{-- AJAX submit (→ redirect to the order confirmation), field-level validation
     errors, and the coupon button. Bound to form#checkout_form. --}}
<script src="{{ asset('frontend/js/checkout.js') }}"></script>
@endpush

@push('scripts')
<script>
(function () {
    const form = document.getElementById('checkout_form');
    if (!form) return;

    // Prefer the public IP when the lookup works; the server-side value stays otherwise.
    fetch('https://api.ipify.org?format=json')
        .then((r) => r.json())
        .then((d) => { if (d && d.ip) document.getElementById('ip_address').value = d.ip; })
        .catch(() => {});

    const subtotal = parseFloat(form.dataset.subtotal) || 0;
    const coupon = parseFloat(form.dataset.coupon) || 0;
    // Same output as the priceFormate() helper: store currency symbol, no decimals.
    const money = (v) => (form.dataset.currency || '') + Math.round(v).toLocaleString('en-US');

    // Keep the summary in step with the chosen delivery area (same formula as the server).
    form.addEventListener('change', (e) => {
        if (e.target.matches('input[name="delivery_charge_id"]')) {
            const charge = parseFloat(e.target.dataset.charge) || 0;
            document.querySelectorAll('[data-gm-summary="shipping"]').forEach((el) => { el.textContent = charge > 0 ? money(charge) : 'Free'; });
            document.querySelectorAll('[data-gm-summary="total"]').forEach((el) => { el.textContent = money(subtotal + charge - coupon); });
        }

        if (e.target.matches('input[name="payment_method"]')) {
            const mobile = ['bkash', 'rocket', 'nogod'].includes(e.target.value);
            document.getElementById('payment_input').hidden = !mobile;
        }
    });
})();
</script>
@endpush
