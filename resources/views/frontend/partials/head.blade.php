<head>

@php
 use App\Models\Information;
  $information = Information::first();
@endphp

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', $information->site_name) — Modern Menswear</title>
    <meta name="robots" content="index, follow" />
    <meta name="description" content="@yield('meta_description', 'GENTRY is a modern menswear destination. Shop considered shirting, tailoring, knitwear and everyday essentials crafted for the way you live.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#111111">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/svg+xml" href="{{ asset('uploads/img/'.$information->favicon)}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:opsz,wght@6..96,400;6..96,500;6..96,600&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <!-- CSS
    ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/flaticon/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/slick-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/sal.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/base.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/header.css?v=007')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/update.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/newstyle.css?v=1.1')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/mens.css?v=1.0')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    @stack('css')
    {!!\App\Models\Information::value('tracking_code')!!}
    {!!\App\Models\Information::value('pixel')!!}
    {!!\App\Models\Information::value('search_console')!!}
</head>
