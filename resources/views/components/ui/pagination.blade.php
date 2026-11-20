@props([
    'currentPage' => 1,
    'lastPage' => 1,
    'total' => 0,
    'perPage' => 15,
    'onPageChange' => null,
])

<?php
$range = 2;
$start = max(1, $currentPage - $range);
$end = min($lastPage, $currentPage + $range);

if ($start > 1) $start = max(1, $end - 2 * $range);
if ($end < $lastPage) $end = min($lastPage, $start + 2 * $range);
?>

<nav {{ $attributes->merge(['class' => 'gm-pagination', 'aria-label' => 'Pagination']) }}>
    <ul class="gm-pagination__list">
        {{-- Previous --}}
        <li class="gm-pagination__item">
            <button
                type="button"
                class="gm-pagination__btn"
                {{ $currentPage <= 1 ? 'disabled' : '' }}
                @if($onPageChange) wire:click="$dispatch('page-change', { page: {{ $currentPage - 1 }} })" @endif
                aria-label="Previous page"
            >
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
        </li>

        {{-- First page --}}
        @if($start > 1)
            <li class="gm-pagination__item">
                <button
                    type="button"
                    class="gm-pagination__link"
                    @if($onPageChange) wire:click="$dispatch('page-change', { page: 1 })" @endif
                >1</button>
            </li>
            @if($start > 2)
                <li class="gm-pagination__item"><span class="gm-pagination__ellipsis" aria-hidden="true">…</span></li>
            @endif
        @endif

        {{-- Page numbers --}}
        @for($i = $start; $i <= $end; $i++)
            <li class="gm-pagination__item">
                @if($i === $currentPage)
                    <span class="gm-pagination__btn" aria-current="page">{{ $i }}</span>
                @else
                    <button
                        type="button"
                        class="gm-pagination__link"
                        @if($onPageChange) wire:click="$dispatch('page-change', { page: {{ $i }} })" @endif
                    >{{ $i }}</button>
                @endif
            </li>
        @endfor

        {{-- Last page --}}
        @if($end < $lastPage)
            @if($end < $lastPage - 1)
                <li class="gm-pagination__item"><span class="gm-pagination__ellipsis" aria-hidden="true">…</span></li>
            @endif
            <li class="gm-pagination__item">
                <button
                    type="button"
                    class="gm-pagination__link"
                    @if($onPageChange) wire:click="$dispatch('page-change', { page: {{ $lastPage }} })" @endif
                >{{ $lastPage }}</button>
            </li>
        @endif

        {{-- Next --}}
        <li class="gm-pagination__item">
            <button
                type="button"
                class="gm-pagination__btn"
                {{ $currentPage >= $lastPage ? 'disabled' : '' }}
                @if($onPageChange) wire:click="$dispatch('page-change', { page: {{ $currentPage + 1 }} })" @endif
                aria-label="Next page"
            >
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
        </li>
    </ul>

    @if($total > 0)
        <div class="gm-pagination__info" aria-live="polite">
            Showing {{ ($currentPage - 1) * $perPage + 1 }} to {{ min($currentPage * $perPage, $total) }} of {{ $total }} results
        </div>
    @endif
</nav>