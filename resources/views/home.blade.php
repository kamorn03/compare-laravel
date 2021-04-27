@extends('layouts.main')

@section('content')
    <header>

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner" role="listbox">
                <!-- Slide One - Set the background image for this slide in the line below -->
                @if (isset($main_title) && sizeof($main_title) > 0)
                    @foreach ($main_title as $key => $value)
                        <a href="{{ $value->link ?? '#' }}">
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}"
                                style="background-image: url({{ asset($value->image_path) }})">
                                <div class="carousel-caption d-none d-md-block">
                                </div>
                            </div>
                        </a>
                        {{-- <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img class="d-block w-100" src="{{ asset($value->image_path) }}" alt="First slide">
                        </div> --}}
                    @endforeach
                @else
                    <div class="carousel-item active"
                        style="background-image: url({{ asset('img/home-title.png') }});width:100%; height:673px;">
                        <div class="carousel-caption d-none d-md-block">
                        </div>
                    </div>
                @endif
                {{-- if is null mock 1 image !! --}}

            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </header>
    <div class="container" style="margin-top: 80px">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row product-block">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h4 style="text-transform: uppercase;margin-bottom: 3.5rem;">New Arrivals Are Here</h4>
                            </div>
                        </div>
                        @foreach ($products as $key => $pro)
                            @if ($key === 0)
                                <div class="card custom-card-home mt-3" style="height: auto;">
                                    @php
                                        $collection = App\Models\Collections::where('category_id', $pro->category_id)->first();
                                    @endphp
                                    <a
                                        href="/shop/{{ $pro->cate_slug }}/{{ $collection->name ?? 'collection' }}/{{ $pro->slug }}">
                                        <img src="/img/cards/{{ $pro->image_path }}" width="530px" height="530px"
                                            class="card-img-top mx-auto" style="" alt="{{ $pro->image_path }}">
                                    </a>
                                    <div class="card-body custom-card-home text-center mt-3">
                                        <h6 class="card-title fw-bold">{{ $pro->name }}</h6>
                                        <p style="font-weight: bold;color: black;"> {{ $pro->price }} ฿</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            {{-- {{ $products }} --}}
                            @foreach ($products as $key => $pro)
                                @if ($key > 0)
                                    <div class="col-6 col-sm-3">
                                        <div class="card custom-card-home" style="margin-bottom: 20px;">
                                            <a
                                                href="/shop/{{ $pro->cate_slug }}/{{ $pro->collect_slug ?? 'collection' }}/{{ $pro->slug }}"><img
                                                    src="/img/cards/{{ $pro->image_path }}" class="card-img-top mx-auto"
                                                    style="height: 250px; width: 250px;display: block;"
                                                    alt="{{ $pro->image_path }}"></a>
                                            <div class="card-body custom-card-home mt-3">
                                                <h6 class="card-title fw-bold">{{ $pro->name }}</h6>
                                                <p style="font-weight: bold;color: black;"> {{ $pro->price }} ฿ </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="image-home-banner-1 p-5">
        <div class="container h-100">
            <div class="align-middle">
                <div class="row">
                    {{-- ck content --}}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div style="width: 100%;">
                            @if (isset($more_about))
                                {!! $more_about->content !!}
                            @endif
                        </div>
                        <br>
                        <a href="{{ route('more-about') }}" class="readmore-text"> Read more <img class="ml-2" src="{{ asset('img/svg-icons/__.svg') }}"
                                alt="__.svg"> </a>
                        {{-- ck content --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 40px">
        <div class="col-12">
            <div class="row text-left text-xs-left text-sm-left text-md-left">
                @php
                    $banners = App\Models\Banner::get();
                @endphp
                {{-- {{ $banners }} --}}
                @if (isset($banners))
                    @foreach ($banners as $key => $banner)
                        <div class="col-xs-12 col-sm-6 col-md-6 mb-3 {{ $key == 0 ? 'pl-0' : 'pr-0' }}">
                            <a href="{{ $banner->link }}">
                                <img src="{{ asset($banner->path_img) }}" alt="{{ $banner->path_img }}"
                                    style="width: 100%">
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-xs-12 col-sm-6 col-md-6 mb-3">
                        <img src="{{ asset('img/banners/Banner 4.png') }}" alt="Banner 4" style="width: 100%">
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <img src="{{ asset('img/banners/Banner2 2.png') }}" alt="Banner2 2" style="width: 100%">
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 80px">
        <h4 class="text-center"> News & Event </h4>
        {{-- carousel news --}}
        <div class="row img-news text-left text-xs-left text-sm-left text-md-left">
            @foreach ($news as $new)
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <img src="/img/cards/{{ $new->path_img }}" alt="traditional-gold-earrings-set 1">
                    <h5 class="mt-3">{{ $new->company_name }}</h5>
                    <p>
                        {{ $new->news_content }}
                    </p>
                    <div class="row">
                        <div class="col-6"><a href="{{ route('news.more', ['id' => $new->id]) }}" class="readmore-text"> Read more <img class="ml-2" src="{{ asset('img/svg-icons/__.svg') }}"
                            alt="__.svg">  </a>
                        </div>
                        <div class="col-6 text-right">{{ $new->created_at }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        a.readmore-text{
            color: #000000;
            text-decoration: none;
            text-transform: uppercase;
            font-weight: bold;
            background-color: transparent;
        }
        .readmore-text img{
            width: 17px;
            height: 17px;
        }
    </style>
@endsection
