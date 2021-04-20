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
                                <span> จัดการเนื้อหา (CMS) </span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="#main_menu">
                                <i class="iconsminds-digital-drawing"></i>
                                <span> ตั้งค่า </span>
                            </a>
                        </li> --}}
                        <li>
                            <a href="#main_menu">
                                <i class="iconsminds-digital-drawing"></i>
                                <span> สมาชิก </span>
                            </a>
                        </li>
                        <li>
                            <a href="#product">
                                <i class="simple-icon-basket-loaded"></i> สินค้า
                            </a>
                        </li>
                        <li>
                            <a href="#order">
                                <i class="iconsminds-pantone"></i> จัดการคำสั่งซื้อ
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.banner') }}">
                                <i class="iconsminds-film"></i> Banner
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.news') }}">
                                <i class="iconsminds-digital-drawing"></i> ข่าว
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
                                <i class="simple-icon-rocket"></i> <span class="d-inline-block">หน้าแรก</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.more-about') }}">
                                <i class="simple-icon-doc"></i> <span class="d-inline-block">เกี่ยวกับฉัน</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contact') }}">
                                <i class="simple-icon-doc"></i> <span class="d-inline-block">ติดต่อเรา (contact)</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="list-unstyled" data-link="main_menu">
                        <li>
                            <a href="{{ route('admin.users') }}">
                                <i class="simple-icon-doc"></i> <span class="d-inline-block">รายการ สมาชิก</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="list-unstyled" data-link="product">
                        <li>
                            <a href="{{ route('admin.category') }}">
                                <i class="simple-icon-pie-chart"></i> <span class="d-inline-block">ประเภทสินค้า</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.collection') }}">
                                <i class="simple-icon-pie-chart"></i> <span class="d-inline-block">ประเภทย่อยสินค้า</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.product') }}">
                                <i class="simple-icon-basket-loaded"></i> <span class="d-inline-block">สินค้า</span>
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
                            <a href="#">
                                <i class="simple-icon-doc"></i> <span class="d-inline-block">คำสั่งซื้อ</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.order', ['status' => 'watting_payment']) }}">
                                <i class="icon-angle-right"></i> รอการชำระเงิน
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
                                <i class="icon-angle-right"></i> แจ้งชำระเงินแล้ว รอตรวจสอบ
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
                                <i class="icon-angle-right"></i> กำลังดำเนินการ
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
                                <i class="icon-angle-right"></i> ส่งสินค้าแล้ว
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
                                <i class="icon-angle-right"></i> ชำระเงินผิด
                                @php
                                    $cancel_count = App\Models\Order::where('status', 'cancel')->count();
                                @endphp
                                @if (isset($cancel_count) && $cancel_count > 0)
                                    <span class="badge badge-light">{{ $cancel_count }}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                    <ul class="list-unstyled" data-link="layouts" id="layouts">
                        <li>
                            <a href="#" data-toggle="collapse" data-target="#collapseAuthorization" aria-expanded="true"
                                aria-controls="collapseAuthorization" class="rotate-arrow-icon opacity-50">
                                <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Authorization</span>
                            </a>
                            <div id="collapseAuthorization" class="collapse show">
                                <ul class="list-unstyled inner-level-menu">
                                    <li>
                                        <a href="Pages.Auth.Login.html">
                                            <i class="simple-icon-user-following"></i> <span
                                                class="d-inline-block">Login</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Auth.Register.html">
                                            <i class="simple-icon-user-follow"></i> <span
                                                class="d-inline-block">Register</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Auth.ForgotPassword.html">
                                            <i class="simple-icon-user-unfollow"></i> <span class="d-inline-block">Forgot
                                                Password</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true"
                                aria-controls="collapseProduct" class="rotate-arrow-icon opacity-50">
                                <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Product</span>
                            </a>
                            <div id="collapseProduct" class="collapse show">
                                <ul class="list-unstyled inner-level-menu">
                                    <li>
                                        <a href="Pages.Product.List.html">
                                            <i class="simple-icon-credit-card"></i> <span class="d-inline-block">Data
                                                List</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Product.Thumbs.html">
                                            <i class="simple-icon-list"></i> <span class="d-inline-block">Thumb
                                                List</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Product.Images.html">
                                            <i class="simple-icon-grid"></i> <span class="d-inline-block">Image
                                                List</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Product.Detail.html">
                                            <i class="simple-icon-book-open"></i> <span class="d-inline-block">Detail</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="true"
                                aria-controls="collapseProfile" class="rotate-arrow-icon opacity-50">
                                <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Profile</span>
                            </a>
                            <div id="collapseProfile" class="collapse show">
                                <ul class="list-unstyled inner-level-menu">
                                    <li>
                                        <a href="Pages.Profile.Social.html">
                                            <i class="simple-icon-share"></i> <span class="d-inline-block">Social</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Profile.Portfolio.html">
                                            <i class="simple-icon-link"></i> <span class="d-inline-block">Portfolio</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#" data-toggle="collapse" data-target="#collapseBlog" aria-expanded="true"
                                aria-controls="collapseBlog" class="rotate-arrow-icon opacity-50">
                                <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Blog</span>
                            </a>
                            <div id="collapseBlog" class="collapse show">
                                <ul class="list-unstyled inner-level-menu">
                                    <li>
                                        <a href="Pages.Blog.html">
                                            <i class="simple-icon-list"></i> <span class="d-inline-block">List</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Blog.Detail.html">
                                            <i class="simple-icon-book-open"></i> <span class="d-inline-block">Detail</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Blog.Detail.Alt.html">
                                            <i class="simple-icon-picture"></i> <span class="d-inline-block">Detail
                                                Alt</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#" data-toggle="collapse" data-target="#collapseMisc" aria-expanded="true"
                                aria-controls="collapseMisc" class="rotate-arrow-icon opacity-50">
                                <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Miscellaneous</span>
                            </a>
                            <div id="collapseMisc" class="collapse show">
                                <ul class="list-unstyled inner-level-menu">
                                    <li>
                                        <a href="Pages.Misc.Coming.Soon.html">
                                            <i class="simple-icon-hourglass"></i> <span class="d-inline-block">Coming
                                                Soon</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Misc.Error.html">
                                            <i class="simple-icon-exclamation"></i> <span
                                                class="d-inline-block">Error</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Misc.Faq.html">
                                            <i class="simple-icon-question"></i> <span class="d-inline-block">Faq</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Misc.Invoice.html">
                                            <i class="simple-icon-bag"></i> <span class="d-inline-block">Invoice</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Misc.Knowledge.Base.html">
                                            <i class="simple-icon-graduation"></i> <span class="d-inline-block">Knowledge
                                                Base</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Misc.Mailing.html">
                                            <i class="simple-icon-envelope-open"></i> <span
                                                class="d-inline-block">Mailing</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Misc.Pricing.html">
                                            <i class="simple-icon-diamond"></i> <span class="d-inline-block">Pricing</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Pages.Misc.Search.html">
                                            <i class="simple-icon-magnifier"></i> <span class="d-inline-block">Search</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-unstyled" data-link="applications">
                        <li>
                            <a href="Apps.MediaLibrary.html">
                                <i class="simple-icon-picture"></i> <span class="d-inline-block">Library</span>
                            </a>
                        </li>
                        <li>
                            <a href="Apps.Todo.List.html">
                                <i class="simple-icon-check"></i> <span class="d-inline-block">Todo</span>
                            </a>
                        </li>
                        <li>
                            <a href="Apps.Survey.List.html">
                                <i class="simple-icon-calculator"></i> <span class="d-inline-block">Survey</span>
                            </a>
                        </li>
                        <li>
                            <a href="Apps.Chat.html">
                                <i class="simple-icon-bubbles"></i> <span class="d-inline-block">Chat</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="list-unstyled" data-link="ui">
                        <li>
                            <a href="#" data-toggle="collapse" data-target="#collapseForms" aria-expanded="true"
                                aria-controls="collapseForms" class="rotate-arrow-icon opacity-50">
                                <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Forms</span>
                            </a>
                            <div id="collapseForms" class="collapse show">
                                <ul class="list-unstyled inner-level-menu">
                                    <li>
                                        <a href="Ui.Forms.Components.html">
                                            <i class="simple-icon-event"></i> <span class="d-inline-block">Components</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Forms.Layouts.html">
                                            <i class="simple-icon-doc"></i> <span class="d-inline-block">Layouts</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Forms.Validation.html">
                                            <i class="simple-icon-check"></i> <span class="d-inline-block">Validation</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Forms.Wizard.html">
                                            <i class="simple-icon-magic-wand"></i> <span
                                                class="d-inline-block">Wizard</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#" data-toggle="collapse" data-target="#collapseDataTables" aria-expanded="true"
                                aria-controls="collapseDataTables" class="rotate-arrow-icon opacity-50">
                                <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Datatables</span>
                            </a>
                            <div id="collapseDataTables" class="collapse show">
                                <ul class="list-unstyled inner-level-menu">
                                    <li>
                                        <a href="Ui.Datatables.Rows.html">
                                            <i class="simple-icon-screen-desktop"></i> <span class="d-inline-block">Full
                                                Page UI</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Datatables.Scroll.html">
                                            <i class="simple-icon-mouse"></i> <span class="d-inline-block">Scrollable</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Datatables.Pagination.html">
                                            <i class="simple-icon-notebook"></i> <span
                                                class="d-inline-block">Pagination</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Datatables.Default.html">
                                            <i class="simple-icon-grid"></i> <span class="d-inline-block">Default</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#" data-toggle="collapse" data-target="#collapseComponents" aria-expanded="true"
                                aria-controls="collapseComponents" class="rotate-arrow-icon opacity-50">
                                <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Components</span>
                            </a>
                            <div id="collapseComponents" class="collapse show">
                                <ul class="list-unstyled inner-level-menu">
                                    <li>
                                        <a href="Ui.Components.Alerts.html">
                                            <i class="simple-icon-bell"></i> <span class="d-inline-block">Alerts</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Components.Badges.html">
                                            <i class="simple-icon-badge"></i> <span class="d-inline-block">Badges</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Components.Buttons.html">
                                            <i class="simple-icon-control-play"></i> <span
                                                class="d-inline-block">Buttons</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Components.Cards.html">
                                            <i class="simple-icon-layers"></i> <span class="d-inline-block">Cards</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="Ui.Components.Carousel.html">
                                            <i class="simple-icon-picture"></i> <span class="d-inline-block">Carousel</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Components.Charts.html">
                                            <i class="simple-icon-chart"></i> <span class="d-inline-block">Charts</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Components.Collapse.html">
                                            <i class="simple-icon-arrow-up"></i> <span
                                                class="d-inline-block">Collapse</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Components.Dropdowns.html">
                                            <i class="simple-icon-arrow-down"></i> <span
                                                class="d-inline-block">Dropdowns</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Components.Editors.html">
                                            <i class="simple-icon-book-open"></i> <span
                                                class="d-inline-block">Editors</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Components.Icons.html">
                                            <i class="simple-icon-star"></i> <span class="d-inline-block">Icons</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Components.InputGroups.html">
                                            <i class="simple-icon-note"></i> <span class="d-inline-block">Input
                                                Groups</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Components.Jumbotron.html">
                                            <i class="simple-icon-screen-desktop"></i> <span
                                                class="d-inline-block">Jumbotron</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Components.Modal.html">
                                            <i class="simple-icon-docs"></i> <span class="d-inline-block">Modal</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Components.Navigation.html">
                                            <i class="simple-icon-cursor"></i> <span
                                                class="d-inline-block">Navigation</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="Ui.Components.PopoverandTooltip.html">
                                            <i class="simple-icon-pin"></i> <span class="d-inline-block">Popover &
                                                Tooltip</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Components.Sortable.html">
                                            <i class="simple-icon-shuffle"></i> <span class="d-inline-block">Sortable</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Ui.Components.Tables.html">
                                            <i class="simple-icon-grid"></i> <span class="d-inline-block">Tables</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>

                    <ul class="list-unstyled" data-link="menu" id="menuTypes">

                        <li>
                            <a href="#" data-toggle="collapse" data-target="#collapseMenuLevel" aria-expanded="true"
                                aria-controls="collapseMenuLevel" class="rotate-arrow-icon collapsed">
                                <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Menu Levels</span>
                            </a>
                            <div id="collapseMenuLevel" class="collapse" data-parent="#menuTypes">
                                <ul class="list-unstyled inner-level-menu">
                                    <li>
                                        <a href="#">
                                            <i class="simple-icon-layers"></i> <span class="d-inline-block">Sub
                                                Level</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="collapse" data-target="#collapseMenuLevel2"
                                            aria-expanded="true" aria-controls="collapseMenuLevel2"
                                            class="rotate-arrow-icon collapsed">
                                            <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Another
                                                Level</span>
                                        </a>
                                        <div id="collapseMenuLevel2" class="collapse">
                                            <ul class="list-unstyled inner-level-menu">
                                                <li>
                                                    <a href="#">
                                                        <i class="simple-icon-layers"></i> <span class="d-inline-block">Sub
                                                            Level</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#" data-toggle="collapse" data-target="#collapseMenuDetached" aria-expanded="true"
                                aria-controls="collapseMenuDetached" class="rotate-arrow-icon collapsed">
                                <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Detached</span>
                            </a>
                            <div id="collapseMenuDetached" class="collapse">
                                <ul class="list-unstyled inner-level-menu">
                                    <li>
                                        <a href="#">
                                            <i class="simple-icon-layers"></i> <span class="d-inline-block">Sub
                                                Level</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
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

        </style>
    </body>

    @overwrite
