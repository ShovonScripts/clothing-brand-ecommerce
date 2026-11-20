@props([
    'product' => null,
    'open' => false,
    'onClose' => null,
])

<?php
if (!$product) return;
$modalId = 'gm-quick-view-' . $product->id;
$overlayId = $modalId . '-overlay';

$info = \App\Models\Information::first();
$currencySymbol = match($info->currency) {
    'BDT' => '৳',
    'Dollar' => '$',
    'Euro' => '€',
    'Rupee' => '₹',
    default => ''
};

$data = getProductInfo($product);
$hasVariations = $product->type !== 'single' && $product->variations->count();
$images = collect([$product->image])->merge($product->images->pluck('image')->toArray())->filter()->values();
$maxStock = $hasVariations ? ($product->variations->first()?->is_stock ?? $product->is_stock) : $product->is_stock;
?>

@if($open)
<div
    id="{{ $overlayId }}"
    class="gm-modal-overlay gm-modal-overlay--open"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $modalId }}-title"
>
    <div id="{{ $modalId }}" class="gm-modal gm-modal--lg gm-modal--open" style="max-width: 800px;">
        <div class="gm-modal__header">
            <h2 id="{{ $modalId }}-title" class="gm-modal__title">Quick View</h2>
            <button
                type="button"
                class="gm-modal__close"
                aria-label="Close"
            >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <div class="gm-modal__body" style="padding: 0; max-height: none;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0; min-height: 500px;">
                {{-- Gallery --}}
                <div class="gm-quick-view-gallery" style="position: relative; background: var(--c-bg-2); padding: var(--s-6);">
                    <x-ui.gallery :images="$images->toArray()" />
                </div>

                {{-- Product Info --}}
                <div class="gm-quick-view-info" style="padding: var(--s-6); overflow-y: auto; max-height: 500px;">
                    <div class="gm-quick-view-meta" style="display: flex; flex-wrap: wrap; gap: var(--s-2); margin-bottom: var(--s-2); font-size: var(--t-sm);">
                        @if($product->category)
                            <span class="gm-quick-view-category" style="color: var(--c-accent); font-weight: 500; text-transform: uppercase; letter-spacing: var(--ls-wide);">{{ $product->category->name }}</span>
                        @endif
                        @if($product->brand)
                            <span class="gm-quick-view-brand" style="color: var(--c-ink-500);">{{ $product->brand->name }}</span>
                        @endif
                    </div>

                    <h2 class="gm-quick-view-title" style="font-size: var(--t-xl); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-3); line-height: var(--lh-tight);">{{ $product->name }}</h2>

                    <x-ui.price
                        :current="$data['price']"
                        :original="$data['discount_amount'] > 0 ? $data['old_price'] : null"
                        context="pdp"
                        currency="$info->currency"
                        class="gm-quick-view-price"
                    />

                    @if($product->feature)
                        <ul class="gm-quick-view-features" style="list-style: none; padding: 0; margin: var(--s-4) 0; display: flex; flex-wrap: wrap; gap: var(--s-3) var(--s-5);">
                            @foreach(explode('<li>', strip_tags($product->feature, '<li>')) as $feature)
                                @if(trim($feature))
                                    <li style="position: relative; padding-inline-start: var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); line-height: var(--lh-base);">
                                        <span style="position: absolute; inset-inline-start: 0; top: 0.6em; width: 6px; height: 6px; border-radius: 50%; background: var(--c-accent);"></span>
                                        {{ trim($feature) }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ route('front.carts.storeCart') }}" class="gm-quick-view-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="price" :value="$data['price']">
                        <input type="hidden" name="is_stock" value="{{ $maxStock }}">
                        <input type="hidden" name="quantity" value="1">

                        @if($hasVariations)
                            <div class="gm-quick-view-variations" style="margin-bottom: var(--s-4);">
                                @foreach($product->variations as $v)
                                    @php
                                        $sizeLabel = optional($v->size)->title;
                                        $colorLabel = optional($v->color)->name;
                                        $label = $sizeLabel ?: $colorLabel ?: 'One size';
                                    @endphp
                                    <input type="hidden" class="gm-variation-option" data-id="{{ $v->id }}" data-label="{{ $label }}" data-price="{{ $v->price }}">
                                @endforeach

                                <div class="gm-variant-swatch-group" role="radiogroup" aria-label="Size options">
                                    @foreach($product->variations as $v)
                                        @php
                                            $sizeLabel = optional($v->size)->title;
                                            $colorLabel = optional($v->color)->name;
                                            $label = $sizeLabel ?: $colorLabel ?: 'One size';
                                            $isFirst = $loop->first;
                                        @endphp
                                        <x-ui.variant-swatch
                                            :value="$v->id"
                                            :label="$label"
                                            :selected="$isFirst"
                                            :disabled="$v->is_stock <= 0"
                                            size="md"
                                        />
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="variation_id" value="{{ $product->variation->id ?? '' }}">
                        @endif

                        <div class="gm-quick-view-quantity" style="display: flex; align-items: center; gap: var(--s-4); margin-bottom: var(--s-4);">
                            <label for="quick-view-qty" class="gm-qty-label" style="font-size: var(--t-xs); font-weight: 500; letter-spacing: var(--ls-wide); text-transform: uppercase; color: var(--c-ink-900); white-space: nowrap;">Quantity</label>
                            <x-ui.quantity-stepper
                                name="quantity"
                                :value="$quantity ?? 1"
                                :min="1"
                                :max="$maxStock"
                                :stock="$maxStock"
                                size="md"
                                inline
                            />
                        </div>

                        <div class="gm-quick-view-actions" style="display: flex; flex-direction: column; gap: var(--s-3);">
                            <x-ui.button
                                variant="primary"
                                size="lg"
                                full
                                type="submit"
                                :disabled="$maxStock <= 0"
                            >
                                @if($maxStock <= 0)
                                    Out of Stock
                                @else
                                    Add to Bag
                                @endif
                            </x-ui.button>

                            @auth
                                <x-ui.button
                                    variant="ghost"
                                    size="md"
                                    full
                                    :active="$product->in_wishlist ?? false"
                                >
                                    Save for later
                                </x-ui.button>
                            @else
                                <a href="{{ route('login') }}" class="gm-btn gm-btn--ghost gm-btn--md gm-btn--full" style="text-align: center;">Sign in to save</a>
                            @endauth
                        </div>
                    </form>

                    {{-- Delivery Info --}}
                    <div class="gm-quick-view-delivery" style="display: flex; flex-wrap: wrap; gap: var(--s-3) var(--s-5); padding-top: var(--s-4); border-top: 1px solid var(--c-line); margin-top: var(--s-4);">
                        <div class="gm-quick-view-delivery-item" style="display: inline-flex; align-items: center; gap: var(--s-2); font-size: var(--t-sm); color: var(--c-ink-700);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                            <span>Free delivery over {{ $currencySymbol }} 5,000</span>
                        </div>
                        <div class="gm-quick-view-delivery-item" style="display: inline-flex; align-items: center; gap: var(--s-2); font-size: var(--t-sm); color: var(--c-ink-700);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                            <span>14-day easy returns</span>
                        </div>
                        <div class="gm-quick-view-delivery-item" style="display: inline-flex; align-items: center; gap: var(--s-2); font-size: var(--t-sm); color: var(--c-ink-700);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><rect x="2" y="2" width="20" height="20" rx="2"></rect><line x1="2" y1="12" x2="22" y2="12"></line></svg>
                            <span>Secure payment</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    (function() {
        const overlay = document.getElementById('{{ $overlayId }}');
        if (!overlay) return;

        // Variant change handler
        document.addEventListener('variant-change', function(e) {
            const { id, price, stock } = e.detail;
            const priceEls = document.querySelectorAll('[data-gm-price]');
            priceEls.forEach(el => {
                el.textContent = '{{ $currencySymbol }} ' + price.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            });
            document.querySelectorAll('input[name="price"]').forEach(input => input.value = price);
            document.querySelectorAll('input[name="is_stock"]').forEach(input => input.value = stock);

            const qtyInputs = document.querySelectorAll('input[name="quantity"]');
            qtyInputs.forEach(input => {
                input.max = stock;
            });
        });

        // Close on escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && overlay.classList.contains('gm-modal-overlay--open')) {
                overlay.dispatchEvent(new CustomEvent('gm:close-modal', { detail: { id: '{{ $overlayId }}' } }));
            }
        });
    })();
</script>
@endpush