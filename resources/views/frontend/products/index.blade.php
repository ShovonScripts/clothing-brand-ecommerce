@extends('frontend.app')

@section('title', 'Shop — GENTRY')

@section('content')
@php
    // Frontend\ProductController@index passes $cats, $types, $sizes. Products
    // are fetched over AJAX from the same route (rendered by index_data.blade.php),
    // so every filter below uses the parameter names that controller reads:
    // cat_id[], size_id[], brand_id, q, shorting, page.
    $selectedCats = array_map('strval', (array) request('cat_id', []));
    // Links elsewhere on the site use ?category_id= / ?sub_category_id=.
    $linkedCategory = request('sub_category_id') ?: request('category_id');
    if ($linkedCategory) $selectedCats[] = (string) $linkedCategory;
    $selectedCats = array_values(array_unique($selectedCats));

    $topCategoryIds = $cats->pluck('id')->map(fn ($id) => (string) $id)->all();
    // A linked sub-category isn't in the sidebar list; keep it as a hidden filter.
    $hiddenCats = array_diff($selectedCats, $topCategoryIds);

    $filters = [
        'cat_id' => [
            'label' => 'Category',
            'options' => $cats->map(fn ($c) => ['value' => $c->id, 'label' => $c->name])->all(),
        ],
        'brand_id' => [
            'label' => 'Brand',
            'type' => 'radio',
            'options' => collect([['value' => '', 'label' => 'All brands']])
                ->merge($types->map(fn ($t) => ['value' => $t->id, 'label' => $t->name]))->all(),
        ],
        'size_id' => [
            'label' => 'Size',
            'options' => $sizes->map(fn ($s) => ['value' => $s->id, 'label' => $s->title])->all(),
        ],
    ];
    $selected = [
        'cat_id' => $selectedCats,
        'brand_id' => request('brand_id', ''),
        'size_id' => (array) request('size_id', []),
    ];
@endphp

<main class="main-wrapper">
    <x-ui.breadcrumb :items="[
        ['label' => 'Home', 'url' => route('front.home')],
        ['label' => 'Shop'],
    ]" />

    <x-ui.section size="md">
        <form id="gm-shop-filters" class="gm-listing-layout" action="{{ route('front.products.index') }}" method="GET" role="search">
            @if(request('q'))
                <input type="hidden" name="q" value="{{ request('q') }}">
            @endif
            @foreach($hiddenCats as $catId)
                <input type="hidden" name="cat_id[]" value="{{ $catId }}">
            @endforeach

            <div class="gm-listing-filters-overlay" data-gm-shop-filters-close></div>
            <div class="gm-listing-filters" id="gm-shop-filter-panel" aria-label="Product filters">
                <x-ui.filter-sidebar :filters="$filters" :selected="$selected">
                    <div class="gm-listing-filters__footer">
                        <x-ui.button variant="primary" full class="gm-listing-apply" data-gm-shop-filters-close>Show results</x-ui.button>
                    </div>
                </x-ui.filter-sidebar>
            </div>

            <div class="gm-listing-main">
                <div class="gm-listing-toolbar">
                    @if(request('q'))
                        <p class="gm-listing-query">Results for “{{ request('q') }}”</p>
                    @endif

                    <div class="gm-listing-controls">
                        <button type="button" class="gm-btn gm-btn--secondary gm-btn--sm gm-listing-filter-toggle"
                                aria-controls="gm-shop-filter-panel" aria-expanded="false" data-gm-shop-filters-open>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                            Filters
                        </button>

                        <label class="visually-hidden" for="gm-shop-sort">Sort products</label>
                        <x-ui.select
                            id="gm-shop-sort"
                            name="shorting"
                            placeholder=""
                            :value="request('shorting', 'desc')"
                            :options="[
                                'desc' => 'Newest first',
                                'asc' => 'Oldest first',
                                'name' => 'Name A–Z',
                                'price_low' => 'Price: low to high',
                                'price_high' => 'Price: high to low',
                            ]"
                            class="gm-listing-sort"
                        />
                    </div>
                </div>

                <div id="gm-shop-products" class="gm-listing-products" aria-live="polite" aria-busy="true">
                    <p class="gm-listing-results">Loading products…</p>
                </div>
            </div>
        </form>
    </x-ui.section>
</main>
@endsection

@push('scripts')
<script>
(function () {
    const form = document.getElementById('gm-shop-filters');
    const target = document.getElementById('gm-shop-products');
    if (!form || !target) return;

    const panel = document.getElementById('gm-shop-filter-panel');
    const overlay = form.querySelector('.gm-listing-filters-overlay');
    const toggle = form.querySelector('[data-gm-shop-filters-open]');
    let inflight = null;

    function params(page) {
        const p = new URLSearchParams(new FormData(form));
        // An empty radio value ("All brands") means no brand filter.
        if (!p.get('brand_id')) p.delete('brand_id');
        p.set('page', page || 1);
        return p;
    }

    function load(page) {
        const p = params(page);
        inflight?.abort();
        inflight = new AbortController();
        target.setAttribute('aria-busy', 'true');

        fetch(form.action + '?' + p.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' },
            signal: inflight.signal,
        })
            .then((res) => { if (!res.ok) throw new Error(res.status); return res.text(); })
            .then((html) => {
                target.innerHTML = html;
                target.setAttribute('aria-busy', 'false');
                if (p.get('page') === '1') p.delete('page');
                history.replaceState(null, '', form.action + (p.toString() ? '?' + p : ''));
            })
            .catch((err) => {
                if (err.name === 'AbortError') return;
                target.setAttribute('aria-busy', 'false');
                target.innerHTML = '<p class="gm-listing-results">Sorry, products could not be loaded. Please refresh the page.</p>';
            });
    }

    function setPanel(open) {
        panel.classList.toggle('is-open', open);
        overlay.classList.toggle('is-open', open);
        toggle?.setAttribute('aria-expanded', open ? 'true' : 'false');
        document.body.style.overflow = open ? 'hidden' : '';
    }

    form.addEventListener('change', () => load(1));
    form.addEventListener('submit', (e) => { e.preventDefault(); load(1); });

    form.addEventListener('click', (e) => {
        if (e.target.closest('[data-gm-shop-filters-open]')) { setPanel(true); return; }
        if (e.target.closest('[data-gm-shop-filters-close]')) { setPanel(false); return; }
        if (e.target.closest('[data-gm-clear-filters]')) {
            form.querySelectorAll('input[type=checkbox]').forEach((i) => { i.checked = false; });
            form.querySelectorAll('input[type=radio][value=""]').forEach((i) => { i.checked = true; });
            form.querySelectorAll('input[type=hidden][name="cat_id[]"]').forEach((i) => i.remove());
            load(1);
            return;
        }
        const link = e.target.closest('[data-gm-shop-pagination] a[href]');
        if (link) {
            e.preventDefault();
            load(new URL(link.href).searchParams.get('page') || 1);
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });

    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') setPanel(false); });

    load(new URLSearchParams(location.search).get('page') || 1);
})();
</script>
@endpush
