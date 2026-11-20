@extends('frontend.app')

@section('title', 'Sale — GENTRY')

@section('content')
{{-- Frontend\ProductController@discountProduct renders no data for the page itself;
     products arrive over AJAX as JSON {html} built from products/partials/discount. --}}
<main class="main-wrapper">
    <x-ui.breadcrumb :items="[
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Sale'],
    ]" />

    <x-ui.section size="md">
        <x-ui.section-header title="Sale" subtitle="Reduced pieces, while they last" />

        <div id="gm-sale-products" class="gm-listing-products" aria-live="polite" aria-busy="true"
             data-url="{{ route('front.discountProduct') }}">
            <p class="gm-listing-results">Loading products…</p>
        </div>
    </x-ui.section>
</main>
@endsection

@push('scripts')
<script>
(function () {
    const target = document.getElementById('gm-sale-products');
    if (!target) return;
    const url = target.dataset.url;

    function load(page) {
        target.setAttribute('aria-busy', 'true');
        fetch(url + '?page=' + (page || 1), {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
        })
            .then((res) => { if (!res.ok) throw new Error(res.status); return res.json(); })
            .then((res) => {
                target.innerHTML = res.html || '';
                target.setAttribute('aria-busy', 'false');
            })
            .catch(() => {
                target.setAttribute('aria-busy', 'false');
                target.innerHTML = '<p class="gm-listing-results">Sorry, products could not be loaded. Please refresh the page.</p>';
            });
    }

    target.addEventListener('click', (e) => {
        const link = e.target.closest('.gm-pagination-wrapper a[href]');
        if (!link) return;
        e.preventDefault();
        load(new URL(link.href).searchParams.get('page') || 1);
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    load(new URLSearchParams(location.search).get('page') || 1);
})();
</script>
@endpush
