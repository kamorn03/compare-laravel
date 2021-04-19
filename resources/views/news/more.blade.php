@extends('layouts.main')

@section('content')
    <div class="header-green text-center align-middle">
        <div class="row align-items-center h-100">
            <div class="mx-auto">
                <div class="h-100 justify-content-center">
                    <div>
                        <label> Home > {{ $news->company_name }} </label>
                        <h1>{{ $news->company_name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- image --}}
    @if(isset($news->path_img_detail))
        <div style="margin-top: 50px">
            <img src="{{ asset('/img/cards/'.$news->path_img_detail)  }}" style="width:100%;height:600px;" alt="{{ $news->path_img_detail  }}">
        </div>
    @endif
 

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
        <div class="row text-center mt-5 mb-5">
            <div class="col-12">
                {{-- title --}}
            </div>
            <div class="col-12">
                {{-- all text --}}
                <p class="text-middle-sub-title">
                    @if (isset($news))
                        {!! $news->news_detail !!}
                    @endif
                </p>
            </div>
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
