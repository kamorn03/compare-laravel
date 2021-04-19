@extends('layouts.app')

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
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1>สรุปรายการสั่งชื้อ</h1>
                    </div>
                </div>
                @php
                    $totalPrice = 0;
                @endphp
                @foreach (json_decode($data_order->cart) as $item)
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="/img/cards/{{ $item->attributes->image }}" class="img-thumbnail" width="200"
                                height="200">
                        </div>
                        <div class="col-lg-9">
                            <p>
                                <b><a href="/shop/{{ $item->attributes->slug }}">{{ $item->name }}</a></b><br>
                                <b>ราคา: </b> {{ $item->price }} ฿ <br>
                                @php
                                    $totalPrice += $item->price;
                                @endphp
                            </p>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <h1 class="text-center"> ราคาสินค้ารวม {{ $totalPrice }} ฿ </h1>
                {{-- payment --}}
                <div class="text-center">
                    <img src="{{ asset('img/pngegg.png') }}" alt="visa/master" height="40"> <br> <br>
                    <form action="/verify-payment" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" value="{{ $data_order->id }}">
                        <button class="btn" type="submit"> ยืนยันการชำระเงิน </button>
                    </form>
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
