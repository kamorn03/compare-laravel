<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <title>{{ $title ?? 'E-COMMERCE STORE' }}</title>
    <link rel="stylesheet" href={{ url('css/app.css') }}>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/badges.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @include('partials.custom-navbar')
        <main>
            @yield('content')
        </main>
        {{-- footer --}}
        <section id="footer">
            <div class="container">
                {{-- align text --}}
                <div class="row text-left text-xs-left text-sm-left text-md-left">
                    <div class="col-xs-12 col-sm-4 col-md-4 mb-3">
                        <div class="text-center text-xs-center text-sm-left text-md-left">
                            <img src="{{ asset('img/Logo_MadameTJ.png') }}" alt="logo" style="width: 60%;">
                        </div>
                        <br>
                        <h5 class="text-title-footer">Follow Us</h5>
                        <div>
                            <a class="pl-0" href=""><img src="{{ asset('img/dist/Vector.png') }}" alt="Vector"
                                    style="width: 20;"></a>
                            <a class="pl-2" href=""><img src="{{ asset('img/dist/Vector (1).png') }}" alt="Vector (1)"
                                    style="width: 20;"></a>
                            <a class="pl-2" href=""><img src="{{ asset('img/dist/Vector (2).png') }}" alt="Vector (2)"
                                    style="width: 20;"></a>
                            <a class="pl-2" href=""><img src="{{ asset('img/dist/Vector (3).png') }}"
                                    alt="Vector (3)" style="width: 20;"></a>
                        </div>
                    </div>

                    @php

                        $contact = App\Models\CMSAdminManage::where('page_type', 'contact')->first();
                        if (isset($contact)) {
                            $contact = json_decode($contact->contact);
                        }
                    @endphp
                    <div class="col-xs-12 col-sm-4 col-md-4 mb-3">
                        <h5 class="text-title-footer">Store Info</h5>
                        <div class="row">
                            <div class="col-1">
                                <img src="{{ asset('img/svg-icons/location.svg') }}" alt="location-icon" width="20"
                                    height="28" />
                            </div>
                            <div class="col-11 ">
                                {{ $contact->location ?? '999 Bangkok Thailand 10400' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <img src="{{ asset('img/svg-icons/mail.svg') }}" alt="location-icon" width="20"
                                    height="28" />
                            </div>
                            <div class="col-11">
                                <div>
                                    {{ $contact->email ?? 'info@beyond-silver.com' }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <img src="{{ asset('img/svg-icons/phone-outline.svg') }}" alt="location-icon"
                                    width="20" height="28" />
                            </div>
                            <div class="col-11 my-auto align-middle">
                                <div class="h-100 justify-content-center ">
                                    {!! $contact->phone ?? '+66 9999 9999' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 mb-3">
                        <h5 class="text-title-footer"> Madame TJ Juwel Newsletter </h5>
                        <p>
                            Be the first to know about exciting new designs, special events, store openings and much
                            more.
                        </p>
                        <div>
                            <div class="form-group">
                                <input type="email" class="form-control" class="sub-email" name="sub-email"
                                    id="sub-email" placeholder="Enter Your Email">
                            </div>
                            <div class="text-center text-xs-center text-sm-left text-md-left">
                                <button class="sub-button btn-green">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center">
                        <p>Copyright © 2021 MadameTJJuwel.com. All rights reserved.</p>
                    </div>
                    <hr>
                </div>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        // $('.dropdown').click(function(){

        //     $('.dropdown-menu').toggleClass('show');

        // });
        var Dropdowns = function() {
            var t = $(".dropup, .dropright, .dropdown, .dropleft"),
                e = $(".dropdown-menu"),
                r = $(".dropdown-menu .dropdown-menu");
            $(".dropdown-menu .dropdown-toggle").on("click", function() {
                    var a;
                    return (a = $(this)).closest(t).siblings(t).find(e).removeClass("show"),
                        a.next(r).toggleClass("show"),
                        !1
                }),
                t.on("hide.bs.dropdown", function() {
                    var a, t;
                    a = $(this),
                        (t = a.find(r)).length && t.removeClass("show")
                })
        }();

    </script>
    <style>
        body {
            font-family: 'Open Sans';
        }

        .btn-green {
            /* padding: 0.375rem 2.75rem; */
            background: #81D8D0;
            border: 1px solid #81D8D0;
            box-sizing: border-box;
            border-radius: 5px;
            font-family: 'Open Sans';
            width: 250px;
            height: 48px;
            font-style: normal;
            font-weight: normal;
            font-size: 14px;
            line-height: 19px;
            text-align: center;
            text-transform: uppercase;
            color: #FFFFFF;
        }

        .header-green {

            /*
            font-style: normal;
            font-weight: normal;
            font-size: 30px;
            line-height: 41px;
            text-align: center;
            text-transform: uppercase;
            */

            background: rgba(129, 216, 208, 0.1);
        }

        .header-green label {
            color: #797979;
            font-size: 14px;
            line-height: 19px;
            margin-top: 2em;
        }

        .header-green h1 {
            /* color: #797979; */
            /* font-size: 14px;
            line-height: 19px; */
            font-size: 30px;
            line-height: 41px;
            text-align: center;
            text-transform: uppercase;
            margin-top: 10px;
            color: #000000;
            margin-bottom: 1em;
        }

    </style>
</body>

</html>
