@props([
    'items' => [],
    'size' => 'md',
])

<?php
$classes = ['gm-breadcrumb', "gm-breadcrumb--{$size}"];
?>

<nav {{ $attributes->merge(['class' => implode(' ', $classes), 'aria-label' => 'Breadcrumb']) }}>
    <ol class="gm-breadcrumb__list">
        @foreach($items as $index => $item)
            <li class="gm-breadcrumb__item" {{ $loop->last ? 'aria-current="page"' : '' }}>
                @if(!$loop->last && isset($item['url']))
                    <a href="{{ $item['url'] }}" class="gm-breadcrumb__link">{{ $item['label'] }}</a>
                @else
                    <span class="gm-breadcrumb__current">{{ $item['label'] ?? $slot }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>