@extends('layouts.app')


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
                    <h2>แก้ไขข้อมูล</h2>
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


        {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}
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
            <div class="col-xs-12 col-sm-12 col-md-12" style="display: none">
                <div class="form-group">
                    <strong>Role:</strong>
                    <select class="form-control" name="roles" id="roles">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ $role == 'Customer' ? 'selected' : '' }}>
                                {{ $role }}</option>
                            {{-- {!! $userRole !!} --}}
                            {{-- <option>{{ $role->name }}</option> --}}
                        @endforeach
                    </select>
                    {{-- {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!} --}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@endsection
