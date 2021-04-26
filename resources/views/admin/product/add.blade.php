@extends('admin-layouts.main-ui')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-tasks">
                <div class="card-body">

                    <div class="col-12">
                        <h1>{{ isset($product) ? 'Edit' : 'Add' }} Product</h1>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('admin.product') }}"> Back</a>
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
                            action="{{ isset($product) && $product->id ? route('product.update', ['id' => $product->id]) : route('product.store') }}"
                            method="POST" name="add_post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{-- @if (isset($product) && $product->id)
                <input name="_method" type="hidden" value="PUT">
            @endif --}}


                            <input name="id" type="hidden" value="{{ isset($product) ? $product->id : null }}">
                            <div class="form-group row">
                                <label for="meta_title" class="col-sm-2 col-form-label text-right">meta title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="meta_title" id="meta_title" class="form-control" required
                                        placeholder="title" value="{{ $product->meta_title ?? '' }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meta_description" class="col-sm-2 col-form-label text-right">meta
                                    description</label>
                                <div class="col-sm-10">
                                    <input type="text" name="meta_description" id="meta_description" class="form-control"
                                        placeholder="description" value="{{ $product->meta_description ?? '' }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meta_keyword" class="col-sm-2 col-form-label text-right">meta keyword</label>
                                <div class="col-sm-10">
                                    <input type="text" name="meta_keyword" id="meta_keyword" class="form-control"
                                        placeholder="keyword" value="{{ $product->meta_keyword ?? '' }}" required>
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label text-right">title</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="title" name="title"
                        required>{{ $product->name ?? '' }}</textarea>
                </div>
            </div> --}}
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label text-right">name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="name"
                                        value="{{ $product->name ?? '' }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label text-right">description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="description" name="description"
                                        required>{{ $product->description ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-2 col-form-label text-right">price</label>
                                <div class="col-sm-10">
                                    <input type="number" name="price" id="price" class="form-control" placeholder="ราคา"
                                        value="{{ $product->price ?? '' }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category" class="col-sm-2 col-form-label text-right">category</label>
                                <div class="col-sm-10">
                                    <select name="category" id="category" class="form-control" onchange="ChangeCategory();"
                                        required>
                                        <option value="0" disabled {{ !isset($category) ? 'selected' : '' }}>select
                                            category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ isset($product) && $category->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="collection" class="col-sm-2 col-form-label text-right">Sub Category</label>
                                <div class="col-sm-10">
                                    <select name="collection" id="collection" class="form-control">
                                        <option value="0" disabled>select sub category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label text-right">main cover picture</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="image" id="image"
                                        value="{{ isset($product) && $product->image_path ? null : 'required' }}">
                                    <img class="img-thumbnail"
                                        src="{{ isset($product) && $product->image_path ? asset('img/cards/' . $product->image_path) : asset('img/dist/default-thumbnail.jpg') }}"
                                        width="300" height="200" id="preview-image">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="submit-all">save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('description');
        ChangeCategory();

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview-image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#image").change(function() {
            readURL(this);
        });


        function ChangeCategory() {
            var category_id = $('#category').val();
            $.ajax({
                url: "{{ route('admin.collection.list', ['category_id' => '_id']) }}".replace('_id',
                    category_id),
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                method: "POST",
                success: function(data) {
                    // get collection
                    // console.log(data)
                    var select = document.getElementById('collection');
                    var length = select.options.length;
                    for (i = length - 1; i >= 0; i--) {
                        select.options[i] = null;
                    }
                    for (var i = 0; i < data.length; i++) {
                        // console.log(data[i])
                        select.options[select.options.length] = new Option(data[i].name, data[i].id);
                    }
                }
            })
        }

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
    <style>
        .card-tasks {
            height: 100%;
        }

    </style>
@endsection
