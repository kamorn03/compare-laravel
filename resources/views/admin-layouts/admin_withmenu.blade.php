@extends('admin-layouts.main')
@push('css')
    {{-- admin --}}
    <link rel="stylesheet" href="{{ asset('font/iconsmind-s/css/iconsminds.css') }}" />
    <link rel="stylesheet" href="{{ asset('font/simple-line-icons/css/simple-line-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/component-custom-switch.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dore.light.bluenavy.min.css') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <style>
        #main-content-title {
            height: 120px;
            box-shadow: 0px 1px 0px #E3E3E3;
            font-size: 16px;
            color: #3064C6;
            position: fixed;
            width: 100%;
            background: white;
            z-index: 10;
        }

        #main-content-body {
            padding-top: 122px;
            background: white;
            /*padding-bottom: 270px;*/
        }

        #main-content-footer {
            box-shadow: 0px 1px 0px #E3E3E3;
            font-size: 14px;
            color: #3064C6;
            font-weight: bold;
            width: 100%;
            background: #FAFAFA;
            z-index: 10;
            padding-bottom: 20px;
        }

        #main-content-footer-copyright {
            padding: 5px;
            font-size: 13px;
            color: #3064C6;
            font-weight: bold;
            width: 100%;
            background: #FAFAFA;
            z-index: 10;
            border-top: 1px solid #E5E5E5;
        }

        nav {
            height: 20px;
            /* border: 1px solid red; */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

    </style>
@endpush
@section('content')
    {{-- <div id="main-content-body"> --}}
    {{-- @yield('content') --}}
    {{-- </div> --}}


    <body id="app-container" class="menu-default show-spinner">
        <nav class="navbar fixed-top">
            <div class="d-flex align-items-center navbar-left">
                <a href="#" class="menu-button d-none d-md-block">
                    <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                        <rect x="0.48" y="0.5" width="7" height="1" />
                        <rect x="0.48" y="7.5" width="7" height="1" />
                        <rect x="0.48" y="15.5" width="7" height="1" />
                    </svg>
                    <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                        <rect x="1.56" y="0.5" width="16" height="1" />
                        <rect x="1.56" y="7.5" width="16" height="1" />
                        <rect x="1.56" y="15.5" width="16" height="1" />
                    </svg>
                </a>

                <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                        <rect x="0.5" y="0.5" width="25" height="1" />
                        <rect x="0.5" y="7.5" width="25" height="1" />
                        <rect x="0.5" y="15.5" width="25" height="1" />
                    </svg>
                </a>
            </div>


            <a class="navbar-logo" href="/">
                <span class="logo d-none d-xs-block"></span>
                <span class="logo-mobile-custom d-block d-xs-none"></span>
            </a>

            <div class="navbar-right">
                <div class="header-icons d-inline-block align-middle">

                    <div class="position-relative d-none d-sm-inline-block">

                        <div class="dropdown-menu dropdown-menu-right mt-3  position-absolute" id="iconMenuDropdown">
                            <a href="#" class="icon-menu-item">
                                <i class="iconsminds-equalizer d-block"></i>
                                <span>Settings</span>
                            </a>

                            <a href="#" class="icon-menu-item">
                                <i class="iconsminds-male-female d-block"></i>
                                <span>Users</span>
                            </a>

                            <a href="#" class="icon-menu-item">
                                <i class="iconsminds-puzzle d-block"></i>
                                <span>Components</span>
                            </a>

                            <a href="#" class="icon-menu-item">
                                <i class="iconsminds-bar-chart-4 d-block"></i>
                                <span>Profits</span>
                            </a>

                            <a href="#" class="icon-menu-item">
                                <i class="iconsminds-file d-block"></i>
                                <span>Surveys</span>
                            </a>

                            <a href="#" class="icon-menu-item">
                                <i class="iconsminds-suitcase d-block"></i>
                                <span>Tasks</span>
                            </a>

                        </div>
                    </div>

                    <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                        <i class="simple-icon-size-fullscreen"></i>
                        <i class="simple-icon-size-actual"></i>
                    </button>

                </div>


                <div class="user d-inline-block">
                    <div id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    {{ Auth::user()->name }}
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
                <div class="user d-inline-block">
                    <div id="navbarSupportedLogout">
                        <ul class="navbar-nav ml-auto">
                            @guest
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                                                                                                      document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
        </nav>

        <div class="menu">
            <div class="main-menu">
                <div class="scroll">
                    <ul class="list-unstyled">
                        <li>
                            <a href="#dashboard">
                                <i class="iconsminds-shop-4"></i>
                                <span> Manage content (CMS) </span>
                            </a>
                        </li>
                        <li>
                            <a href="#main_menu">
                                <i class="iconsminds-digital-drawing"></i>
                                <span> Member </span>
                            </a>
                        </li>
                        <li>
                            <a href="#product">
                                <i class="simple-icon-basket-loaded"></i> Product
                            </a>
                        </li>
                        <li>
                            <a href="#order">
                                <i class="iconsminds-pantone"></i> Orders Process
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.banner') }}">
                                <i class="iconsminds-film"></i> Banner
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.news') }}">
                                <i class="iconsminds-digital-drawing"></i> News
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="sub-menu">
                <div class="scroll">
                    <ul class="list-unstyled" data-link="dashboard">
                        <li>
                            <a href="{{ route('admin.main-title') }}">
                                <i class="simple-icon-rocket"></i> <span class="d-inline-block">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.more-about') }}">
                                <i class="simple-icon-doc"></i> <span class="d-inline-block">About Us</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contact') }}">
                                <i class="simple-icon-doc"></i> <span class="d-inline-block">Contact Us</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="list-unstyled" data-link="main_menu">
                        <li>
                            <a href="{{ route('admin.users') }}">
                                <i class="simple-icon-doc"></i> <span class="d-inline-block">Member list</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="list-unstyled" data-link="product">
                        <li>
                            <a href="{{ route('admin.category') }}">
                                <i class="simple-icon-pie-chart"></i> <span class="d-inline-block">Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.collection') }}">
                                <i class="simple-icon-pie-chart"></i> <span class="d-inline-block">Sub Category</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.product') }}">
                                <i class="simple-icon-basket-loaded"></i> <span class="d-inline-block">Product list</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('admin.size') }}">
                                <i class="iconsminds-maximize"></i> ขนาดสินค้า
                            </a>
                        </li> --}}
                    </ul>
                    <ul class="list-unstyled" data-link="order">
                        <li>
                            <a href="{{ route('admin.order', ['status' => 'watting_payment']) }}">
                                <i class="icon-angle-right"></i> watting payment
                                @php
                                    $watting_payment_count = App\Models\Order::where('status', 'watting_payment')->count();
                                @endphp
                                @if (isset($watting_payment_count) && $watting_payment_count > 0)
                                    <span class="badge badge-light">{{ $watting_payment_count }}</span>
                                @endif
                            </a>
                        </li>
                        <li>

                            <a href="{{ route('admin.order', ['status' => 'successful_payment']) }}">
                                <i class="icon-angle-right"></i> successful payment
                                @php
                                    $successful_payment_count = App\Models\Order::where('status', 'successful_payment')->count();
                                @endphp
                                @if (isset($successful_payment_count) && $successful_payment_count > 0)
                                    <span class="badge badge-light">{{ $successful_payment_count }}</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.order', ['status' => 'waiting_delivery']) }}">
                                <i class="icon-angle-right"></i> waiting delivery
                                @php
                                    $waiting_delivery_count = App\Models\Order::where('status', 'waiting_delivery')->count();
                                @endphp
                                @if (isset($waiting_delivery_count) && $waiting_delivery_count > 0)
                                    <span class="badge badge-light">{{ $waiting_delivery_count }}</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.order', ['status' => 'successful_delivery']) }}">
                                <i class="icon-angle-right"></i> successful delivery
                                @php
                                    $successful_delivery_count = App\Models\Order::where('status', 'successful_delivery')->count();
                                @endphp
                                @if (isset($successful_delivery_count) && $successful_delivery_count > 0)
                                    <span class="badge badge-light">{{ $successful_delivery_count }}</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.order', ['status' => 'cancel']) }}">
                                <i class="icon-angle-right"></i> cancel
                                @php
                                    $cancel_count = App\Models\Order::where('status', 'cancel')->count();
                                @endphp
                                @if (isset($cancel_count) && $cancel_count > 0)
                                    <span class="badge badge-light">{{ $cancel_count }}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>

        <footer class="page-footer">
            <div class="footer-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <p class="mb-0 text-muted">©copyright 2021 All Rights Reserved by digi solution co.,LTD</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
        {{-- datatable --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css" />
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js">
        </script>
        <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/vendor/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('js/vendor/mousetrap.min.js') }}"></script>
        <script src="{{ asset('js/dore.script.js') }}"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('js/input-spinner.js') }}"></script>
        <style>
            a {
                text-decoration: none;
            }

            a:hover {
                text-decoration: none;
            }

            .badge {
                padding: 0.4em 3px;
                font-size: 74%;
            }

        </style>
    </body>

    @overwrite
