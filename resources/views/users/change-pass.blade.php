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
