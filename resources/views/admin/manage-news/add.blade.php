@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>Add News</h1>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('admin.news') }}"> Back</a>
        </div>
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
            action="{{ isset($news) && $news->id ? route('admin.news.update', ['shop' => $news->id]) : route('admin.news.store') }}"
            method="POST" name="add_post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{-- @if (isset($news) && $news->id)
                <input name="_method" type="hidden" value="PUT">
            @endif --}}


            <input name="id" type="hidden" value="{{ isset($news) ? $news->id : null }}">
            <div class="form-group row">
                <label for="meta_title" class="col-sm-2 col-form-label text-right">meta title</label>
                <div class="col-sm-10">
                    <input type="text" name="meta_title" id="meta_title" class="form-control" required placeholder="title"
                        value="{{ $news->meta_title ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="meta_description" class="col-sm-2 col-form-label text-right">meta description</label>
                <div class="col-sm-10">
                    <input type="text" name="meta_description" id="meta_description" class="form-control"
                        placeholder="description" value="{{ $news->meta_description ?? '' }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="meta_keyword" class="col-sm-2 col-form-label text-right">meta keyword</label>
                <div class="col-sm-10">
                    <input type="text" name="meta_keyword" id="meta_keyword" class="form-control" placeholder="keyword"
                        value="{{ $news->meta_keyword ?? '' }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label text-right">topic</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control" placeholder="name"
                        value="{{ $news->company_name ?? '' }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label text-right">sub detail</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ $news->news_content ?? '' }}" required>
                </div>
            </div>
           
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label text-right">รูป หน้าแรก</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="image" id="image">
                    <img class="img-thumbnail"
                        src="{{ isset($news) && $news->path_img ? asset('img/cards/' . $news->path_img) : asset('img/dist/default-thumbnail.jpg') }}"
                        width="300" height="200" id="preview-image">
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label text-right">รูป รายละเอียด</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="image1" id="image1"
                        value="{{ isset($news) && $news->path_img_detail ? null : 'required' }}">
                    <img class="img-thumbnail"
                        src="{{ isset($news) && $news->path_img_detail ? asset('img/cards/' . $news->path_img_detail) : asset('img/dist/default-thumbnail.jpg') }}"
                        width="300" height="200" id="preview-image1">
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label text-right">description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description"
                        required>{{ $news->news_detail ?? '' }}</textarea>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" id="submit-all">save</button>
            </div>
        </form>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
        <script type="text/javascript">
            CKEDITOR.replace('description');

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#preview-image').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            function readURL2(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#preview-image1').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }


            $("#image").change(function() {
                readURL(this);
            });

            $("#image1").change(function() {
                readURL2(this);
            });



            function load_images() {
                $.ajax({
                    url: "{{ route('main-title.fetch') }}",
                    success: function(data) {
                        $('#uploaded_image').html(data);
                    }
                })
            }

            $(document).on('click', '.remove_image', function() {
                var name = $(this).attr('id');
                $.ajax({
                    url: "{{ route('main-title.delete') }}",
                    data: {
                        name: name
                    },
                    success: function(data) {
                        load_images();
                    }
                })
            });

        </script>

    @endsection
