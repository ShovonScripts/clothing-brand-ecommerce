@extends('frontend.app')

@section('title', 'Combo Offers — GENTRY')

@section('content')
@php
$info = \App\Models\Information::first();
$currencySymbol = match($info->currency) {
    'BDT' => '৳',
    'Dollar' => '$',
    'Euro' => '€',
    'Rupee' => '₹',
    default => ''
};
$products = $products ?? new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12);
$sort = request('shorting', 'desc');
@endphp

<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Combo Offers'],
        ]"
    />

    <x-ui.section size="md">
        <div class="gm-listing-layout" style="display: grid; grid-template-columns: 280px 1fr; gap: var(--s-8); align-items: start;">
            {{-- Sidebar --}}
            <aside class="gm-filter-sidebar--desktop" aria-label="Combo filters">
                <x-ui.filter-sidebar
                    :filters="[
                        'category' => [
                            'label' => 'Category',
                            'options' => \$cats->map(fn(\$c) => ['value' => \$c->id, 'label' => \$c->name, 'count' => \$c->products_count ?? 0])->toArray(),
                        ],
                        'brand' => [
                            'label' => 'Brand',
                            'options' => \$types->map(fn(\$t) => ['value' => \$t->id, 'label' => \$t->name])->toArray(),
                        ],
                        'size' => [
                            'label' => 'Size',
                            'options' => \$sizes->map(fn(\$s) => ['value' => \$s->id, 'label' => \$s->title])->toArray(),
                        ],
                    ]"
                    :selectedFilters="[
                        'category' => request('category_id') ? [request('category_id')] : [],
                        'brand' => request('brand_id') ? [request('brand_id')] : [],
                        'size' => request('size_id', []),
                    ]"
                    :onFilterChange="true"
                    drawer="false"
                />
            </aside>

            {{-- Product List --}}
            <div class="gm-listing-main">
                <div class="gm-listing-toolbar" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: var(--s-3); margin-bottom: var(--s-5); padding-bottom: var(--s-3); border-bottom: 1px solid var(--c-line);">
                    <div>
                        <p class="gm-listing-eyebrow" style="font-size: var(--t-xs); font-weight: 600; text-transform: uppercase; letter-spacing: var(--ls-wide); color: var(--c-accent); margin: 0 0 var(--s-1);">Bundle & Save</p>
                        <h2 class="gm-listing-title" style="font-size: var(--t-2xl); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0;">Combo Offers</h2>
                        <p class="gm-listing-subtitle" style="color: var(--c-ink-500); margin: var(--s-1) 0 0;">Curated combinations at special prices. Buy together, save more.</p>
                    </div>

                    <div class="gm-listing-controls" style="display: flex; align-items: center; gap: var(--s-3); flex-wrap: wrap;">
                        <button type="button" class="gm-btn gm-btn--ghost gm-btn--sm d-lg-none" data-gm-drawer-open="filter-drawer">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                            Filters
                        </button>

                        <x-ui.select
                            name="shorting"
                            :value="$sort"
                            :options="[
                                'desc' => 'Newest first',
                                'asc' => 'Oldest first',
                                'name' => 'Name A–Z',
                                'price_low' => 'Price: low to high',
                                'price_high' => 'Price: high to low',
                            ]"
                            wire:change="$dispatch('sort-change', { value: \$event.target.value })"
                            style="min-width: 200px;"
                        />
                    </div>
                </div>

                @if($products->isNotEmpty())
                    <x-ui.product-grid>
                        @foreach($products as $product)
                            <x-ui.product-card
                                :product="$product"
                                :image="getImage('products', $product->image)"
                                :name="$product->name"
                                :price="getProductInfo($product)['price']"
                                :originalPrice="getProductInfo($product)['discount_amount'] > 0 ? getProductInfo($product)['old_price'] : null"
                                :category="optional($product->category)->name"
                                :badges="[['variant' => 'sale', 'label' => 'Combo']]"
                                :href="route('front.products.show', [$product->id])"
                                :wishlistId="'wishlist_' . $product->id"
                            />
                        @endforeach
                    </x-ui.product-grid>

                    {{-- Pagination --}}
                    <div class="gm-pagination-wrapper" style="margin-top: var(--s-6);">
                        <x-ui.pagination
                            :currentPage="$products->currentPage()"
                            :lastPage="$products->lastPage()"
                            :total="$products->total()"
                            :perPage="$products->perPage()"
                            :onPageChange="true"
                        />
                    </div>
                @else
                    <x-ui.empty-state
                        type="search"
                        title="No combo offers available"
                        message="Check back soon for new bundle deals."
                        action="Shop All"
                        :actionUrl="route('front.products.index')"
                    />
                @endif
            </div>
        </div>
    </x-ui.section>

    {{-- Mobile Filter Drawer --}}
    <x-ui.filter-sidebar
        :filters="[
            'category' => [
                'label' => 'Category',
                'options' => \$cats->map(fn(\$c) => ['value' => \$c->id, 'label' => \$c->name, 'count' => \$c->products_count ?? 0])->toArray(),
            ],
            'brand' => [
                'label' => 'Brand',
                'options' => \$types->map(fn(\$t) => ['value' => \$t->id, 'label' => \$t->name])->toArray(),
            ],
            'size' => [
                'label' => 'Size',
                'options' => \$sizes->map(fn(\$s) => ['value' => \$s->id, 'label' => \$s->title])->toArray(),
            ],
        ]"
        :selectedFilters="[
            'category' => request('category_id') ? [request('category_id')] : [],
            'brand' => request('brand_id') ? [request('brand_id')] : [],
            'size' => request('size_id', []),
        ]"
        :onFilterChange="true"
        drawer="true"
        id="filter-drawer"
    />
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sort change handler
        document.addEventListener('sort-change', function(e) {
            const params = new URLSearchParams(window.location.search);
            params.set('shorting', e.detail.value);
            params.set('page', '1');
            window.location.href = '{{ route("front.comboProducts") }}?' + params.toString();
        });

        // Filter toggle handler
        document.addEventEventListener('toggle-filter', function(e) {
            const params = new URLSearchParams(window.location.search);
            const key = e.detail.key;
            const value = e.detail.value;

            if (key === 'category' || key === 'brand') {
                params.set(key + '_id', value);
            } else if (key === 'size') {
                const current = params.getAll('size_id[]');
                const index = current.indexOf(value);
                if (index > -1) {
                    current.splice(index, 1);
                    params.delete('size_id[]');
                    current.forEach(v => params.append('size_id[]', v));
                } else {
                    params.append('size_id[]', value);
                }
            }
            params.set('page', '1');
            window.location.href = '{{ route("front.comboProducts") }}?' + params.toString();
        });

        // Clear all filters
        document.addEventListener('clear-all-filters', function() {
            window.location.href = '{{ route("front.comboProducts") }}';
        });

        // Apply filters in drawer
        document.addEventListener('apply-filters', function() {
            const drawer = document.getElementById('filter-drawer');
            if (drawer) {
                drawer.dispatchEvent(new CustomEvent('gm:close-drawer', { detail: { id: 'filter-drawer-overlay' } }));
            }
        });

        // Close filter drawer
        document.addEventListener('close-filter-drawer', function() {
            const drawer = document.getElementById('filter-drawer');
            if (drawer) {
                drawer.dispatchEvent(new CustomEvent('gm:close-drawer', { detail: { id: 'filter-drawer-overlay' } }));
            }
        });

        // Pagination
        document.addEventListener('page-change', function(e) {
            const params = new URLSearchParams(window.location.search);
            params.set('page', e.detail.page);
            window.location.href = '{{ route("front.comboProducts") }}?' + params.toString();
        });
    });
</script>
@endpush