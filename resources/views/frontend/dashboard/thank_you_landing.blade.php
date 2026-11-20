@extends('frontend.app')

@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="col-lg-12">
                <div class="card bg-white shadow p-5" style="border: 1px solid var(--c-success); max-width: 560px; margin: 0 auto;">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16" aria-hidden="true">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                        </svg>
                    </div>
                    <div class="text-center" style="margin-top: var(--s-4);">
                        <h1 style="color: var(--c-success); font-size: var(--t-2xl); font-family: var(--f-display); margin: 0 0 var(--s-2);">Thank You!</h1>
                        <h3 style="color: var(--c-ink-700); font-size: var(--t-lg); margin: 0 0 var(--s-2);">Your order has been received.</h3>
                        <p style="color: var(--c-ink-500); max-width: 480px; margin: 0 auto var(--s-4);">Our sales representative will contact you shortly to confirm your order.</p>

                        <p style="color: var(--c-ink-700); margin-bottom: var(--s-4);">
                            Order Invoice: <strong><a href="{{ route('front.orders.show', [$order->id]) }}" target="_blank" title="Print this invoice">#{{ $order->invoice_no }}</a></strong>
                        </p>

                        <div class="d-flex gap-2 justify-content-center flex-wrap">
                            <x-ui.button variant="primary" href="{{ route('front.home') }}">Home</x-ui.button>
                            <x-ui.button variant="secondary" href="{{ route('front.dashboard.index') }}">Dashboard</x-ui.button>
                            <x-ui.button variant="ghost" href="{{ route('front.orders.show', [$order->id]) }}" target="_blank">Print Invoice</x-ui.button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection