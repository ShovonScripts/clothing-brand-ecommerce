@extends('backend.app')

@section('content')
@php
$customers = $customers ?? collect();
$products = $products ?? collect();
$statuses = $statuses ?? getOrderStatus() ?? [];
$couriers = $couriers ?? collect();
$assignUsers = $assignUsers ?? collect();
$currencySymbol = config('app.currency_symbol') ?? '৳';
@endphp

<form method="POST" action="{{ route('admin.orders.store') }}" class="gm-admin-form" novalidate>
    @csrf

    {{-- Save Bar --}}
    <x-admin.save-bar
        :dirty="$wire.dirty ?? false"
        :saving="$wire.saving ?? false"
        onSave="submit"
        onCancel="goBack"
        saveText="Create Order"
        cancelText="Cancel"
    />

    <div class="gm-admin-form-layout" style="display: grid; grid-template-columns: 1fr 380px; gap: var(--s-8);">
        {{-- Main Form --}}
        <div class="gm-admin-form-main">
            <x-admin.form-row
                :fields="[
                    ['key' => 'first_name', 'label' => 'First Name', 'type' => 'text', 'required' => true, 'placeholder' => 'First name'],
                    ['key' => 'last_name', 'label' => 'Last Name', 'type' => 'text', 'required' => true, 'placeholder' => 'Last name'],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'email', 'label' => 'Email', 'type' => 'email', 'placeholder' => 'customer@example.com'],
                    ['key' => 'mobile', 'label' => 'Phone', 'type' => 'tel', 'required' => true, 'placeholder' => '01XXXXXXXXX'],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'shipping_address', 'label' => 'Shipping Address', 'type' => 'textarea', 'rows' => 3, 'required' => true, 'placeholder' => 'Full delivery address'],
                ]"
                :columns="1"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'status', 'label' => 'Order Status', 'type' => 'select', 'required' => true, 'options' => array_merge([['value' => '', 'label' => 'Select Status']], collect($statuses)->map(fn(\$v, \$k) => ['value' => \$k, 'label' => ucfirst(str_replace('_', ' ', \$k))])->toArray())],
                    ['key' => 'courier_id', 'label' => 'Courier', 'type' => 'select', 'options' => \$couriers->pluck('name', 'id')->prepend(['', 'Select Courier'])->toArray()],
                ]"
            />

            <x-admin.form-row
                :fields="[
                    ['key' => 'assign_user_id', 'label' => 'Assigned To', 'type' => 'select', 'options' => \$assignUsers->pluck('name', 'id')->prepend(['', 'Unassigned'])->toArray()],
                    ['key' => 'payment_method', 'label' => 'Payment Method', 'type' => 'select', 'options' => [['value' => '', 'label' => 'Select Method'], ['value' => 'cash', 'label' => 'Cash on Delivery'], ['value' => 'bkash', 'label' => 'bKash'], ['value' => 'card', 'label' => 'Card/Online']]],
                ]"
            />


            {{-- Order Items --}}
            <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); margin-top: var(--s-6);">
                <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4);">Order Items</h3>
                
                <div id="order-items" style="display: flex; flex-direction: column; gap: var(--s-3);">
                    {{-- Initial empty row --}}
                    <div class="order-item-row" style="display: grid; grid-template-columns: 60px 1fr 80px 100px 100px 80px 80px 60px; gap: var(--s-2); align-items: center; padding: var(--s-3); background: var(--c-bg-2); border-radius: var(--r-md);">
                        <div style="width: 60px; height: 60px; border-radius: var(--r-md); background: var(--c-bg); display: flex; align-items: center; justify-content: center;">
                            <x-ui.skeleton variant="box" style="width: 100%; height: 100%;" />
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 2px;">
                            <select name="items[0][product_id]" class="gm-input gm-input--sm product-select" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->sell_price }}" data-stock="{{ $product->is_stock }}" data-sku="{{ $product->sku }}">{{ $product->name }} ({{ $product->sku }})</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="items[0][variation_id]" class="variation-id-input">
                        </div>
                        <input type="text" name="items[0][size]" class="gm-input gm-input--sm" placeholder="Size" readonly style="background: var(--c-bg-2);">
                        <input type="text" name="items[0][color]" class="gm-input gm-input--sm" placeholder="Color" readonly style="background: var(--c-bg-2);">
                        <input type="number" name="items[0][quantity]" class="gm-input gm-input--sm" value="1" min="1" max="99" style="width: 80px;">
                        <input type="number" name="items[0][price]" class="gm-input gm-input--sm" step="0.01" min="0" placeholder="0.00" style="width: 100px;">
                        <input type="number" name="items[0][discount]" class="gm-input gm-input--sm" step="0.01" min="0" value="0" placeholder="0.00" style="width: 80px;">
                        <div style="font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900);" class="subtotal-display">0.00</div>
                        <button type="button" class="gm-btn gm-btn--ghost gm-btn--sm gm-btn--danger remove-item" style="width: 36px; height: 36px; padding: 0;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        </button>
                    </div>
                </div>
                
                <div style="margin-top: var(--s-3);">
                    <button type="button" id="add-item-btn" class="gm-btn gm-btn--secondary gm-btn--sm">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add Item
                    </button>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="gm-admin-form-sidebar">
            <div style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); position: sticky; top: calc(var(--header-h) + var(--s-4));">
                <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4); padding-bottom: var(--s-3); border-bottom: 1px solid var(--c-line);">Order Summary</h3>

                <div style="display: flex; flex-direction: column; gap: var(--s-3); margin-bottom: var(--s-4);">
                    <div style="display: flex; justify-content: space-between; color: var(--c-ink-700);">
                        <span>Subtotal</span>
                        <span id="summary-subtotal" style="font-weight: 500; font-family: var(--f-display);">{{ $currencySymbol }} 0.00</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; color: var(--c-ink-700);">
                        <span>Discount</span>
                        <span id="summary-discount" style="font-weight: 500; font-family: var(--f-display); color: var(--c-success);">-{{ $currencySymbol }} 0.00</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; color: var(--c-ink-700);">
                        <span>Shipping</span>
                        <span id="summary-shipping" style="font-weight: 500; font-family: var(--f-display);">{{ $currencySymbol }} 0.00</span>
                    </div>
                </div>

                <div style="border-top: 2px solid var(--c-line); padding-top: var(--s-3);">
                    <div style="display: flex; justify-content: space-between; font-size: var(--t-lg); font-weight: 600; font-family: var(--f-display); color: var(--c-ink-900);">
                        <span>Total</span>
                        <span id="summary-total" style="font-family: var(--f-display);">{{ $currencySymbol }} 0.00</span>
                    </div>
                </div>

                <hr style="margin: var(--s-4) 0; border-color: var(--c-line);">

                <h3 style="font-size: var(--t-sm); font-weight: 600; color: var(--c-ink-900); margin: 0 0 var(--s-3); text-transform: uppercase; letter-spacing: var(--ls-wide);">Payment & Shipping</h3>

                <x-admin.form-row
                    :fields="[
                        ['key' => 'payment_method', 'label' => 'Payment Method', 'type' => 'select', 'required' => true, 'options' => [['value' => 'cash', 'label' => 'Cash on Delivery'], ['value' => 'bkash', 'label' => 'bKash'], ['value' => 'card', 'label' => 'Card/Online']]],
                        ['key' => 'courier_id', 'label' => 'Courier', 'type' => 'select', 'options' => \$couriers->pluck('name', 'id')->prepend(['', 'Select Courier'])->toArray()],
                    ]"
                />

                <x-admin.form-row
                    :fields="[
                        ['key' => 'assign_user_id', 'label' => 'Assigned To', 'type' => 'select', 'options' => \$assignUsers->pluck('name', 'id')->prepend(['', 'Unassigned'])->toArray()],
                    ]"
                    :columns="1"
                />

                <x-admin.form-row
                    :fields="[
                        ['key' => 'notes', 'label' => 'Admin Notes', 'type' => 'textarea', 'rows' => 3, 'placeholder' => 'Internal notes...'],
                    ]"
                    :columns="1"
                />
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.gm-admin-form');
        if (!form) return;

        let isDirty = false;
        const inputs = form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('change', () => { isDirty = true; });
            input.addEventListener('input', () => { isDirty = true; });
        });

        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('gm-btn--loading');
            }
        });

        // Product select handler
        document.addEventListener('change', function(e) {
            if (e.target.matches('.product-select')) {
                const select = e.target;
                const option = select.options[select.selectedIndex];
                const row = select.closest('.order-item-row');
                
                if (option.value) {
                    const price = option.dataset.price;
                    const stock = option.dataset.stock;
                    const sku = option.dataset.sku;
                    
                    row.querySelector('input[name$="[price]"]').value = parseFloat(price).toFixed(2);
                    row.querySelector('input[name$="[quantity]"]').max = stock;
                    row.querySelector('input[name$="[size]"]').value = ''; // Will be filled from variation
                    row.querySelector('input[name$="[color]"]').value = ''; // Will be filled from variation
                    updateSubtotal(row);
                    updateSummary();
                } else {
                    row.querySelector('input[name$="[price]"]').value = '';
                    row.querySelector('input[name$="[quantity]"]').value = '1';
                    row.querySelector('input[name$="[size]"]').value = '';
                    row.querySelector('input[name$="[color]"]').value = '';
                    updateSubtotal(row);
                    updateSummary();
                }
            }
        });

        // Quantity/price change
        document.addEventListener('input', function(e) {
            if (e.target.matches('input[name$="[quantity]"], input[name$="[price]"], input[name$="[discount]"]')) {
                const row = e.target.closest('.order-item-row');
                updateSubtotal(row);
                updateSummary();
            }
        });

        // Add item
        document.getElementById('add-item-btn')?.addEventListener('click', function() {
            const container = document.getElementById('order-items');
            const index = container.querySelectorAll('.order-item-row').length;
            
            const row = document.createElement('div');
            row.className = 'order-item-row';
            row.style.cssText = 'display: grid; grid-template-columns: 60px 1fr 80px 100px 100px 80px 80px 60px; gap: var(--s-2); align-items: center; padding: var(--s-3); background: var(--c-bg-2); border-radius: var(--r-md);';
            
            const productOptions = Array.from(document.querySelector('.product-select').options).map(opt => 
                opt.value ? `<option value="${opt.value}" data-price="${opt.dataset.price}" data-stock="${opt.dataset.stock}" data-sku="${opt.dataset.sku}">${opt.text}</option>` : opt.outerHTML
            ).join('');

            row.innerHTML = `
                <div style="width: 60px; height: 60px; border-radius: var(--r-md); background: var(--c-bg); display: flex; align-items: center; justify-content: center;">
                    <x-ui.skeleton variant="box" style="width: 100%; height: 100%;" />
                </div>
                <div style="display: flex; flex-direction: column; gap: 2px;">
                    <select name="items[${index}][product_id]" class="gm-input gm-input--sm product-select" required>
                        ${productOptions}
                    </select>
                    <input type="hidden" name="items[${index}][variation_id]" class="variation-id-input">
                </div>
                <input type="text" name="items[${index}][size]" class="gm-input gm-input--sm" placeholder="Size" readonly style="background: var(--c-bg-2);">
                <input type="text" name="items[${index}][color]" class="gm-input gm-input--sm" placeholder="Color" readonly style="background: var(--c-bg-2);">
                <input type="number" name="items[${index}][quantity]" class="gm-input gm-input--sm" value="1" min="1" max="99" style="width: 80px;">
                <input type="number" name="items[${index}][price]" class="gm-input gm-input--sm" step="0.01" min="0" placeholder="0.00" style="width: 100px;">
                <input type="number" name="items[${index}][discount]" class="gm-input gm-input--sm" step="0.01" min="0" value="0" placeholder="0.00" style="width: 80px;">
                <div style="font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900);" class="subtotal-display">0.00</div>
                <button type="button" class="gm-btn gm-btn--ghost gm-btn--sm gm-btn--danger remove-item" style="width: 36px; height: 36px; padding: 0;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                </button>
            `;
            container.appendChild(row);
        });

        // Remove item
        document.addEventListener('click', function(e) {
            if (e.target.matches('.remove-item, .remove-item *')) {
                const btn = e.target.closest('.remove-item');
                const row = btn.closest('.order-item-row');
                row.remove();
                updateSummary();
            }
        });

        function updateSubtotal(row) {
            const qty = parseFloat(row.querySelector('input[name$="[quantity]"]').value) || 0;
            const price = parseFloat(row.querySelector('input[name$="[price]"]').value) || 0;
            const discount = parseFloat(row.querySelector('input[name$="[discount]"]').value) || 0;
            const subtotal = (qty * price) - discount;
            row.querySelector('.subtotal-display').textContent = subtotal.toFixed(2);
        }

        function updateSummary() {
            let subtotal = 0;
            let totalDiscount = 0;
            
            document.querySelectorAll('.order-item-row').forEach(row => {
                const qty = parseFloat(row.querySelector('input[name$="[quantity]"]').value) || 0;
                const price = parseFloat(row.querySelector('input[name$="[price]"]').value) || 0;
                const discount = parseFloat(row.querySelector('input[name$="[discount]"]').value) || 0;
                
                subtotal += qty * price;
                totalDiscount += discount;
            });
            
            const shipping = 0; // Calculate based on courier
            const total = subtotal - totalDiscount + shipping;
            
            document.getElementById('summary-subtotal')?.textContent = '{{ $currencySymbol }} ' + subtotal.toFixed(2);
            document.getElementById('summary-discount')?.textContent = '-{{ $currencySymbol }} ' + totalDiscount.toFixed(2);
            document.getElementById('summary-shipping')?.textContent = '{{ $currencySymbol }} ' + shipping.toFixed(2);
            document.getElementById('summary-total')?.textContent = '{{ $currencySymbol }} ' + total.toFixed(2);
        }

        // Form submit
        const form = document.querySelector('.gm-admin-form');
        form?.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('gm-btn--loading');
            }
        });

        // Go back handler
        window.goBack = function() {
            if (confirm('You have unsaved changes. Leave anyway?')) {
                window.history.back();
            }
        };
    });
</script>
@endpush