@props([
    'title' => '',
    'subtitle' => null,
    'breadcrumb' => [],
    'actions' => null,
    'count' => null,
])

<div class="gm-admin-page-header" {{ $attributes }}>
    <div class="gm-admin-page-header__content">
        @if($breadcrumb->count())
            <nav class="gm-admin-page-header__breadcrumb" aria-label="Breadcrumb">
                @foreach($breadcrumb as $index => $item)
                    @if(!$loop->last && isset($item['url']))
                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                        <span class="gm-admin-page-header__breadcrumb-separator" aria-hidden="true">/</span>
                    @else
                        <span class="gm-admin-page-header__breadcrumb-current">{{ $item['label'] }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        {{ $slot ?? '' }}

        <h1 class="gm-admin-page-header__title">{{ $title }}</h1>

        @if($subtitle)
            <p class="gm-admin-page-header__subtitle">{{ $subtitle }}</p>
        @endif

        @if($count !== null)
            <span class="gm-admin-page-header__count">{{ $count }} items</span>
        @endif
    </div>

    @if($actions)
        <div class="gm-admin-page-header__actions">
            {{ $actions }}
        </div>
    @endif
</div>