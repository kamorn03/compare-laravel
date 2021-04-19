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
                        <p class="text-menu"><a
                                href="{{ route('users.edit', ['user' => Auth::guard('blogger')->user()->id]) }}">Personal
                                Information </a></p>
                        <p class="text-menu active">Orders</p>
                        <p class="text-menu">Change Password</p>
                        <p class="text-menu"><a href="{{ route('logout') }}"> Sign out </a></p>
                    </div>
                </div>
            </div>

            {{-- First name * Last name * Company name (optional) Country / Region * Street address * Town / City * State / County * Postcode / ZIP * Phone * Email address * --}}
            <div class="col-lg-6 ">
                <div class="panel-group" id="accordionGroupOpen" role="tablist" aria-multiselectable="true">
                    <table class="table table-striped w-100 bg-gray">
                        <th>
                        <td>Order :</td>
                        <td>Date :</td>
                        <td>Status :</td>
                        <td>Total :</td>
                        <td>View : </td>
                        </th>
                    </table>
                    {{-- {{ $order }} --}}
                    @foreach ($order as $key => $item)
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading{{ $key }}">
                                <h4 class="panel-title">

                                    <table class="table w-100 bg-gray">
                                        <tr>
                                            <td>#{{ $item->order_no }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                @php
                                                    $price = 0;
                                                @endphp
                                                @foreach (json_decode($item->cart) as $cart)
                                                    @php
                                                        $price += $cart->price;
                                                    @endphp
                                                @endforeach
                                                {{ $price }} ฿ 
                                            </td>
                                            <td> <a role="button" data-toggle="collapse" data-parent="#accordionGroupOpen"
                                                    href="#collapseOpen{{ $key }}" aria-expanded="true"
                                                    aria-controls="collapseOpen{{ $key }}"></td>
                                            </th>
                                    </table>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOpen{{ $key }}" class="panel-collapse collapse in mb-3"
                                role="tabpanel" aria-labelledby="heading{{ $key }}">
                                <div class="panel-body">
                                    @foreach (json_decode($item->cart) as $cart)

                                        <div class="row">
                                            <div class="col-lg-3">
                                                <img src="/img/cards/{{ $cart->attributes->image }}"
                                                    class="img-thumbnail" width="200" height="200">
                                            </div>
                                            <div class="col-lg-9">
                                                <p>
                                                    <b><a
                                                            href="/shop/{{ $cart->attributes->slug }}">{{ $cart->name }}</a></b><br>
                                                    {{ $cart->price }} ฿ <br>

                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionGroupOpen"
                                    href="#collapseOpenThree" aria-expanded="false" aria-controls="collapseThree">
                                    Collapsible Group Item #3 Closed on Load
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOpenThree" class="panel-collapse collapse" role="tabpanel"
                            aria-labelledby="headingThree">
                            <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                                on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan
                                excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                                raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore
                                sustainable VHS.
                            </div>
                        </div>
                    </div> --}}
                </div>

            </div>
        </div>




    </div>

    <style>
        table {
            font-size: 14px;
        }

        a {
            color: #797979;
            text-decoration: none;
            background-color: transparent;
        }

        .bg-gray {
            background: #E5E5E5;
        }

        .panel,
        .panel-body {
            box-shadow: none;
        }

        .panel-group .panel-heading {
            padding: 0;
        }

        .panel-group .panel-heading a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            position: relative;
        }

        .panel-group .panel-heading a:after {
            content: '-';
            float: right;
        }

        .panel-group .panel-heading a.collapsed:after {
            content: '+';
        }

    </style>
@endsection
