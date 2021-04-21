@extends('layouts.main')

@section('content')
    <div class="header-green text-center align-middle">
        <div class="row align-items-center h-100">
            <div class="mx-auto">
                <div class="h-100 justify-content-center">
                    <div>
                        <label> Home > Cart > Checkout > Shipping > Order Complete </label>
                        <h1>Order Complete</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 80px">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="col-lg-12 text-left">
                    <h1 class="text-header">Thank you. Your order has been received.</h1>
                </div>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th class="sum" scope="col">ORDER NUMBER :</th>
                            <th class="sum" scope="col">DATE :</th>
                            <th class="sum" scope="col">TOTAL :</th>
                            <th class="sum" scope="col">PAYMENT METHOD :</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <th>{{ $data_order->order_no ?? '#' }}</th>
                            <th>{{ $data_order->created_at ?? '#' }}</th>
                            <th> @php
                                $price = 0;
                            @endphp
                                @foreach (json_decode($data_order->cart) as $cart)
                                    @php
                                        $price += $cart->price * $cart->quantity;
                                        
                                    @endphp
                                @endforeach
                                {{ $price }} ฿
                            </th>
                            <th>2C2P</th>
                        </tr>
                    </tbody>
                </table>
                <div class="info-sum-core col-lg-12 text-left">
                    <h1 class="text-header-sum">Address</h1>
                    @php
                        $address = json_decode($data_order->address);
                    @endphp
                    <span class="info-sum">{{ Auth::guard('blogger')->user()->name }} <br />
                        {{ $address->address ?? '' }} {{ $address->city ?? '' }} {{ $address->country ?? '' }}
                        {{ $address->zip ?? '' }}<br />
                        {{ $address->phone ?? '' }} {{ $address->email ?? '' }} <br />
                    </span>
                </div>
                @php
                    $totalPrice = 0;
                @endphp
                <div class="col-lg-12 text-left">
                    <h1 class="text-header-sum-table">Order details</h1>
                </div>
                @foreach (json_decode($data_order->cart) as $item)
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="/img/cards/{{ $item->attributes->image }}" class="img-thumbnail" width="200"
                                height="200">
                        </div>
                        <div class="col-lg-9">
                            <p>
                            <div class="order-table"><a
                                    href="/shop/{{ $item->attributes->slug }}">{{ $item->name }}</a>
                            </div><br>
                            <div class="row">
                                <div class="col-2">Size</div>
                                <div class="col-2">Quantity</div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    @if ($item->attributes->size)
                                        @php
                                            $size = App\Models\Size::find($cart->attributes->size);
                                            // dd($size)
                                        @endphp
                                        @if ($size)
                                            {{ $size->size }} <br>
                                        @else
                                            {{ $size['size'] ?? '-' }} <br>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </div>
                                <div class="col-2"> {{ $cart->quantity }}</div>
                                <div class="col-6"></div>
                                <div class="col-2"><b>${{ $item->price }}</b></div>
                            </div>
                            @php
                                $totalPrice += $item->price;
                            @endphp
                            </p>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <div class="row table-subtotal">
                    <div class="order-table-subtotal-left col-2">Subtotal</div>
                    <div class="col-8"></div>
                    <div class="order-table-subtotal-right col-2">${{ $totalPrice }}</div>
                </div>
                <hr>
                <div class="row table-total">
                    <div class="order-table-total-left col-2"><b>Total</b></div>
                    <div class="col-8"></div>
                    <div class="order-table-total-right col-2">${{ $totalPrice }}</div>
                </div>
                <div class="row table-total">
                    <div class="order-table-total-left col-2"><b>Payment method</b></div>
                    <div class="col-8"></div>
                    <div class="order-table-total-right col-2">paypal</div>
                </div>

                <h1 class="text-center "> <span class="text-header">total</span> {{ $totalPrice }} ฿ </h1>
                {{-- payment --}}
                <div class="text-center mt-5">
                   
                    <form action="/verify-payment" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" value="{{ $data_order->id }}">
                        <button class="btn" type="submit"> confirm payment</button>
                    </form>

                     <img class="mt-3" src="{{ asset('img/pngegg.png') }}" alt="visa/master" height="40"> <br> <br>
                </div>
                <hr>
            </div>
        </div>
    </div>

    <style>
        .btn {
            padding: 0.375rem 2.75rem;
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
