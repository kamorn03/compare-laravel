@extends('layouts.main')

@section('content')
    <div class="header-green text-center align-middle">
        <div class="row align-items-center h-100">
            <div class="mx-auto">
                <div class="h-100 justify-content-center">
                    <div>
                        <label> Home > Sign IN </label>
                        <h1>SIGN IN</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center text-center" style="margin-top:50px;">
            <div class="col-md-8">
                {{-- <div class="card"> --}}
                <span class="sign-text"> {{ isset($url) ? $url : '' }} Sign In</span>
                {{-- <div class="card-header"> {{ isset($url) ? ucwords($url) : ""}} {{ __('Login') }}</div> --}}
                {{-- <div class="card-body"> --}}
                @isset($url)
                    {{-- {{$url}} --}}
                    @php
                        $url == 'admin' ? 'digiso-admin' : 'admin';
                    @endphp
                @endisset
                <form method="POST" action="{{ route('blogger.login') }}" aria-label="{{ __('Login') }}">

                    @csrf
                    <div class="form-group row">
                        {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" required autocomplete="off" value="" placeholder="E-mail">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control" name="password" required
                                autocomplete="off" value="" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <div>
                                <button type="submit" class="btn btn-green">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
                {{-- </div> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>
    <style>
        .sign-text {
            font-style: normal;
            font-weight: normal;
            font-size: 36px;
            line-height: 49px;
            text-transform: uppercase;

            color: #797979;
        }

        form {
            margin-top: 40px;
        }

        .form-control {
            background: #FFFFFF;
            border: 1px solid #81D8D0;
            box-sizing: border-box;
            border-radius: 5px;
        }

        input:-internal-autofill-selected {
            background-color: rgb(255, 255, 255) !important;
            background-image: none !important;
            color: rgb(0, 0, 0) !important;
        }


        button {
            color: #FFFFFF;
            background: #81D8D0;
            border: 1px solid #81D8D0;
            box-sizing: border-box;
            border-radius: 5px;
        }

    </style>
@endsection
