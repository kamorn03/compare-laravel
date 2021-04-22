@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>{{ isset($collections) ? 'แก้ไข' : 'เพิ่ม' }} Sub Category</h1>
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
            action="{{ isset($collections) && $collections->id ? route('collection.update', ['shop' => $collections->id]) : route('collection.store') }}"
            method="POST" name="add_post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="id" type="hidden" value="{{ isset($collections) ? $collections->id : null }}">
            {{-- using category --}}

            <div class="form-group row">
                <label for="meta_title" class="col-sm-2 col-form-label text-right">meta title</label>
                <div class="col-sm-10">
                    <input type="text" name="meta_title" id="meta_title" class="form-control" required placeholder="title"
                        value="{{ $more_about->meta_title ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="meta_description" class="col-sm-2 col-form-label text-right">meta description</label>
                <div class="col-sm-10">
                    <input type="text" name="meta_description" id="meta_description" class="form-control"
                        placeholder="description" value="{{ $more_about->meta_description ?? '' }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="meta_keyword" class="col-sm-2 col-form-label text-right">meta keyword</label>
                <div class="col-sm-10">
                    <input type="text" name="meta_keyword" id="meta_keyword" class="form-control" placeholder="keyword"
                        value="{{ $more_about->meta_keyword ?? '' }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label text-right">select category</label>
                <div class="col-sm-10">
                    {{-- {{ $collections->category_id}} --}}
                    <select name="category_id" id="category_id" class="form-control">
                        @if (isset($categories))
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ isset($collections) && $category->id == $collections->category_id ? 'selected' : null }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            {{-- using name --}}
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label text-right">name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" placeholder="name"
                        value="{{ $collections->name ?? '' }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label text-right">slug</label>
                <div class="col-sm-10">
                    <input type="text" name="slug" class="form-control" placeholder="slug"
                        value="{{ $collections->slug ?? '' }}">
                </div>
            </div>

            <div style="text-align: right;">
                <button type="submit" class="btn btn-primary">ตกลง</button>
            </div>
        </form>
    @endsection
