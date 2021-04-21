@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>{{ isset($size) ? 'แก้ไข' : 'เพิ่ม' }} ขนาดสินค้า</h1>
        <div class="separator mb-5"></div>
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
            @foreach ($errors->all() as $error)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif

        <form class="form form-horizontal"
            action="{{ isset($size) && $size->id ? route('admin.size.update', ['id' => $size->id]) : route('admin.size.store') }}"
            method="POST" name="add_post">
            {{ csrf_field() }}
            <input name="id" type="hidden" value="{{ isset($size) ? $size->id : null }}">
            {{-- using category --}}
           
            {{-- using name --}}
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label text-right">size</label>
                <div class="col-sm-10">
                    <input type="text" name="size" class="form-control" placeholder="size"
                        value="{{ $size->size ?? '' }}">
                    <input type="hidden" name="product_id" id="product_id" class="form-control"
                        value="{{ $product->id ?? '' }}">    
                </div>
            </div>
            <div style="text-align: right;">
                <button type="submit" class="btn btn-primary">ตกลง</button>
            </div>
        </form>
    @endsection
