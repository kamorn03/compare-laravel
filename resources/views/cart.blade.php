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
            <div class="col-lg-7">
                <br>
                <h2 class="text-header">Shopping Cart</h2>

                @foreach ($cartCollection as $item)
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="/img/cards/{{ $item->attributes->image }}" width="200" height="200">
                        </div>
                        <div class="col-lg-7">
                            <p> <b>{{ $item->name }}</b><br>
                            <form action="{{ route('cart.update') }}" method="POST">
                                {{ csrf_field() }}
                                {{-- {{$item}} --}}
                                <div class="form-group row">
                                    <div class="col-7">
                                        <div class="num-block skin-5 w-100">
                                            <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                            <div class="num-in w-100">
                                                <span class="minus dis">-</span>
                                                <input type="number w-100" class="in-num" id="quantity" name="quantity"
                                                    value="{{ $item->quantity }}" readonly="">
                                                <span class="plus">+</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-secondary btn-sm" style="margin-right: 25px;"><i
                                                class="fa fa-edit"></i></button>
                                    </div>
                                </div>
                            </form>
                            <b>ราคา: </b> {{ $item->price }} ฿ <br>
                            <b>ทั้งหมด: </b> {{ \Cart::get($item->id)->getPriceSum() }} ฿ <br>
                            {{-- <b>With Discount: </b>${{ \Cart::get($item->id)->getPriceSumWithConditions() }} --}}
                            </p>
                        </div>
                        <div class="col-lg-2">
                            <div class="row">

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

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>Subtotal : </b>{{ \Cart::getTotal() }} ฿ </li>
                                <li class="list-group-item"><b>Total : </b>{{ \Cart::getTotal() }} ฿ </li>
                            </ul>

                            <div>
                                <a href="/" class="btn btn-default"><button class="btn btn-warning">Update Cart</button></a>
                                @guest
                                    <a href="/checkout" class="btn btn-success">Check Out</a>
                                @else
                                    <a href="/shipping" class="btn btn-success">Check Out</a>
                                @endguest
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
        .card {
            border: none;
        }

      

     

    </style>
@endsection
