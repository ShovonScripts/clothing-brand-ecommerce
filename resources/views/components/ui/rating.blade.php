@props([
    'value' => 0,
    'max' => 5,
    'count' => 0,
    'readonly' => true,
    'size' => 'md',
    'showCount' => true,
    'showBreakdown' => false,
    'name' => 'rating',
    'onChange' => null,
])

<?php
$classes = ['gm-rating', "gm-rating--{$size}"];
if ($readonly) $classes[] = 'gm-rating--readonly';
if ($showCount && !$showBreakdown) $classes[] = 'gm-rating--inline';
$class = implode(' ', $classes);

$fullStars = floor($value);
$hasHalf = ($value - $fullStars) >= 0.5;
$emptyStars = $max - $fullStars - ($hasHalf ? 1 : 0);
?>

<div {{ $attributes->merge(['class' => $class, 'role' => 'img', 'aria-label' => "Rated {$value} out of {$max} stars"]) }}>
    <div class="gm-rating__stars">
        @for($i = 0; $i < $fullStars; $i++)
            <svg class="gm-rating__star gm-rating__star--filled" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
        @endfor

        @if($hasHalf)
            <svg class="gm-rating__star gm-rating__star--half" viewBox="0 0 24 24" aria-hidden="true">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" class="gm-rating__star--filled"></polygon>
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" class="gm-rating__star--empty" style="fill: var(--c-line)"></polygon>
            </svg>
        @endif

        @for($i = 0; $i < $emptyStars; $i++)
            <svg class="gm-rating__star gm-rating__star--empty" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
        @endfor
    </div>

    @if(!$readonly)
        <input type="hidden" name="{{ $name }}" value="{{ $value }}" {{ $attributes->get('wire:model') ? 'wire:model="value"' : '' }}>
    @endif

    @if($showCount)
        <span class="gm-rating__count">({{ $count }})</span>
    @endif

    @if($showBreakdown && $count > 0)
        <div class="gm-rating__breakdown" aria-label="Rating breakdown">
            @for($i = $max; $i >= 1; $i--)
                @php
                    $percent = $count > 0 ? 0 : 0; // Would need actual distribution data
                @endphp
                <div class="gm-rating__bar">
                    <span class="gm-rating__bar-label">{{ $i }}★</span>
                    <div class="gm-rating__bar-track">
                        <div class="gm-rating__bar-fill" style="width: {{ $percent }}%"></div>
                    </div>
                    <span class="gm-rating__bar-count">0</span>
                </div>
            @endfor
        </div>
    @endif
</div>

@if(!$readonly)
@push('scripts')
<script>
    (function() {
        const container = document.currentScript?.previousElementSibling;
        if (!container) return;

        const stars = container.querySelectorAll('.gm-rating__star');
        const input = container.querySelector('input[type="hidden"]');
        if (!input) return;

        stars.forEach((star, index) => {
            star.classList.add('gm-rating__star--interactive');
            star.addEventListener('click', () => {
                const value = index + 1;
                input.value = value;
                input.dispatchEvent(new Event('change', { bubbles: true }));

                stars.forEach((s, i) => {
                    s.classList.toggle('gm-rating__star--filled', i < value);
                    s.classList.toggle('gm-rating__star--empty', i >= value);
                    s.classList.remove('gm-rating__star--half');
                });
            });

            star.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowRight' && index < stars.length - 1) {
                    e.preventDefault();
                    stars[index + 1].focus();
                }
                if (e.key === 'ArrowLeft' && index > 0) {
                    e.preventDefault();
                    stars[index - 1].focus();
                }
            });
        });
    })();
</script>
@endpush
@endif