@extends('layouts.app')


@section('content')

    <div class="container" style="margin-top: 80px">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left text-center">
                    <h2>Create an Account</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
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
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password:</strong>
                    {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group" style="display: none">
                    <strong>Role:</strong>
                    <select class="form-control" name="roles" id="roles">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ $role == 'Customer' ? 'selected' : '' }}>
                                {{ $role }}</option>
                            {{-- {!! $userRole !!} --}}
                            {{-- <option>{{ $role->name }}</option> --}}
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
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
