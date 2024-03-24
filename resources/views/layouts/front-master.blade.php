<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <meta name="og_title" property="og:title" content="@yield('title')"/>
    <meta name="og_description" property="og:description" content="@yield('meta_description')"/>
    <meta name="og:site_name" property="og:site_name" content="NPBC"/>
    <meta name="og_image" property="og:image" content="@yield('image')"/>
    <meta name="og_url" property="og:url" content="https://binaryshastra.com"/>
    <meta name="twitter:card" content="@yield('image')"/>
    <meta name="twitter:title" content="@yield('title')"/>
    <meta name="twitter:description" property="twitter:description" content="@yield('meta_description')"/>
    <meta name="twitter:image" property="twitter:image" content="@yield('image')"/>
    <meta name="twitter:url" property="twitter:url" content="https://binaryshastra.com"/>
    <meta name="twitter:site" property="twitter:site" content="NPBC"/>

    <!-- Font awesome -->
    <link href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-5/bootstrap.min.css')}}">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('OwlCarousel2-2.3.4/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('OwlCarousel2-2.3.4/owl.theme.default.min.css')}}">

    <!-- Styling -->
    <link rel="stylesheet" href="{{asset('assets/css/front-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <link rel="icon" href="{{ asset('assets/icons/logo.jpg') }}" />

</head>

<body>
    @include('layouts.inc.frontend-navbar')

    @yield('content')

    @include('layouts.inc.footer')
	
    <script src="{{ asset('OwlCarousel2-2.3.4/jquery.min.js') }}"></script>
    <script src="{{ asset('OwlCarousel2-2.3.4/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/css/bootstrap-5/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/css/bootstrap-5/popper.js') }}"></script>
    <script src="{{ asset('counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('counterup/jquery.waypoints.min.js') }}"></script>

    <!-- Main Script -->
    <script src="{{ asset('assets/js/front-script.js') }}"></script>

    @yield('scripts')
  </body>
</body>