@props([
    // key => ['label' => 'Category', 'type' => 'checkbox'|'radio', 'options' => [['value' => 1, 'label' => 'Shirts'], ...]]
    // The key is used as the input name: checkbox groups submit "key[]", radio groups submit "key".
    'filters' => [],
    // key => selected value(s) from the current request
    'selected' => [],
    'title' => 'Filters',
])

{{--
    Plain form fields only — place this inside a <form>. The page decides how
    the form is submitted (see frontend/products/index.blade.php).
--}}
<aside {{ $attributes->merge(['class' => 'gm-filter-sidebar']) }} data-gm-filter-sidebar>
    <div class="gm-filter-sidebar__header">
        <h2 class="gm-filter-sidebar__title">{{ $title }}</h2>
        <button type="button" class="gm-filter-sidebar__clear" data-gm-clear-filters>Clear all</button>
    </div>

    @foreach($filters as $key => $filter)
        @php
            $type = ($filter['type'] ?? 'checkbox') === 'radio' ? 'radio' : 'checkbox';
            $inputName = $type === 'checkbox' ? $key . '[]' : $key;
            $current = array_map('strval', (array) ($selected[$key] ?? []));
            $label = $filter['label'] ?? ucfirst($key);
        @endphp

        @if(!empty($filter['options']))
            <details class="gm-filter-sidebar__section" open>
                <summary class="gm-filter-sidebar__section-title">
                    {{ $label }}
                    <span class="gm-filter-sidebar__section-icon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </span>
                </summary>

                <div class="gm-filter-sidebar__section-content">
                    <div class="gm-filter-group" role="group" aria-label="{{ $label }}">
                        @foreach($filter['options'] as $option)
                            @php
                                $value = (string) ($option['value'] ?? $option);
                                $isSelected = in_array($value, $current, true)
                                    || ($type === 'radio' && $value === '' && empty($current));
                            @endphp
                            <label class="gm-filter-group__label">
                                <input
                                    type="{{ $type }}"
                                    class="gm-filter-group__input"
                                    name="{{ $inputName }}"
                                    value="{{ $value }}"
                                    @checked($isSelected)
                                >
                                <span class="gm-filter-group__check" aria-hidden="true"></span>
                                <span>{{ $option['label'] ?? $value }}</span>
                                @isset($option['count'])
                                    <span class="gm-filter-group__count">({{ $option['count'] }})</span>
                                @endisset
                            </label>
                        @endforeach
                    </div>
                </div>
            </details>
        @endif
    @endforeach

    {{ $slot }}
</aside>
