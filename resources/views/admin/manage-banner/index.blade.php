@extends('admin-layouts.main-ui')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-tasks">
                <div class="card-body">

                    <div class="col-12">
                        <h2>Banners</h2>
                        <div class="separator mb-5"></div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="panel panel-default">
                                {{-- {{$banner}} --}}
                                <form action="{{ route('admin.banner.update') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="panel-body">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label text-right">image 1</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="image1" id="image1"
                                                    value="{{ isset($banner) ? null : 'required' }}">
                                                <img class="img-thumbnail"
                                                    src="{{ Illuminate\Support\Arr::get($banner, 0) ? asset($banner[0]->path_img) : asset('img/dist/default-thumbnail.jpg') }}"
                                                    width="300" height="200" id="preview-image1">
                                                <span style="color:red">( Recommended upload size of image 808 x 376 pixels )</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label text-right">link 1</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="link1" id="link1"
                                                    value="{{ Illuminate\Support\Arr::get($banner, 0) ? $banner[0]->link : null }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label text-right">image 2</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="image2" id="image2"
                                                    value="{{ isset($banner) ? null : 'required' }}">
                                                <img class="img-thumbnail"
                                                    src="{{ Illuminate\Support\Arr::get($banner, 1) ? asset($banner[1]->path_img) : asset('img/dist/default-thumbnail.jpg') }}"
                                                    width="300" height="200" id="preview-image2">
                                                <span style="color:red">( Recommended upload size of image 808 x 376 pixels )</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label text-right">link 2</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="link2" id="link2"
                                                    value="{{ Illuminate\Support\Arr::get($banner, 1) ? $banner[1]->link : null }}">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview-image1').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview-image2').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }


        $("#image1").change(function() {
            readURL(this);
        });

        $("#image2").change(function() {
            readURL2(this);
        });

    </script>
    <style>
        .card-tasks {
            height: 100%;
        }

    </style>
@endsection
