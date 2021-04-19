<nav class="navbar navbar-expand-md navbar-light bg-white flex-row">
    <span class="navbar-text d-none d-md-block">
        {{-- before brand --}}
        <div></div>
    </span>
    <a class="navbar-brand mx-md-auto mr-auto w-100 text-center" href="/">
        <img src="{{ asset('img/Logo_MadameTJ.png') }}" alt="logo" width="250">
    </a>
    <span class="navbar-text d-none d-md-block">
        <div class="collapse navbar-collapse" id="navbarSupportedContent" f>
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                {{-- {{ dd(Auth::check()) }} --}}
                @if (Auth::guest())
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.create') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"
                                href="{{ route('users.edit', ['user' => Auth::user()->id]) }}">Account</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                                          document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-pill">
                            <img src="{{ asset('img/svg-icons/cart-bag.svg') }}" alt="cart-bag">
                            {{ \Cart::getTotalQuantity() }}
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"
                        style="width: 450px; padding: 0px; border-color: #9DA0A2">
                        <ul class="list-group" style="margin: 20px;">
                            @include('partials.cart-drop')
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </span>
    {{-- level 2 nav showing --}}
    <button class="navbar-toggler ml-lg-0 border-0" type="button" data-toggle="collapse" data-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-toggler ml-lg-0 float-right border-0">
        <span class="badge badge-pill">
            <img src="{{ asset('img/svg-icons/user.svg') }}" alt="user-icon">
            <img src="{{ asset('img/svg-icons/cart-bag.svg') }}" alt="cart-bag">
            {{ \Cart::getTotalQuantity() }}
        </span>
    </div>
</nav>
<nav class="navbar navbar-expand-md bg-white shadow-sm secondline-nav">
    <div class="navbar-collapse collapse justify-content-center" id="navbarContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/more-about">Production and fulfillment services</a>
            </li>
            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Product</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Earrings</a>
                    <a class="dropdown-item" href="#">Rings</a>
                    <a class="dropdown-item" href="#">Necklaces</a>
                </div>
            </li> --}}
            {{-- category and collection --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Product
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @php
                        use App\Models\Category;
                        use App\Models\Collections;
                    @endphp
                    @foreach (Category::all() as $category)
                        @if (Collections::where('category_id', $category->id)->first())
                            <li class="dropright">
                                <a class="dropdown-item dropdown-toggle" href="/shop/rings" data-toggle="dropdown">
                                    {{ $category->name }}
                                </a>
                                <div class="dropdown-menu">
                                    @foreach (Collections::where('category_id', $category->id)->get() as $collection)
                                        <a class="dropdown-item"
                                            href="/shop/{{ $category->name }}/{{ $collection->name }}">
                                            {{ $collection->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <a class="dropdown-item" href="/shop/{{ $category->name }}">{{ $category->name }}</a>
                        @endif
                    @endforeach
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/news">News & Event</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact">Contact Us</a>
            </li>
        </ul>
    </div>
</nav>

<style>
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu a::after {
        transform: rotate(-90deg);
        position: absolute;
        right: 6px;
        top: .8em;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-left: .1rem;
        margin-right: .1rem;
    }

    .nav-item a {
        color: #797979;
        text-decoration: none;
        background-color: transparent;
    }

</style>
