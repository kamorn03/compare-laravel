@extends('layouts.main')

@section('content')
    <div class="header-green text-center align-middle">
        <div class="row align-items-center h-100">
            <div class="mx-auto">
                <div class="h-100 justify-content-center">
                    <div>
                        <label> Home > Cart > Checkout > Shipping > Order Complete </label>
                        <h1>finished payment</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 50px">
        {{-- 1090 --}}
        <div>

        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="">
                    <h1 class="text-header">Thank you. Your order has been received.</h1>
                </div>
                <div class="row">
                    <table class="table w-100">
                        <th>

                        <td>ORDER NUMBER :</td>
                        <td>DATE :</td>
                        <td>TOTAL :</td>
                        <td>PAYMENT METHOD : </td>

                        </th>
                     
                    </table>
                </div>
                <div class="row">
                    <h1 class="text-header">Address </h1>

                </div>
                <div class="row mt-5">
                    <div class="col-lg-12 text-center">
                        <img src="{{ asset('img/dist/ISO673AP.jpg') }}" alt="ISO673AP.jpg" width="250" height="250">
                        <h1 class="text-header mt-5">ชำระเงินสำเร็จ</h1>
                    </div>
                </div>
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

        @media (min-width: 1200px) {

            .container-xl,
            .container-lg,
            .container-md,
            .container-sm,
            .container {
                max-width: 1090px;
            }
        }

    </style>
@endsection
