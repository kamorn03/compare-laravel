@extends('admin-layouts.main-ui')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-tasks">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="float-left">Member detail</h1>
                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('admin.users') }}"> Back</a>
                            </div>
                            <div class="separator mb-5"></div>
                        </div>
                    </div>

                    <div class="container" style="margin: 50px auto 50px auto;">

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
                </div>
            </div>
        </div>
    </div>
    <style>
        .card-tasks {
            height: 100%;
        }
        .card label{
            font-size: 20px;
            font-weight: bold;
        }
        .card{
            font-size: 20px;
        }

    </style>
@endsection
