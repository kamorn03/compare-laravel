@extends('layouts.main')

@section('content')
    <div class="header-green text-center align-middle">
        <div class="row align-items-center h-100">
            <div class="mx-auto">
                <div class="h-100 justify-content-center">
                    <div>
                        <label> Home > Cart </label>
                        <h1>cart</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 35px">

        <div class="row justify-content-center">
            <div class="col-lg-7">
                <h2 class="text-header">Shopping Cart</h2>

                @foreach ($cartCollection as $item)
                    <div class="row mt-5">
                        <div class="col-lg-3">
                            <img src="/img/cards/{{ $item->attributes->image }}" width="160" height="160">
                        </div>
                        <div class="col-lg-9">
                            <b class="text-product-name">{{ $item->name }}</b><br>
                            <form action="{{ route('cart.update') }}" method="POST">
                                {{ csrf_field() }}
                                {{-- {{$item}} --}}
                                <div class="form-group row mt-3">
                                    <div class="col-7">
                                        <div class="num-block skin-5 w-100">
                                            <input type="hidden" value="{{ $item->id }}" id="id{{ $item->id }}"
                                                name="id">
                                            <div class="num-in w-100">
                                                <span class="minus dis">-</span>
                                                <input type="number w-100" class="in-num" id="quantity-{{ $item->id }}"
                                                    name="quantity" value="{{ $item->quantity }}" readonly="">
                                                <span class="plus">+</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-right float-right">
                                        <b> {{ $item->price }} ฿ </b>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-secondary btn-sm" style="margin-right: 25px;"><i
                                                class="fa fa-edit"></i></button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-7">
                                        {{-- <div class="num-block skin-5 w-100">
                                            <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                            <div class="num-in w-100">
                                                <span class="minus dis">-</span>
                                                <input type="number w-100" class="in-num" id="quantity" name="quantity"
                                                    value="{{ $item->quantity }}" readonly="">
                                                <span class="plus">+</span>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="col-3 text-right float-right">
                                        <form class="form-remove" action="{{ route('cart.remove') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $item->id }}" id="id-{{ $item->id }}"
                                                name="id">
                                            <button><i class="fa fa-trash"></i></button>
                                            {{-- <a onclick="$('.form-remove').submit();" style=" cursor: pointer;"><i
                                                    class="fa fa-trash"></i></a> --}}
                                        </form>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if (count($cartCollection) > 0)
                    {{-- <form action="{{ route('cart.clear') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-secondary btn-md">Clear Cart</button>
                    </form> --}}
                @endif
            </div>
            @if (count($cartCollection) > 0)
                <div class="col-lg-5">
                    <div class="card bg-light text-dark">
                        <div class="card-body">
                            <h2 class="text-header">Cart totals</h2>

                            <div class="row mt-5">
                                <div class="col-6">
                                    Subtotal
                                </div>
                                <div class="col-6 text-right float-right">
                                    <b> {{ \Cart::getTotal() }} ฿ </b>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    Total
                                </div>
                                <div class="col-6 text-right float-right">
                                    <b> {{ \Cart::getTotal() }} ฿ </b>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-12">
                                    <button class="btn btn-default-gray w-100">Update Cart</button>
                                </div>
                                <div class="col-12 mt-3">
                                    @if (!Auth::guard('blogger')->user())
                                        <a href="/checkout" class="btn btn-green-checkout w-100">Check Out</a>
                                    @else
                                        <a href="/shipping" class="btn btn-green-checkout w-100">Check Out</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>
    <script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script>
        /////////////////// product +/-
        $(document).ready(function() {
            $('.num-in span').click(function() {
                console.log('in');
                var $input = $(this).parents('.num-block').find('input.in-num');
                if ($(this).hasClass('minus')) {
                    var count = parseFloat($input.val()) - 1;
                    count = count < 1 ? 1 : count;
                    if (count < 2) {
                        $(this).addClass('dis');
                    } else {
                        $(this).removeClass('dis');
                    }
                    $input.val(count);
                } else {
                    var count = parseFloat($input.val()) + 1
                    $input.val(count);
                    if (count > 1) {
                        $(this).parents('.num-block').find(('.minus')).removeClass('dis');
                    }
                }

                $input.change();
                return false;
            });

        });
        // product +/-

    </script>
    <style>
        hr {
            border: 1px solid #81D8D0;
        }

        .card {
            border: none;
        }

        .skin-5 .num-in span {
            font-size: 16px;
            width: 18px;
            display: block;
            line-height: 41px;
            cursor: pointer;
        }

        button {
            border: none;
            background: none;
            margin-right: 0;
            padding-right: 0;
        }


        .btn-default-gray {
            background: #C4C4C4;
            border-radius: 5px;
            color: #fff;
        }

        .btn-default-gray:hover {
            color: #fff;
        }


        .btn-green-checkout {
            /* padding: 0.375rem 2.75rem; */
            background: #81D8D0;
            border: 1px solid #81D8D0;
            box-sizing: border-box;
            border-radius: 5px;
            font-family: 'Open Sans';
            width: 250px;
            height: auto;
            font-style: normal;
            font-weight: normal;
            font-size: 14px;
            line-height: 19px;
            text-align: center;
            text-transform: uppercase;
            color: #FFFFFF;
        }

        .btn-green-checkout:hover {
            color: #fff;
        }


        .text-product-name {
            font-size: 16px;
            line-height: 22px;
            /* identical to box height */
            color: #797979;
        }

    </style>
@endsection
