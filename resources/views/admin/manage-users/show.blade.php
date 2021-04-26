@extends('admin-layouts.main-ui')

@section('content')

    <div class="col-12">
        <h1>Member detail</h1>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('admin.users') }}"> Back</a>
        </div>
        <div class="separator mb-5"></div>
    </div>
    <div class="container" style="margin-top: 80px">

        <div class="form-group row">
            <label for="name" class="col-sm-2">Name</label>
            <div class="col-sm-10">
                <p>
                    {{ $user->name }}
                </p>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2">Email</label>
            <div class="col-sm-10">
                <p>
                    {{ $user->email }}
                </p>
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-sm-2">Address</label>
            <div class="col-sm-10">
                <p>
                    {{-- {{ json_encode($user->address)}} --}}
                    {{ $user->address['address'] ?? '' }}
                    {{ $user->address['city'] ?? '' }}
                    {{ $user->address['state'] ?? '' }}
                    {{ $user->address['zip'] ?? '' }}
                    เบอร์โทร {{ $user->address['phone'] ?? '-' }}


                    {{-- @foreach ($user->address as $address)
                       {{$address}}
                   @endforeach --}}
                </p>
            </div>
        </div>

    </div>
@endsection
