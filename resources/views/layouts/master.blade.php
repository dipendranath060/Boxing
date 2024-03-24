<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-5/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{ asset('assets/icons/logo.jpg') }}" />

</head>

<body id="body">

    @include('layouts.inc.admin-navbar')
    @include('layouts.inc.admin-sidebar') 
    <main id="main" style="margin-left: 150px">
        @yield('content')
    </main>

    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{ asset('assets/css/bootstrap-5/popper.js') }}"></script>
    <script src="{{ asset('assets/css/bootstrap-5/bootstrap.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        if (!localStorage.getItem("sidebarState")) {
        localStorage.setItem("sidebarState", "collapsed");
    }
    
    document.addEventListener("DOMContentLoaded", function () {
        const sidebarState = localStorage.getItem("sidebarState");
        if (sidebarState == "expanded") {
            menu_toggler();
            
        }
    });

    if (!localStorage.getItem("theme")) {
        localStorage.setItem("theme", "light");
    }
    
    document.addEventListener("DOMContentLoaded", function () {
        const theme = localStorage.getItem("theme");
        if (theme == "dark") {
            themeChange();
            localStorage.setItem("theme","dark")
        }
    });
    </script>
    @yield('scripts')

</body>
</html>