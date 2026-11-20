@extends('frontend.app')

@section('title', 'Shopping Bag — GENTRY')

@section('content')
@php
    // Frontend\CartController@index passes $cart: the session cart, an array keyed by
    // variation id. Each line's "price" is already the selling price after any product
    // discount; "discount" is how much was taken off per unit (informational only).
    $cart = $cart ?? session('cart', []);
    $itemCount = count($cart);
    $subtotal = 0;
    $savings = 0;
    foreach ($cart as $line) {
        $subtotal += $line['price'] * $line['quantity'];
        $savings += ($line['discount'] ?? 0) * $line['quantity'];
    }
@endphp

<main class="main-wrapper">
    <x-ui.breadcrumb :items="[
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Shopping Bag'],
    ]" />

    <x-ui.section size="md">
        @if($itemCount)
            <div class="gm-cart-layout">
                <section class="gm-cart-items" aria-labelledby="gm-cart-title" data-gm-cart>
                    <header class="gm-cart-header">
                        <h1 id="gm-cart-title" class="gm-cart-title">{{ $itemCount }} {{ \Illuminate\Support\Str::plural('item', $itemCount) }} in your bag</h1>
                        <a href="{{ route('front.carts.clearAll') }}" class="gm-cart-clear" data-gm-confirm="Remove every item from your bag?">Clear bag</a>
                    </header>

                    <div class="gm-cart-list">
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
                            />
                        @endforeach
                    </div>
                </section>

                <aside class="gm-cart-summary" aria-label="Order summary">
                    <x-ui.order-summary
                        variant="cart"
                        :subtotal="$subtotal"
                        :savings="$savings"
                        actionText="Proceed to checkout"
                        :actionUrl="route('front.checkouts.index')"
                    />
                </aside>
            </div>
        @else
            <x-ui.empty-state
                type="cart"
                title="Your bag is empty"
                message="Looks like you haven't added anything yet."
                action="Start shopping"
                :actionUrl="route('front.products.index')"
            />
        @endif
    </x-ui.section>
</main>
@endsection

@push('scripts')
<script>
(function () {
    const cart = document.querySelector('[data-gm-cart]');
    if (!cart) return;

    // Frontend\CartController: edit = GET /carts/{variation}/edit?quantity=N (0 removes),
    // destroy = DELETE /carts/{variation}. Both answer JSON {success, msg, item}.
    const editUrl = @json(route('front.carts.edit', ['cart' => '__ID__']));
    const destroyUrl = @json(route('front.carts.destroy', ['cart' => '__ID__']));
    const token = document.querySelector('meta[name="csrf-token"]')?.content;

    function notify(ok, msg) {
        if (window.toastr) toastr[ok ? 'success' : 'error'](msg);
    }

    function busy(line, on) {
        line?.classList.toggle('is-busy', on);
        line?.querySelectorAll('button, input').forEach((el) => { el.disabled = on; });
    }

    function handle(res, line) {
        if (res && res.success) {
            // Totals, line counts and the header badge all come from the server.
            window.location.reload();
        } else {
            busy(line, false);
            notify(false, (res && res.msg) || 'Could not update your bag.');
        }
    }

    cart.addEventListener('change', (e) => {
        const input = e.target.closest('[data-gm-cart-qty]');
        if (!input) return;
        const line = input.closest('.gm-cart-line');
        busy(line, true);
        fetch(editUrl.replace('__ID__', input.dataset.gmCartQty) + '?quantity=' + encodeURIComponent(input.value), {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
        })
            .then((r) => r.json())
            .then((res) => handle(res, line))
            .catch(() => handle(null, line));
    });

    cart.addEventListener('click', (e) => {
        const remove = e.target.closest('[data-gm-cart-remove]');
        if (remove) {
            const line = remove.closest('.gm-cart-line');
            busy(line, true);
            const body = new FormData();
            body.append('_method', 'DELETE');
            body.append('_token', token);
            fetch(destroyUrl.replace('__ID__', remove.dataset.gmCartRemove), {
                method: 'POST',
                body,
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': token },
            })
                .then((r) => r.json())
                .then((res) => handle(res, line))
                .catch(() => handle(null, line));
            return;
        }

        const confirmLink = e.target.closest('[data-gm-confirm]');
        if (confirmLink && !window.confirm(confirmLink.dataset.gmConfirm)) e.preventDefault();
    });
})();
</script>
@endpush
