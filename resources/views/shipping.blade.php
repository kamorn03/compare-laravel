@extends('layouts.main')
@section('content')

    <div class="header-green text-center align-middle">
        <div class="row align-items-center ">
            <div class="mx-auto">
                <div class="h-100 justify-content-center">
                    <div>
                        <label> Home > Cart > Checkout > Shipping </label>
                        <h1>Shipping</h1>
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
        @if (count($errors) > 0)
            @foreach ($errors0 > all() as $error)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif


        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="row">
                    @if (!isset(Auth::user()->address))
                        <div class="col-lg-12">
                            <h3>Shipping Address</h3>
                            {{-- {{ Auth::user()->id }} --}}
                            <form action="{{ route('users.update.address', ['id' => Auth::user()->id]) }}" method="post">
                                @csrf
                                <div class="form">
                                    <label class="field">
                                        <span class="field__label" for="address">Address</span>
                                        <input class="form-control" type="text" name="address" id="address" />
                                    </label>
                                    <label class="field">
                                        <span class="field__label" for="country">Country</span>
                                        <select class="form-control" name="country" id="country">
                                            <option value=""></option>
                                            <option value="unitedstates">United States</option>
                                        </select>
                                    </label>
                                    <div class="fields fields--3">
                                        <label class="field">
                                            <span class="field__label" for="city">City</span>
                                            <input class="form-control" name="city" type="text" id="" />
                                        </label>
                                        <label class="field">
                                            <span class="field__label" for="zipcode">Zip code</span>
                                            <input class="form-control" name="zipcode" type="text" id="zipcode" />
                                        </label>

                                        {{-- <label class="field">
                                        <span class="field__label" for="state">State</span>
                                        <select class="form-control" id="state">
                                            <option value=""></option>
                                        </select>
                                    </label> --}}
                                    </div>
                                </div>
                                <button class="btn btn-green">บันทึก</button>
                            </form>
                        </div>
                    @else
                        <div class="col-lg-12">
                            <h3>Shipping Address</h3>
                            @php
                                $address = Auth::guard('blogger')->user()->address;
                            @endphp
                            @foreach ($address as $locate)
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">ที่อยู่</h5>
                                        {{-- <h6 class="card-subtitle mb-2 text-muted">ที่อยู่</h6> --}}
                                        <p class="card-text">{{ $locate['address'] ?? $locate['address'] }}</p>
                                        <p>จังหวัด {{ $locate['country'] ?? $locate['country'] }} อำเภอ
                                            {{ $locate['city'] ?? $locate['city'] }}</p>
                                        <p>รหัส {{ $locate['zip'] ?? $locate['zip'] }}</p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif
                </div>
            </div>
            @if (count($cartCollection) > 0)
                <div class="col-lg-6">
                    <h1>Order Summary</h1>

                    @foreach ($cartCollection as $item)
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="/img/cards/{{ $item->attributes->image }}" class="img-thumbnail" width="200"
                                    height="200">
                            </div>
                            <div class="col-lg-5">
                                <p>
                                    <b><a href="/shop/{{ $item->attributes->slug }}">{{ $item->name }}</a></b><br>
                                    <b>ราคา: </b>{{ $item->price }} ฿ <br>
                                    <b>ทั้งหมด: </b>{{ \Cart::get($item->id)->getPriceSum() }} ฿ <br>
                                    {{-- <b>With Discount: </b>${{ \Cart::get($item->id)->getPriceSumWithConditions() }} --}}
                                </p>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                            <input type="number" class="form-control form-control-sm"
                                                value="{{ $item->quantity }}" id="quantity" name="quantity"
                                                style="width: 70px; margin-right: 10px;">
                                            <button class="btn btn-secondary btn-sm" style="margin-right: 25px;"><i
                                                    class="fa fa-edit"></i></button>
                                        </div>
                                    </form>
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                        <button class="btn btn-dark btn-sm" style="margin-right: 10px;"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    {{-- {{ Auth::user()->address }} --}}
                    @if (isset(Auth::user()->address))
                        @if (count($cartCollection) > 0)
                            <form action="{{ route('cart.confirm') }}" method="POST">
                                {{ csrf_field() }}
                                <button class="btn btn-secondary btn-md">Confirm</button>
                            </form>
                        @endif
                    @else
                        <button class="btn btn-secondary btn-md" onclick="alertAddress()">Confirm</button>
                    @endif
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

@push('script')
    <script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script>
        function alertAddress() {
            Swal.fire(
                'Attention!',
                'Please fill the address for shipping!',
                'warning'
            )
        }

    </script>
