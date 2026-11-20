@extends('frontend.app')

@section('title', 'Shop — GENTRY')

@section('content')
@php
$cats = $cats ?? collect();
$types = $types ?? collect();
$sizes = $sizes ?? collect();
$products = $products ?? new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12);
$selectedCategory = request('category_id');
$selectedBrand = request('brand_id');
$selectedSizes = request('size_id', []);
$sort = request('shorting', 'desc');
$searchQuery = request('q');
@endphp

<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Shop'],
        ]"
    />

    <x-ui.section size="md">
        <div class="gm-listing-layout" style="display: grid; grid-template-columns: 280px 1fr; gap: var(--s-6);">
            {{-- Desktop Sidebar --}}
            <aside class="gm-filter-sidebar--desktop" aria-label="Product filters">
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
                        'category' => \$selectedCategory ? [\$selectedCategory] : [],
                        'brand' => \$selectedBrand ? [\$selectedBrand] : [],
                        'size' => \$selectedSizes,
                    ]"
                    :onFilterChange="true"
                    drawer="false"
                />
            </aside>

            {{-- Product List --}}
            <div class="gm-listing-main">
                <div class="gm-listing-toolbar" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: var(--s-3); margin-bottom: var(--s-5); padding-bottom: var(--s-3); border-bottom: 1px solid var(--c-line);">
                    <p class="gm-listing-results" style="margin: 0; font-size: var(--t-sm); color: var(--c-ink-500);">
                        {{ \$products->total() }} product{{ \$products->total() !== 1 ? 's' : '' }} found
                    </p>

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

                @if(\$products->isNotEmpty())
                    <x-ui.product-grid>
                        @foreach(\$products as \$product)
                            <x-ui.product-card
                                :product="\$product"
                                :image="getImage('products', \$product->image)"
                                :name="\$product->name"
                                :price="getProductInfo(\$product)['price']"
                                :originalPrice="getProductInfo(\$product)['discount_amount'] > 0 ? getProductInfo(\$product)['old_price'] : null"
                                :category="optional(\$product->category)->name"
                                :badges="getProductInfo(\$product)['discount_amount'] > 0 ? [['variant' => 'sale', 'label' => 'Sale']] : (\$product->created_at && \$product->created_at->gt(now()->subDays(30)) ? [['variant' => 'new', 'label' => 'New']] : [])"
                                :href="route('front.products.show', [\$product->id])"
                                :wishlistId="'wishlist_' . \$product->id"
                            />
                        @endforeach
                    </x-ui.product-grid>

                    {{-- Pagination --}}
                    <div class="gm-pagination-wrapper" style="margin-top: var(--s-6);">
                        <x-ui.pagination
                            :currentPage="\$products->currentPage()"
                            :lastPage="\$products->lastPage()"
                            :total="\$products->total()"
                            :perPage="\$products->perPage()"
                            :onPageChange="true"
                        />
                    </div>
                @else
                    <x-ui.empty-state
                        type="search"
                        title="No products found"
                        message="Try adjusting your filters or search terms."
                        action="Clear filters"
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
            'category' => \$selectedCategory ? [\$selectedCategory] : [],
            'brand' => \$selectedBrand ? [\$selectedBrand] : [],
            'size' => \$selectedSizes,
        ]"
        :onFilterChange="true"
        drawer="true"
        id="filter-drawer"
    />
</main>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sort change handler
        document.addEventListener('sort-change', function(e) {
            const params = new URLSearchParams(window.location.search);
            params.set('shorting', e.detail.value);
            params.set('page', '1');
            window.location.href = '{{ route("front.products.index") }}?' + params.toString();
        });

        // Filter toggle handler
        document.addEventListener('toggle-filter', function(e) {
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
            window.location.href = '{{ route("front.products.index") }}?' + params.toString();
        });

        // Clear all filters
        document.addEventListener('clear-all-filters', function() {
            window.location.href = '{{ route("front.products.index") }}';
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
            window.location.href = '{{ route("front.products.index") }}?' + params.toString();
        });
    });
</script>
@endpush