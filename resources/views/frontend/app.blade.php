<!DOCTYPE html>
<html lang="en">
@include('frontend.partials.head')
<body class="gm-site sticky-header">
    <a href="#top" class="back-to-top" id="backto-top" aria-label="Back to top"><i class="fal fa-arrow-up"></i></a>

    @include('frontend.partials.header')
    @yield('content')

    @include('frontend.partials.footer')
</body>
</html>
