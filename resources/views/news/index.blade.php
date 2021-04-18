@extends('layouts.main')

@section('content')
    <div class="header-green text-center align-middle">
        <div class="row align-items-center h-100">
            <div class="mx-auto">
                <div class="h-100 justify-content-center">
                    <div>
                        <label> Home > News </label>
                        <h1>News</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- container --}}
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

        {{-- text --}}
        <div class="container">
            {{-- <h4 class="text-center"> News & Event </h4> --}}
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
            </div>

        </div>
    </div>
    <style>
        .btn {
            /* padding: 0.375rem 2.75rem; */
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

        .text-middle-title {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: normal;
            font-size: 24px;
            line-height: 36px;
            /* or 100% */

            text-align: center;
            text-transform: uppercase;

            color: #797979;
        }

        .text-middle-sub-title {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: normal;
            font-size: 18px;
            line-height: 36px;
            /* or 100% */

            text-align: center;
            text-transform: uppercase;

            color: #797979;
        }

        .card {
            border: none;
        }

    </style>
@endsection
