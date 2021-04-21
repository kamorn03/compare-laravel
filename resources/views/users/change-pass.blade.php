@extends('layouts.main')


@section('content')
    <div class="header-green text-center align-middle">
        <div class="row align-items-center h-100">
            <div class="mx-auto">
                <div class="h-100 justify-content-center">
                    <div>
                        <label> Home > account</label>
                        <h1>Account</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container" style="margin-top: 80px">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="text-header">Your Account</h2>
                </div>

                {{-- <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                </div> --}}
            </div>
        </div>


        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="row justify-content-center" style="margin-bottom: 20rem">
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-lg-3">
                        {{-- <img src="/img/cards/{{ $item->attributes->image }}" width="200" height="200"> --}}
                    </div>
                    <div class="col-lg-7">
                        <p class="text-menu"><a
                                href="{{ route('users.edit', ['user' => Auth::guard('blogger')->user()->id]) }}">Personal
                                Information </a></p>
                        <p class="text-menu"><a href="{{ route('users.cart.order') }}">Orders </a></p>
                        <p class="text-menu active">Change Password </p>
                        <p class="text-menu"><a href="{{ route('logout') }}"> Sign out </a></p>
                    </div>
                </div>
            </div>

            {{-- First name * Last name * Company name (optional) Country / Region * Street address * Town / City * State / County * Postcode / ZIP * Phone * Email address * --}}
            <div class="col-lg-7 mb-50">



                {!! Form::model($user, ['method' => 'POST', 'route' => ['users.update.password', $user->id]]) !!}
                <div class="row">
                    <div class="col-lg-7">
                        @csrf
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="form-group">
                                <input id="password" type="password" placeholder="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> --}}
                            <div class="form-group">
                                <input id="newpassword" type="password" placeholder="new password" class="form-control"
                                    name="newpassword" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> --}}
                            <div class="form-group">
                                <input id="confirm-password" type="password" placeholder="confirm password"
                                    class="form-control" name="confirm-password" required autocomplete="confirm-password">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3 row">
                            <div class="col-md-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Show password
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5 float-left">
                                @if (Route::has('password.request'))
                                    <a class="" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button type="submit" class="btn btn-green">SAVE</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <style>
        a {
            color: #797979;
            text-decoration: none;
            background-color: transparent;
        }

    </style>
@endsection
