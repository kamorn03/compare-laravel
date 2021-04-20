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


        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-3">
                        {{-- <img src="/img/cards/{{ $item->attributes->image }}" width="200" height="200"> --}}
                    </div>
                    <div class="col-lg-7">
                        <p class="text-menu active">Personal Information</p>
                        <p class="text-menu"><a href="{{ route('users.cart.order') }}">Orders </a></p>
                        <p class="text-menu">Change Password</p>
                        <p class="text-menu"><a href="{{ route('logout') }}"> Sign out </a></p>
                    </div>
                </div>
            </div>

            {{-- First name * Last name * Company name (optional) Country / Region * Street address * Town / City * State / County * Postcode / ZIP * Phone * Email address * --}}
            <div class="col-lg-6">
                {{-- {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!} --}}
                {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update' , $user->id]]) !!}
                <div class="row">
                    @php
                        if ($user->name) {
                            $name = explode(' ', $user->name);
                        }
                        $address[0] = [];
                        if ($user->address) {
                            $address = $user->address; 
                        }
                       
                        // dd($address);
                    @endphp
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            {{-- <strong>Name:</strong> --}}
                            {!! Form::text('firstname', $name[0], ['placeholder' => 'First name ', 'value' => $name[0], 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            {{-- <strong>Email:</strong> --}}
                            {!! Form::text('lastname', $name[1], ['placeholder' => 'Last name', 'class' => 'form-control']) !!}
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
                            {!! Form::text('street-address',  Arr::get($address , 'address'), ['placeholder' => 'Street address', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            {{-- <strong>Email:</strong> --}}
                            {!! Form::text('town',  Arr::get($address , 'city'), ['placeholder' => 'Town / City', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            {{-- <strong>Email:</strong> --}}
                            {!! Form::text('state', Arr::get($address , 'country') , ['placeholder' => 'State / Country', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            {{-- <strong>Email:</strong> --}}
                            {!! Form::text('postcode',  Arr::get($address , 'zip'), ['placeholder' => 'Postcode / ZIP', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
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
