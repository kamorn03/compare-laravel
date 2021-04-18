@extends('layouts.main')

@section('content')

    <div class="header-green text-center align-middle">
        <div class="row align-items-center h-100">
            <div class="mx-auto">
                <div class="h-100 justify-content-center">
                    <div>
                        <label> Home
                            {{ $category ? '  >  ' . $category : null }}
                            {{ $collection ? '  >  ' . $collection : null }}</label>
                        <h1>{{ $collection ? $collection : $category }} </h1>
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

        <div>
            <div class="row">
                @foreach ($product_list as $product)
                    <div class="col-6 col-sm-2">
                        <div class="card custom-card-home" style="margin-bottom: 20px; height: auto;">
                            <a
                                href="/shop/{{ $product->cate_slug }}/{{ $product->collect_slug ?? 'non-collection' }}/{{ $product->slug }}"><img
                                    src="/img/cards/{{ $product->image_path }}" class="card-img-top mx-auto"
                                    style="height: 150px; width: 150px;display: block;"
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
@endsection
