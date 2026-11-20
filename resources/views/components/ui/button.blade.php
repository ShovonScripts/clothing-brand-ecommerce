@props([
    'variant' => 'primary',
    'size' => 'md',
    'full' => false,
    'loading' => false,
    'disabled' => false,
    'icon' => null,
    'iconPosition' => 'left',
    'tag' => 'button',
    'href' => null,
])

@php
    // A button with an href is rendered as a link.
    $isLink = filled($href);
    $element = $isLink ? 'a' : $tag;

    $classes = ['gm-btn', "gm-btn--{$variant}", "gm-btn--{$size}"];
    if ($full) $classes[] = 'gm-btn--full';
    if ($loading) $classes[] = 'gm-btn--loading';
    if ($disabled) $classes[] = 'gm-btn--disabled';

    // Defaults; anything the caller passes (e.g. type="submit") wins over these,
    // except `class`, which is appended.
    $defaults = ['class' => implode(' ', $classes)];
    if ($isLink) {
        $defaults['href'] = $href;
        if ($disabled) {
            $defaults['aria-disabled'] = 'true';
            $defaults['tabindex'] = '-1';
        }
    } elseif ($element === 'button') {
        $defaults['type'] = 'button';
        if ($disabled || $loading) $defaults['disabled'] = true;
    }
    if ($loading) $defaults['aria-busy'] = 'true';
@endphp

<{{ $element }} {{ $attributes->merge($defaults) }}>
    @if($icon && $iconPosition === 'left')
        <span class="gm-btn__icon gm-btn__icon--left" aria-hidden="true">{{ $icon }}</span>
    @endif
    <span class="gm-btn__text">{{ $slot }}</span>
    @if($icon && $iconPosition === 'right')
        <span class="gm-btn__icon gm-btn__icon--right" aria-hidden="true">{{ $icon }}</span>
    @endif
</{{ $element }}>
