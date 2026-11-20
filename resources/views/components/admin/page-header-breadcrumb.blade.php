@props([
    'items' => [],
])

<nav class="gm-admin-page-header__breadcrumb" aria-label="Breadcrumb">
    @foreach($items as $index => $item)
        @if(!$loop->last && isset($item['url']))
            <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
            <span class="gm-admin-page-header__breadcrumb-separator" aria-hidden="true">/</span>
        @else
            <span class="gm-admin-page-header__breadcrumb-current">{{ $item['label'] }}</span>
        @endif
    @endforeach
</nav>