<!DOCTYPE html>
<html lang="en">
@include('frontend.partials.head')
<body class="sticky-header" style="max-width: 1600px;margin: 0 auto">
    <a href="#top" class="back-to-top" id="backto-top" style="background: #111111;"><i class="fal fa-arrow-up"></i></a>
    @yield('content')

@include('frontend.partials.footer')