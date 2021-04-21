@extends('admin-layouts.admin_app')

@section('content')
    <div class="container" style="margin-top: 80px">
        <div class="row justify-content-center">
            <div class="row text-center">
                <h1 class="text-header">Order : {{ $data_order->order_no }}</h1>
            </div>
            <div class="col-lg-10">
                <table class="table table-borderless text-center">
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
                    <span class="info-sum">
                        {{-- {{ Auth::guard('blogger')->user()->name }} <br /> --}}
                        <br />

                        {{ $address->address ?? '' }} {{ $address->city ?? '' }} {{ $address->country ?? '' }}<br />
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
                            <div class="order-table">
                                <h3>{{ $item->name }}</h3>

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
                    <div class="order-table-subtotal-right col-2 float-right">${{ $totalPrice }}</div>
                </div>
                <hr>
                <div class="row table-total">
                    <div class="order-table-total-left col-2"><b>Total</b></div>
                    <div class="col-8"></div>
                    <div class="order-table-total-right col-2 float-right">{{ $totalPrice }} ฿</div>
                </div>
                <div class="row table-total">
                    <div class="order-table-total-left col-2"><b>Payment method</b></div>
                    <div class="col-8"></div>
                    <div class="order-table-total-right col-2 float-right">2C2P</div>
                </div>
                <div class="row">
                    <h1 class="text-center">
                        <span class="text-header">total</span> <br>
                        {{ $totalPrice }} ฿
                    </h1>
                </div>
                {{-- payment --}}

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

        .table-subtotal {
            justify-content: flex-end;
        }

        .table-total {
            justify-content: flex-end;
        }

        .bg-dark {
            background-color: #81D8D0 !important;
        }

        hr {
            border: 1px solid #81D8D0;
        }

    </style>
@endsection
