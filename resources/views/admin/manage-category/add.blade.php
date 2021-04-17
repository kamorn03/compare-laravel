@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>{{ isset($categories) ? 'แก้ไข' : 'เพิ่ม' }} ประเภทสินค้า</h1>

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
            action="{{ isset($categories) && $categories->id ? route('category.update', ['shop' => $categories->id]) : route('category.store') }}"
            method="POST" name="add_post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input name="id" type="hidden" value="{{ isset($categories) ? $categories->id : null }}">
            {{-- using name --}}
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label text-right">name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" placeholder="name"
                        value="{{ $categories->name ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label text-right">slug</label>
                <div class="col-sm-10">
                    <input type="text" name="slug" class="form-control" placeholder="slug"
                        value="{{ $categories->slug ?? '' }}">
                </div>
            </div>

            <div style="text-align: right;">
                <button type="submit" class="btn btn-primary">ตกลง</button>
            </div>

        </form>
    @endsection
