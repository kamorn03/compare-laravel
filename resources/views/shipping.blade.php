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
            @foreach ($errors->all() as $error)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="row">
                    {{-- {{ json_encode(Auth::guard('blogger')->user()->address) }} --}}
                    @if (!isset(Auth::guard('blogger')->user()->address))
                        <div class="col-lg-12">
                            <h3>Shipping Address</h3>
                            {{-- {{ Auth::user()->id }} --}}
                            <form
                                action="{{ route('users.update.address', ['id' => Auth::guard('blogger')->user() ? Auth::guard('blogger')->user()->id : 1]) }}"
                                method="post">
                                @csrf
                                <div class="form-group ">
                                    <div class="col-md-8 ">
                                        <input class="form-control form-control-lg" type="text" name="firstname"
                                            id="firstname" placeholder="FIRST NAME" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="text" name="lastname"
                                            id="lastname" placeholder="LAST NAME" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="text" name="company" id="company"
                                            placeholder="Company name (optional)" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-2">
                                        <select name="country" class="form-control" id="country">
                                            <option value="0" label="Select a country ... " selected="selected">Select a
                                                country ... </option>
                                            <option value="TH" label="Thailand">Thailand</option>
                                        </select>
                                        {{-- <select class="form-control form-control-lg">
                                            <option>Country / Region</option>
                                            <option>Thailand</option>
                                        </select> --}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="text" name="address" id="address"
                                            placeholder="Street address" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="text" name="country" id="country"
                                            placeholder="Country / Region" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control" type="text" name="city" id="city"
                                            placeholder="Town / City" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <select class="form-control">
                                            <option value="0" label="Select State / County ... " selected="selected"> Select
                                                State / County </option>
                                            <option value="เชียงใหม่">เชียงใหม่</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="number" name="zipcode"
                                            id="zipcode" placeholder="Postcode / ZIP" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="number" name="phone" id="phone"
                                            placeholder="Phone" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="email" name="email" id="email"
                                            placeholder="Email address" />
                                    </div>
                                </div>
                                <button class="btn btn-green">บันทึก</button>
                            </form>

                            {{-- <form class="form-address" style="display: none"
                                action="{{ route('users.update.address', ['id' => Auth::guard('blogger')->user() ? Auth::guard('blogger')->user()->id : 1]) }}"
                                method="post">
                                @csrf
                                <div class="form-group ">
                                    <div class="col-md-8 ">
                                        <input class="form-control form-control-lg" type="text" name="firstname"
                                            id="firstname" placeholder="FIRST NAME" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="text" name="lastname"
                                            id="lastname" placeholder="LAST NAME" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="text" name="companyname"
                                            id="companyname" placeholder="Company name (optional)" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-2">
                                        <select class="form-control form-control-lg">
                                            <option>Country / Region</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="text" name="streetaddress"
                                            id="streetaddress" placeholder="Street address" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="text" name="countryregion"
                                            id="countryregion" placeholder="Country / Region" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="text" name="towncity"
                                            id="towncity" placeholder="Town / City" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <select class="form-control form-control-lg">
                                            <option>State / County</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="text" name="towncity"
                                            id="towncity" placeholder="Town / City" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="number" name="postcodezip"
                                            id="postcodezip" placeholder="Postcode / ZIP" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="number" name="phone" id="phone"
                                            placeholder="Phone" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="email" name="email" id="email"
                                            placeholder="Email address" />
                                    </div>
                                </div>

                                <button class="btn btn-green">บันทึก</button>
                            </form> --}}
                        </div>
                    @else
                        <div class="col-lg-12">
                            <h3 class="text-header"> Shipping Address</h3>
                            @php
                                $address = Auth::guard('blogger')->user()->address;
                                $user = Auth::guard('blogger')->user();
                                if ($user->name) {
                                    $name = explode(' ', $user->name);
                                }
                                if ($user->email) {
                                    $email = $user->email;
                                }
                            @endphp

                            <form class="form-address" style="display: none"
                                action="{{ route('users.update.address', ['id' => Auth::guard('blogger')->user() ? Auth::guard('blogger')->user()->id : 1]) }}"
                                method="post">
                                @csrf
                                <div class="form-group ">
                                    <div class="col-md-8 ">
                                        <input class="form-control form-control-lg" type="text" name="firstname"
                                            id="firstname" value="{{ $name[0] ?? '' }}" placeholder="FIRST NAME" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="text" name="lastname"
                                            id="lastname" value="{{ $name[1] ?? '' }}" placeholder="LAST NAME" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="text" name="company" id="company"
                                            value="{{ Arr::get($address, 'company') }}"
                                            placeholder="Company name (optional)" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-2">
                                        <select name="country" class="form-control" id="country">
                                            <option value="0" label="Select a country ... " selected="selected">Select a
                                                country ... </option>
                                            <option value="TH" label="Thailand">Thailand</option>
                                        </select>
                                        {{-- <select class="form-control form-control-lg">
                                            <option>Country / Region</option>
                                            <option>Thailand</option>
                                        </select> --}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" type="text"
                                            value="{{ Arr::get($address, 'address') }}" name="address" id="address"
                                            placeholder="Street address" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg"
                                            value="{{ Arr::get($address, 'country') }}" type="text" name="country"
                                            id="country " placeholder="Country / Region" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg"
                                            value="{{ Arr::get($address, 'city') }}" type="text" name="city" id="city"
                                            placeholder="Town / City" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <select class="form-control form-control-lg">
                                            <option>State / County</option>
                                            <option>เชียงใหม่</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg"
                                            value="{{ Arr::get($address, 'zip') }}" type="number" name="zipcode"
                                            id="zipcode" placeholder="Postcode / ZIP" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg"
                                            value="{{ Arr::get($address, 'phone') }}" type="number" name="phone"
                                            id="phone" placeholder="Phone" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 mb-1">
                                        <input class="form-control form-control-lg" value="{{ $email ?? '' }}"
                                            type="email" name="email" id="email" placeholder="Email address" />
                                    </div>
                                </div>
                                {{-- <label class="field">
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

                                         <label class="field">
                                        <span class="field__label" for="state">State</span>
                                        <select class="form-control" id="state">
                                            <option value=""></option>
                                        </select>
                                    </label>
                                    </div> --}}
                                <button class="btn btn-green">บันทึก</button>
                            </form>


                            {{-- {{ json_encode($address) }} --}}

                            <div class="card data-address" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">ที่อยู่</h5>
                                    {{-- <h6 class="card-subtitle mb-2 text-muted">ที่อยู่</h6> --}}
                                    <p class="card-text">ชื่อ {{ Auth::guard('blogger')->user()->name }}</p>
                                    <p class="card-text">{{ Arr::get($address, 'address') }}</p>
                                    <p>จังหวัด {{ Arr::get($address, 'country') }} อำเภอ
                                        {{ Arr::get($address, 'city') }}</p>
                                    <p>รหัส {{ Arr::get($address, 'zip') }}</p>
                                </div>
                            </div>

                        </div>
                    @endif
                </div>
                <div class="row w-100 text-right float-right">
                    <div class="col-10">
                        @if (isset(Auth::guard('blogger')->user()->address))
                            <a onclick="$('.form-address').toggle();$('.data-address').toggle()">แก้ไขที่อยู่</a>
                        @endif
                    </div>

                </div>
            </div>
            @if (count($cartCollection) > 0)
                <div class="col-lg-5 bg-gray">
                    <h1 class="text-header text-center">Order Summary</h1>
                    @foreach ($cartCollection as $item)
                        <div class="row mt-5">
                            <div class="col-lg-3">
                                <img src="/img/cards/{{ $item->attributes->image }}" class="img-thumbnail" width="200"
                                    height="200">
                            </div>
                            <div class="col-lg-5">
                                <p>
                                    <b>{{ $item->name }}</b><br>
                                    <b>price: </b>{{ $item->price }} ฿ <br>
                                    <b>total: </b>{{ \Cart::get($item->id)->getPriceSum() }} ฿ <br>
                                    {{-- <b>With Discount: </b>${{ \Cart::get($item->id)->getPriceSumWithConditions() }} --}}
                                </p>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    {{-- <form action="{{ route('cart.update') }}" method="POST">
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
                                    </form> --}}
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    {{-- {{ Auth::user()->address }} --}}
                    @if (isset(Auth::guard('blogger')->user()->address))
                        @if (count($cartCollection) > 0)
                            <form action="{{ route('cart.confirm') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="address" id="address"
                                    value="{{ json_encode(Auth::guard('blogger')->user()->address) }}">
                                <button class="btn btn-green w-100 btn-md">CONTINUE</button>
                            </form>
                        @endif
                    @else
                        <button class="btn btn-green w-100 btn-md" onclick="alertAddress()">CONTINUE</button>
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

        .bg-gray {
            background: #FAFAFA
        }

    </style>
@endsection

@push('script')
    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script> --}}
    <script type="text/javascript"
        src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript"
        src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
    <link rel="stylesheet"
        href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <script type="text/javascript"
        src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
    <script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script>
        function alertAddress() {
            Swal.fire(
                'Attention!',
                'Please fill the address for shipping!',
                'warning'
            )
        }
        $.Thailand({
            $district: $('#district'), // input ของตำบล
            $amphoe: $('#amphoe'), // input ของอำเภอ
            $province: $('#province'), // input ของจังหวัด
            $zipcode: $('#zipcode'), // input ของรหัสไปรษณีย์
        });

    </script>
