@extends('layouts.main')


@section('content')

    <div class="container" style="margin-top: 80px">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left text-center">
                    <h2 class="text-header">Create an Account</h2>
                </div>
                <div class="pull-right">
                    {{-- <a class="btn btn-primary" href=""> Back</a> --}}
                </div>
            </div>
        </div>


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


        {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
        <div class="row text-center">
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

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-green">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}

    </div>

    <style>
        .form-control {
            border: 1px solid #81D8D0;
            box-sizing: border-box;
            border-radius: 5px;
            color:#81D8D0;  
        }

    </style>
@endsection
