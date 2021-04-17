<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="แพลตฟอร์มที่รวบรวมงานอีเว้นท์ทั้งหมด ไว้ในที่เดียว เพื่อให้ตอบโจทย์ทุกความต้องการของผู้เข้าชมงาน สามารถเข้าถึงได้ง่ายและเปิดประสบการณ์การชมอีเว้นท์ในรูปใหม่">
        <meta name="keywords" content="livestreaming, wexib, event, exhibitor, show, liveshow, Ecommerce, อีเว้นท์, งานแสดงสินค้า, มหกรรม, นิทรรศการ, streaming, งานอีเว้นท์">
    <title>DiGi Solution</title>
    <link rel="stylesheet" href="/css/app.css">
    <script src="{{asset('js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/jquery.ba-throttle-debounce.js')}}"></script>
    <script src="{{asset('framework/bootstrap4/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('framework/bootstrap4/bootstrap.min.css')}}">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


    <style>
        body, html {
            font-family: 'Sarabun', sans-serif;
            background-color: #ECEFF3;
            overflow-x: hidden
        }
    </style>
    @stack('css')
    @yield('css')
</head>

<body>
@yield('content')
@stack('js')
@yield('js')
</body>

</html>
