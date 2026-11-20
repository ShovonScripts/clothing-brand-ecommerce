@props([
    'filters' => [],
    'priceRange' => ['min' => 0, 'max' => 10000],
    'selectedFilters' => [],
    'onFilterChange' => null,
    'drawer' => false,
    'open' => false,
])

<?php
$classes = ['gm-filter-sidebar'];
if ($drawer) $classes[] = 'gm-filter-sidebar--drawer';
if ($drawer && $open) $classes[] = 'gm-filter-sidebar--open';
if (!$drawer) $classes[] = 'gm-filter-sidebar--desktop';
$class = implode(' ', $classes);

$filterId = 'gm-filter-' . uniqid();
?>

@if($drawer)
    <div class="gm-drawer-overlay {{ $open ? 'gm-drawer-overlay--open' : '' }}" data-gm-filter-drawer-close wire:click="$dispatch('close-filter-drawer')"></div>
@endif

<aside {{ $attributes->merge(['class' => $class, 'id' => $filterId, 'data-gm-filter-sidebar' => '']) }}>
    <div class="gm-filter-sidebar__header">
        <h2 class="gm-filter-sidebar__title">Filters</h2>
        @if(count($selectedFilters))
            <button
                type="button"
                class="gm-filter-sidebar__clear"
                @if($onFilterChange) wire:click="$dispatch('clear-all-filters')" @endif
            >
                Clear all
            </button>
        @endif
    </div>

    @foreach($filters as $key => $filter)
        @php
            $filterId = 'filter-' . $key;
            $isOpen = true; // Could be persisted
        @endphp

        <details class="gm-filter-sidebar__section" {{ $isOpen ? 'open' : '' }} id="{{ $filterId }}">
            <summary class="gm-filter-sidebar__section-title">
                {{ $filter['label'] ?? ucfirst($key) }}
                <span class="gm-filter-sidebar__section-icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </summary>

            <div class="gm-filter-sidebar__section-content">
                @if($key === 'price')
                    <div class="gm-filter-price">
                        <div class="gm-filter-price__inputs">
                            <x-ui.input
                                type="number"
                                name="{{ $key }}_min"
                                :value="$selectedFilters[$key]['min'] ?? $priceRange['min']"
                                :min="$priceRange['min']"
                                :max="$priceRange['max']"
                                placeholder="Min"
                                size="sm"
                                class="gm-filter-price__input"
                                @if($onFilterChange) wire:model.debounce.300ms="selectedFilters.{{ $key }}.min" @endif
                            />
                            <span class="gm-filter-price__separator" aria-hidden="true">—</span>
                            <x-ui.input
                                type="number"
                                name="{{ $key }}_max"
                                :value="$selectedFilters[$key]['max'] ?? $priceRange['max']"
                                :min="$priceRange['min']"
                                :max="$priceRange['max']"
                                placeholder="Max"
                                size="sm"
                                class="gm-filter-price__input"
                                @if($onFilterChange) wire:model.debounce.300ms="selectedFilters.{{ $key }}.max" @endif
                            />
                        </div>
                        <input
                            type="range"
                            class="gm-filter-price__slider"
                            min="{{ $priceRange['min'] }}"
                            max="{{ $priceRange['max'] }}"
                            :value="$selectedFilters[$key]['min'] ?? $priceRange['min']"
                            @if($onFilterChange) wire:model.debounce.300ms="selectedFilters.{{ $key }}.min" @endif
                        >
                        <div class="gm-filter-price__values">
                            <span>{{ $symbol }}{{ number_format($priceRange['min']) }}</span>
                            <span>{{ $symbol }}{{ number_format($priceRange['max']) }}</span>
                        </div>
                    </div>
                @elseif($key === 'color')
                    <div class="gm-filter-colors" role="group" aria-label="Colors">
                        @foreach($filter['options'] as $color)
                            @php
                                $colorValue = $color['value'] ?? $color;
                                $colorLabel = $color['label'] ?? $colorValue;
                                $colorHex = $color['hex'] ?? null;
                                $isSelected = in_array($colorValue, $selectedFilters[$key] ?? []);
                            @endphp
                            <button
                                type="button"
                                class="gm-filter-color {{ $isSelected ? 'gm-filter-color--selected' : '' }}"
                                :style="$colorHex ? 'background: ' . $colorHex : ''"
                                @if($onFilterChange) wire:click="$dispatch('toggle-filter', { key: '{{ $key }}', value: '{{ $colorValue }}' })" @endif
                                aria-label="{{ $colorLabel }}"
                                aria-pressed="{{ $isSelected ? 'true' : 'false' }}"
                                title="{{ $colorLabel }}"
                            ></button>
                        @endforeach
                    </div>
                @else
                    <div class="gm-filter-group" role="group" aria-label="{{ $filter['label'] ?? ucfirst($key) }}">
                        @foreach($filter['options'] as $option)
                            @php
                                $optionValue = $option['value'] ?? $option;
                                $optionLabel = $option['label'] ?? $optionValue;
                                $optionCount = $option['count'] ?? null;
                                $isSelected = in_array($optionValue, $selectedFilters[$key] ?? []);
                            @endphp
                            <label class="gm-filter-group__label">
                                <input
                                    type="checkbox"
                                    class="gm-filter-group__input"
                                    name="{{ $key }}[]"
                                    value="{{ $optionValue }}"
                                    @if($isSelected) checked @endif
                                    @if($onFilterChange) wire:click="$dispatch('toggle-filter', { key: '{{ $key }}', value: '{{ $optionValue }}' })" @endif
                                >
                                <span class="gm-filter-group__check" aria-hidden="true"></span>
                                <span>{{ $optionLabel }}</span>
                                @if($optionCount !== null)
                                    <span class="gm-filter-group__count">({{ $optionCount }})</span>
                                @endif
                            </label>
                        @endforeach
                    </div>
                @endif
            </div>
        </details>
    @endforeach

    @if($drawer)
        <div class="gm-drawer__footer" style="margin-top: var(--s-4); padding-top: var(--s-4); border-top: 1px solid var(--c-line); display: flex; gap: var(--s-2);">
            <x-ui.button variant="ghost" full @if($onFilterChange) wire:click="$dispatch('clear-all-filters')" @endif>Clear All</x-ui.button>
            <x-ui.button variant="primary" full @if($onFilterChange) wire:click="$dispatch('apply-filters')" @endif>Apply</x-ui.button>
        </div>
    @endif
</aside>

@push('scripts')
<script>
    (function() {
        // Mobile drawer toggle
        window.addEventListener('gm:open-filter-drawer', () => {
            const drawer = document.getElementById('{{ $filterId }}');
            const overlay = drawer?.previousElementSibling;
            if (drawer && overlay) {
                drawer.classList.add('gm-filter-sidebar--open');
                overlay.classList.add('gm-drawer-overlay--open');
                document.body.style.overflow = 'hidden';
            }
        });

        window.addEventListener('gm:close-filter-drawer', () => {
            const drawer = document.getElementById('{{ $filterId }}');
            const overlay = drawer?.previousElementSibling;
            if (drawer && overlay) {
                drawer.classList.remove('gm-filter-sidebar--open');
                overlay.classList.remove('gm-drawer-overlay--open');
                document.body.style.overflow = '';
            }
        });

        // Close on escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const drawer = document.getElementById('{{ $filterId }}');
                if (drawer?.classList.contains('gm-filter-sidebar--open')) {
                    drawer.dispatchEvent(new CustomEvent('gm:close-filter-drawer'));
                }
            }
        });
    })();
</script>
@endpush