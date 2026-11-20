@props([
    'logo' => null,
    'logoAlt' => 'GENTRY',
    'description' => 'Modern menswear destination. Shop considered shirting, tailoring, knitwear and everyday essentials crafted for the way you live.',
    'columns' => [
        'shop' => [
            'title' => 'Shop',
            'links' => [
                ['label' => 'All Products', 'href' => '#'],
                ['label' => 'New Arrivals', 'href' => '#'],
                ['label' => 'Shirts', 'href' => '#'],
                ['label' => 'Tailoring', 'href' => '#'],
                ['label' => 'Knitwear', 'href' => '#'],
                ['label' => 'Sale', 'href' => '#'],
            ],
        ],
        'help' => [
            'title' => 'Help',
            'links' => [
                ['label' => 'Contact Us', 'href' => '#'],
                ['label' => 'FAQs', 'href' => '#'],
                ['label' => 'Shipping', 'href' => '#'],
                ['label' => 'Returns', 'href' => '#'],
                ['label' => 'Size Guide', 'href' => '#'],
            ],
        ],
        'company' => [
            'title' => 'Company',
            'links' => [
                ['label' => 'Our Story', 'href' => '#'],
                ['label' => 'Careers', 'href' => '#'],
                ['label' => 'Press', 'href' => '#'],
                ['label' => 'Sustainability', 'href' => '#'],
            ],
        ],
    ],
    'social' => [
        'instagram' => '#',
        'twitter' => '#',
        'facebook' => '#',
        'linkedin' => '#',
    ],
    'newsletter' => true,
    'newsletterAction' => '#',
    'copyright' => '© ' . date('Y') . ' GENTRY. All rights reserved.',
    'legalLinks' => [
        ['label' => 'Privacy Policy', 'href' => '#'],
        ['label' => 'Terms of Service', 'href' => '#'],
        ['label' => 'Cookie Policy', 'href' => '#'],
    ],
    'paymentIcons' => [],
])

<footer class="gm-footer" role="contentinfo">
    <div class="gm-container">
        <div class="gm-footer__grid">
            <div class="gm-footer__brand">
                <a href="{{ route('front.home') }}" class="gm-footer__logo" aria-label="{{ $logoAlt }}">
                    @if($logo)
                        <img src="{{ $logo }}" alt="{{ $logoAlt }}">
                    @else
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
                    @endif
                </a>
                <p class="gm-footer__description">{{ $description }}</p>

                <div class="gm-footer__social" role="list" aria-label="Social media">
                    @foreach($social as $platform => $url)
                        <a href="{{ $url }}" class="gm-footer__social-link" aria-label="{{ ucfirst($platform) }}" role="listitem">
                            @if($platform === 'instagram')
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                            @elseif($platform === 'twitter')
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                            @elseif($platform === 'facebook')
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                            @elseif($platform === 'linkedin')
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                            @endif
                        </a>
                    @endforeach
                </div>

                @if($newsletter)
                    <form action="{{ $newsletterAction }}" class="gm-footer__newsletter" method="POST" aria-label="Newsletter signup">
                        @csrf
                        <p class="gm-footer__newsletter-text">Subscribe for updates & 10% off your first order</p>
                        <div class="gm-footer__newsletter-form">
                            <input type="email" name="email" class="gm-footer__newsletter-input" placeholder="Email address" required aria-label="Email address">
                            <x-ui.button variant="primary" type="submit">Subscribe</x-ui.button>
                        </div>
                    </form>
                @endif
            </div>

            @foreach($columns as $key => $column)
                <div class="gm-footer__widget">
                    <h3 class="gm-footer__widget-title">{{ $column['title'] }}</h3>
                    <ul class="gm-footer__links">
                        @foreach($column['links'] as $link)
                            <li><a href="{{ $link['href'] }}" class="gm-footer__link">{{ $link['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="gm-footer__bottom">
            <p class="gm-footer__copyright">{{ $copyright }}</p>

            <nav class="gm-footer__legal" aria-label="Legal links">
                @foreach($legalLinks as $link)
                    <a href="{{ $link['href'] }}" class="gm-footer__legal-link">{{ $link['label'] }}</a>
                @endforeach
            </nav>

            @if($paymentIcons)
                <div class="gm-footer__payment" aria-label="Accepted payment methods">
                    @foreach($paymentIcons as $icon)
                        @if(is_string($icon))
                            <img src="{{ $icon }}" alt="" class="gm-footer__payment-icon" loading="lazy">
                        @else
                            {!! $icon !!}
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</footer>