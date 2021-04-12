@extends('layouts.app')

@section('content')
    <header>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <!-- Slide One - Set the background image for this slide in the line below -->
                @if (isset($main_title))
                    @foreach ($main_title as $key => $value)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}"
                            style="background-image: url({{ asset($value->image_path) }})">
                            <div class="carousel-caption d-none d-md-block">
                                {{-- {!! $value->description !!} --}}
                            </div>
                        </div>
                    @endforeach
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
                                <h4 style="text-transform: uppercase;">New Arrivals Are Here</h4>
                            </div>
                        </div>
                        @foreach ($products as $key => $pro)
                            @if ($key === 0)
                                <div class="card custom-card-home mt-3" style="height: auto;">
                                    @php
                                        $collection = App\Models\Collections::where('category_id', $pro->category_id)->first();
                                        // dd($collection);
                                    @endphp
                                    <a
                                        href="/shop/{{ $pro->cate_slug }}/{{ $collection->name ?? 'collection' }}/{{ $pro->slug }}">
                                        <img src="/img/cards/{{ $pro->image_path }}" height="400"
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
                                        <div class="card custom-card-home" style="margin-bottom: 20px; height: auto;">
                                            <a
                                                href="/shop/{{ $pro->cate_slug }}/{{ $pro->collect_slug ?? 'collection' }}/{{ $pro->slug }}"><img
                                                    src="/img/cards/{{ $pro->image_path }}" class="card-img-top mx-auto"
                                                    style="height: 150px; width: 150px;display: block;"
                                                    alt="{{ $pro->image_path }}"></a>
                                            <div class="card-body custom-card-home mt-3">
                                                <h6 class="card-title fw-bold">{{ $pro->name }}</h6>
                                                <p style="font-weight: bold;color: black;">  {{ $pro->price }} ฿ </p>
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
                    <div style="width: 100%">
                        @if (isset($more_about))
                            {!! $more_about->content !!}
                        @endif
                    </div>
                    <br>
                    <a href="{{ route('more-about') }}"> Read more <img src="{{ asset('img/svg-icons/__.svg') }}"
                            alt="__.svg"> </a>
                    {{-- ck content --}}
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 40px">
        <div class="col-12">
            <div class="row text-left text-xs-left text-sm-left text-md-left">
                <div class="col-xs-12 col-sm-6 col-md-6 mb-3">
                    <img src="{{ asset('img/banners/Banner 4.png') }}" alt="Banner 4" style="width: 100%">
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <img src="{{ asset('img/banners/Banner2 2.png') }}" alt="Banner2 2" style="width: 100%">
                </div>
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
                        <div class="col-6"><a href="{{ route('news.more', ['id' => $new->id]) }}"> Read more >> </a>
                        </div>
                        <div class="col-6 text-right">{{ $new->created_at }}</div>
                    </div>
                </div>
            @endforeach
            {{-- <div class="col-xs-12 col-sm-4 col-md-4">
                <img src="{{ asset('img/dist/traditional-gold-earrings-set 1.png') }}"
                    alt="traditional-gold-earrings-set 1">
                <h5 class="mt-3">Holiday Inspiration : The Night Sky</h5>
                <p>
                    The journey to creative inspiration can be an infinitely fulfilling one. When we are in alignment and
                    our creativity is flowing, it seems as if…...
                </p>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <img src="{{ asset('img/dist/traditional-gold-earrings-set 1.png') }}"
                    alt="traditional-gold-earrings-set 1">
                <h5 class="mt-3">Holiday Inspiration : The Night Sky</h5>
                <p>
                    The journey to creative inspiration can be an infinitely fulfilling one. When we are in alignment and
                    our creativity is flowing, it seems as if…...
                </p>
            </div> --}}
        </div>
    </div>
@endsection
