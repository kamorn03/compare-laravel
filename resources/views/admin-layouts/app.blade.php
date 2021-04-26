<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{asset('js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/vendor/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('js/vendor/mousetrap.min.js')}}"></script>
    <script src="{{asset('js/dore.script.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>

    <link rel="stylesheet" href="{{asset('font/iconsmind-s/css/iconsminds.css')}}"/>
    <link rel="stylesheet" href="{{asset('font/simple-line-icons/css/simple-line-icons.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/vendor/component-custom-switch.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/vendor/perfect-scrollbar.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/main.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/dore.light.bluenavy.min.css')}}"/>
</head>

    <body id="app-container" class="menu-default">
            @yield('content')
    </body>

</html>
