{{-- Customer account sidebar (new design). Used by dashboard/orders and dashboard/show. --}}
@php $user = auth()->user(); @endphp
<aside class="gm-dashboard-sidebar">
    <div class="gm-dashboard-profile" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); padding: var(--s-5); margin-bottom: var(--s-4); text-align: center;">
        <div class="gm-dashboard-avatar" style="width: 80px; height: 80px; border-radius: 50%; background: var(--c-bg-2); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--s-3); color: var(--c-accent); font-size: var(--t-2xl); font-weight: 500; font-family: var(--f-display);">
            {{ strtoupper(mb_substr($user->first_name ?? 'U', 0, 1)) }}
        </div>
        <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-1);">{{ full_name($user) }}</h3>
        @if($user->created_at)
            <p style="font-size: var(--t-sm); color: var(--c-ink-500); margin: 0;">Member since {{ $user->created_at->format('F Y') }}</p>
        @endif
    </div>

    @php
        $links = [
            ['route' => 'front.dashboard.index', 'match' => 'front.dashboard.*', 'label' => 'Dashboard'],
            ['route' => 'front.orders.index', 'match' => 'front.orders.*', 'label' => 'Orders'],
            ['route' => 'front.wishlist.index', 'match' => 'front.wishlist.*', 'label' => 'Wishlist'],
            ['route' => 'front.account_details.index', 'match' => 'front.account_details.*', 'label' => 'Account details'],
        ];
        $itemStyle = 'display: flex; align-items: center; gap: var(--s-3); padding: var(--s-3) var(--s-4); color: var(--c-ink-700); font-size: var(--t-sm); font-weight: 500; text-decoration: none; border-bottom: 1px solid var(--c-line);';
    @endphp
    <nav class="gm-dashboard-nav" style="background: var(--c-bg); border: 1px solid var(--c-line); border-radius: var(--r-lg); overflow: hidden;" aria-label="Account">
        @foreach($links as $link)
            <a href="{{ route($link['route']) }}" class="gm-dashboard-nav-item {{ request()->routeIs($link['match']) ? 'active' : '' }}"
               style="{{ $itemStyle }}" @if(request()->routeIs($link['match'])) aria-current="page" @endif>
                {{ $link['label'] }}
            </a>
        @endforeach
        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
            <button type="submit" class="gm-dashboard-nav-item gm-dashboard-nav-item--logout"
                    style="{{ $itemStyle }} color: var(--c-danger); background: none; border: none; width: 100%; text-align: left; cursor: pointer;">
                Log out
            </button>
        </form>
    </nav>
</aside>
