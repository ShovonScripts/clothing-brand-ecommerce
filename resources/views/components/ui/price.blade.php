@props([
    'current' => 0,
    'original' => null,
    'currency' => 'BDT',
    'size' => 'md',
    'context' => 'default',
    'showDiscount' => true,
    'perUnit' => null,
])

<?php
$classes = ['gm-price', "gm-price--{$size}", "gm-price--{$context}"];
if ($showDiscount && $original && $original > $current) $classes[] = 'gm-price--inline-sale';
$class = implode(' ', $classes);

$symbol = $currency === 'BDT' ? '৳' : '$';
$currentFormatted = number_format($current, 2);
$originalFormatted = $original ? number_format($original, 2) : null;
$discountPercent = ($original && $original > $current) ? round((($original - $current) / $original) * 100) : null;
?>

<div {{ $attributes->merge(['class' => $class]) }}>
    <span class="gm-price__currency" aria-hidden="true">{{ $symbol }}</span>
    <span class="gm-price__current">{{ $currentFormatted }}</span>

    @if($original && $original > $current)
        <span class="gm-price__original">{{ $symbol }}{{ $originalFormatted }}</span>
        @if($showDiscount && $discountPercent)
            <span class="gm-price__discount">-{{ $discountPercent }}%</span>
        @endif
    @endif

    @if($perUnit)
        <span class="gm-price__unit">/{{ $perUnit }}</span>
    @endif
</div>