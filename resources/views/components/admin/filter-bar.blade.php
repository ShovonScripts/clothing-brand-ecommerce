@props([
    'filters' => [],
    'search' => null,
    'searchPlaceholder' => 'Search...',
    'searchUrl' => null,
    'onSearch' => null,
    'onFilterChange' => null,
])

<div class="gm-admin-filter-bar" {{ $attributes }}>
    @if($search !== null)
        <div class="gm-admin-filter-bar__search" role="search">
            <svg class="gm-admin-filter-bar__search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input
                type="search"
                name="q"
                class="gm-admin-filter-bar__search-input"
                placeholder="{{ $searchPlaceholder }}"
                value="{{ $search }}"
                @if($onSearch) wire:model.debounce.300ms="search" @endif
                @if($searchUrl) wire:change="$dispatch('filter-change', { search: \$event.target.value })" @endif
            >
        </div>
    @endif

    @foreach($filters as $key => $filter)
        <div class="gm-admin-filter-bar__group">
            @if(isset($filter['label']))
                <label for="filter-{{ $key }}" class="gm-admin-filter-bar__label">{{ $filter['label'] }}</label>
            @endif

            @if($filter['type'] === 'select')
                <x-ui.select
                    id="filter-{{ $key }}"
                    name="{{ $key }}"
                    :value="request($key)"
                    :options="$filter['options']"
                    class="gm-admin-filter-bar__select"
                    @if($onFilterChange) wire:change="$dispatch('filter-change', { key: '{{ $key }}', value: \$event.target.value })" @endif
                />
            @elseif($filter['type'] === 'date')
                <x-ui.input
                    id="filter-{{ $key }}"
                    name="{{ $key }}"
                    type="date"
                    :value="request($key)"
                    size="sm"
                    @if($onFilterChange) wire:change="$dispatch('filter-change', { key: '{{ $key }}', value: \$event.target.value })" @endif
                />
            @elseif($filter['type'] === 'daterange')
                <div style="display: flex; align-items: center; gap: var(--s-1);">
                    <x-ui.input
                        id="filter-{{ $key }}-from"
                        name="{{ $key }}_from"
                        type="date"
                        :value="request($key . '_from')"
                        size="sm"
                        placeholder="From"
                        @if($onFilterChange) wire:change="$dispatch('filter-change', { key: '{{ $key }}_from', value: \$event.target.value })" @endif
                    />
                    <span style="color: var(--c-ink-500);">to</span>
                    <x-ui.input
                        id="filter-{{ $key }}-to"
                        name="{{ $key }}_to"
                        type="date"
                        :value="request($key . '_to')"
                        size="sm"
                        placeholder="To"
                        @if($onFilterChange) wire:change="$dispatch('filter-change', { key: '{{ $key }}_to', value: \$event.target.value })" @endif
                    />
                </div>
            @else
                <x-ui.input
                    id="filter-{{ $key }}"
                    name="{{ $key }}"
                    :value="request($key)"
                    size="sm"
                    :placeholder="$filter['placeholder'] ?? 'Filter...'"
                    @if($onFilterChange) wire:model.debounce.300ms="filters.{{ $key }}" @endif
                />
            @endif
        </div>
    @endforeach

    <div class="gm-admin-filter-bar__actions">
        @if($filters->count() || $search !== null)
            <x-ui.button variant="ghost" size="sm" wire:click="$dispatch('clear-filters')">
                Clear
            </x-ui.button>
        @endif
    </div>
</div>