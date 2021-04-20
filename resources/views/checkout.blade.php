@extends('layouts.main')

@section('content')
    <div class="header-green text-center align-middle">
        <div class="row align-items-center h-100">
            <div class="mx-auto">
                <div class="h-100 justify-content-center">
                    <div>
                        <label> Home > Checkout </label>
                        <h1>Checkout</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 80px">

        @if (session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if (session()->has('alert_msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="row text-center">
                    <div class="col-lg-8">
                        <h2 class="text-header text-left"> Sign In </h2>
                        <form method="POST" action="{{ route('blogger.login') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row text-left">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                    <a href="">Forgot your password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if (count($cartCollection) > 0)
                <div class="col-lg-6">
                    <h2 class="text-header">Create an Accounts</h2>
                  
                    {!! Form::model(['method' => 'POST', 'route' => ['users.store']]) !!}
                    <div class="row"  style="margin-top: 2em">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {{-- <strong>Name:</strong> --}}
                                {!! Form::text('firstname', null, ['placeholder' => 'First name ', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {{-- <strong>Email:</strong> --}}
                                {!! Form::text('lastname', null, ['placeholder' => 'Last name', 'class' => 'form-control']) !!}
                            </div>
                        </div>


                        
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="form-group">
                                <input id="password" type="password" placeholder="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                                <input id="password-confirm" type="password" placeholder="password confirm" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {{-- <strong>Email:</strong> --}}
                                {!! Form::text('company', null, ['placeholder' => 'Company name', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {{-- <strong>Email:</strong> --}}
                                {!! Form::text('country', null, ['placeholder' => 'Country', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {{-- <strong>Email:</strong> --}}
                                {!! Form::text('region', null, ['placeholder' => 'Region', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {{-- <strong>Email:</strong> --}}
                                {!! Form::text('street-address', null, ['placeholder' => 'Street address', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {{-- <strong>Email:</strong> --}}
                                {!! Form::text('town', null, ['placeholder' => 'Town / City', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {{-- <strong>Email:</strong> --}}
                                {!! Form::text('state', null, ['placeholder' => 'State / County', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {{-- <strong>Email:</strong> --}}
                                {!! Form::text('postcode', null, ['placeholder' => 'Postcode / ZIP', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {{-- <strong>Email:</strong> --}}
                                {!! Form::text('phone', null, ['placeholder' => 'Phone', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {{-- <strong>Email:</strong> --}}
                                {!! Form::text('email', null, ['placeholder' => 'Email address', 'class' => 'form-control']) !!}
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button type="submit" class="btn btn-green">SAVE</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            @endif
        </div>
        <br><br>
    </div>
    <style>
        .btn {
            /* padding: 0.375rem 2.75rem; */
            background: #81D8D0;
            border: 1px solid #81D8D0;
            box-sizing: border-box;
            border-radius: 5px;
            font-family: Open Sans;
            font-style: normal;
            font-weight: normal;
            font-size: 14px;
            line-height: 19px;
            text-align: center;
            text-transform: uppercase;
            color: #FFFFFF;
        }

        .bg-dark {
            background-color: #81D8D0 !important;
        }

    </style>
@endsection
