@extends('layouts.main')

@section('content')

    <div class="header-green text-center align-middle">
        <div class="row align-items-center h-100">
            <div class="mx-auto">
                <div class="h-100 justify-content-center">
                    {{-- {{$products[0]}} --}}
                    @php
                        $category = [];
                        $collection = [];
                        if (isset($products[0])) {
                            $category = App\Models\Category::find($products[0]->category_id);
                            $collection = App\Models\Collections::find($products[0]->collection_id);
                        }
                    @endphp
                    <div>
                        <label> Home > {{ $category->name }}
                            {{ $category != [] ? '  >  ' . $category->name : null }} {{ $products[0]->name }}</label>
                        <h1>{{ $products[0]->name }} </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 80px">
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">
                        <div class="preview-pic tab-content">
                            @php
                                $product_image = App\Models\ProductImage::where('product_id', $products[0]->id)->get();
                            @endphp
                            <div class="tab-pane active" id="pic-1"><img
                                    src="/img/cards/{{ $products[0]->image_path }}" /></div>

                            @foreach ($product_image as $key => $item)
                                <div class="tab-pane" id="pic-{{ $key + 2 }}"><img
                                        src="{{ asset($item->filepath) }}" />
                                </div>
                            @endforeach
                            {{-- <div class="tab-pane" id="pic-3"><img src="/img/cards/{{ $products[0]->image_path }}" />
                            </div>
                            <div class="tab-pane" id="pic-4"><img src="/img/cards/{{ $products[0]->image_path }}" />
                            </div>
                            <div class="tab-pane" id="pic-5"><img src="/img/cards/{{ $products[0]->image_path }}" />
                            </div> --}}
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">
                            <li class="active"><a data-target="#pic-1" data-toggle="tab"><img
                                        src="/img/cards/{{ $products[0]->image_path }}" />
                                </a>
                            </li>
                            @foreach ($product_image as $key => $item)
                                <li class="active"><a data-target="#pic-{{ $key + 2 }}" data-toggle="tab"><img
                                            src="{{ asset($item->filepath) }}" />
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="details col-md-6">
                        <form action="{{ route('cart.store') }}" method="POST">
                            <h3 class="text-name">{{ $products[0]->name }}</h3>

                            <h3 class="product-title" style="font-weight: bold;color: black;"> {{ $products[0]->price }}
                                ฿ </h3>


                            {{-- <h5 class="sizes">sizes: </h5>
                            <div class="num-block w-100">
                                <select class="form-control" name="" id="">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </select>
                            </div> --}}


                            <h5 class="title">size </h5>
                            <div class="action">
                                <input type="number w-100" class="form-control" id="size" name="size" value="1">
                            </div>

                            <h5 class="title">Quantity </h5>
                            <div class="action">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $products[0]->id }}" id="id" name="id">
                                <input type="hidden" value="{{ $products[0]->name }}" id="name" name="name">
                                <input type="hidden" value="{{ $products[0]->price }}" id="price" name="price">
                                <input type="hidden" value="{{ $products[0]->image_path }}" id="img" name="img">
                                <input type="hidden" value="{{ $products[0]->slug }}" id="slug" name="slug">
                                <!-- skin 5 -->
                                <div class="num-block skin-5 w-100">
                                    <div class="num-in w-100">
                                        <span class="minus dis">-</span>
                                        <input type="number w-100" class="in-num" id="quantity" name="quantity" value="1"
                                            readonly="">
                                        <span class="plus">+</span>
                                    </div>
                                </div>
                                <!-- / skin 5 -->
                                <button class=" btn btn-default-gray  w-100" type="submit">add to cart</button>

                                {{-- <button class=" btn btn-default btn-green w-100" type="submit">add to cart</button> --}}
                                {{-- <button class="like btn btn-default" type="button"><span
                                        class="fa fa-heart"></span></button> --}}

                            </div>

                        </form>
                        <div style="margin-top: 15px;">
                            <p> {!! $products[0]->description !!} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div>
            <h1 class="text-center"> You May Also Like </h1>
            <div>
                <div class="row">
                    @foreach ($wish_list as $product)
                        <div class="col-6 col-sm-2">
                            <div class="card custom-card-home" style="margin-bottom: 20px; height: auto;">
                                <a
                                    href="/shop/{{ $product->cate_slug }}/{{ $product->collect_slug ?? 'non-collection' }}/{{ $product->slug }}"><img
                                        src="/img/cards/{{ $product->image_path }}" class="card-img-top mx-auto"
                                        style="height: 200px; width: 250px;display: block;"
                                        alt="{{ $product->image_path }}"></a>
                                <div class="card-body custom-card-home">
                                    <h6 class="card-title">{{ $product->name }}</h6>
                                    <p style="font-weight: bold;color: black;"> {{ $product->price }} ฿ </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
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
        /*****************globals*************/
        body {
            font-family: 'open sans';
            overflow-x: hidden;
        }

        img {
            max-width: 100%;
        }

        .tab-pane {
            text-align: center;
        }

        .tab-pane img {
            max-width: 60%;
        }

        .title {
            margin-top: 10px
        }

        .text-name {
            font-style: normal;
            font-weight: normal;
            font-size: 24px;
            line-height: 33px;
            color: #797979;
        }

        .text-product-name {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: normal;
            font-size: 36px;
            line-height: 49px;
            text-align: center;
            text-transform: uppercase;
            color: #797979;
        }

        .btn-default-gray {
            background: #C4C4C4;
            border-radius: 5px;
            color: #fff;
        }

        .btn-default-gray:hover {
            color: #fff;
        }


        form #input-wrap {
            margin: 0px;
            padding: 0px;
        }

        input#number {
            text-align: center;
            border: none;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            margin: 0px;
            width: 40px;
            height: 40px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .preview {
            display: '-webkit-box';
            display: '-webkit-flex';
            display: '-ms-flexbox';
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        @media screen and (max-width: 996px) {
            .preview {
                margin-bottom: 20px;
            }
        }

        .preview-pic {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .preview-thumbnail.nav-tabs {
            border: none;
            margin-top: 15px;
        }

        .preview-thumbnail.nav-tabs li {
            width: 18%;
            margin-right: 2.5%;
        }

        .preview-thumbnail.nav-tabs li img {
            max-width: 100%;
            display: block;
        }

        .preview-thumbnail.nav-tabs li a {
            padding: 0;
            margin: 0;
        }

        .preview-thumbnail.nav-tabs li:last-of-type {
            margin-right: 0;
        }

        .tab-content {
            overflow: hidden;
        }

        .tab-content img {
            width: 100%;
            -webkit-animation-name: opacity;
            animation-name: opacity;
            -webkit-animation-duration: .3s;
            animation-duration: .3s;
        }



        .card {
            margin-top: 50px;
            /* background: #eee; */
            border: 0px;
            padding: 0em;
            line-height: 1.5em;
        }



        @media screen and (min-width: 997px) {
            .wrapper {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
            }
        }

        .details {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .colors {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .product-title,
        .price,
        .sizes,
        .colors {
            text-transform: UPPERCASE;
            font-weight: bold;
        }

        .checked,
        .price span {
            color: #ff9f1a;
        }

        .product-title,
        .rating,
        .product-description,
        .price,
        .vote,
        .sizes {
            margin-bottom: 15px;
        }

        .product-title {
            margin-top: 0;
        }

        .size {
            margin-right: 10px;
        }

        .size:first-of-type {
            margin-left: 40px;
        }

        .color {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
            height: 2em;
            width: 2em;
            border-radius: 2px;
        }

        .color:first-of-type {
            margin-left: 20px;
        }

        .add-to-cart,
        .like {
            background: #ff9f1a;
            padding: 1.2em 1.5em;
            border: none;
            text-transform: UPPERCASE;
            font-weight: bold;
            color: #fff;
            -webkit-transition: background .3s ease;
            transition: background .3s ease;
        }

        .add-to-cart:hover,
        .like:hover {
            background: #b36800;
            color: #fff;
        }

        .not-available {
            text-align: center;
            line-height: 2em;
        }

        .not-available:before {
            font-family: fontawesome;
            content: "\f00d";
            color: #fff;
        }

        .orange {
            background: #ff9f1a;
        }

        .green {
            background: #85ad00;
        }

        .blue {
            background: #0076ad;
        }

        .tooltip-inner {
            padding: 1.3em;
        }

        @-webkit-keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3);
            }

            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3);
            }

            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        /*# sourceMappingURL=style.css.map */

    </style>
@endsection
