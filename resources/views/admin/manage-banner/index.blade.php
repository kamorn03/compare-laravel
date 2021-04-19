@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>เพิ่มรูป แบนเนอร์</h1>
        <div class="separator mb-5"></div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <div class="panel panel-default">
                {{-- {{$banner}} --}}
                <form action="{{ route('admin.banner.update') }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="panel-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label text-right">picture 1</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image1" id="image1"
                                    value="{{ isset($banner) ? null : 'required' }}">
                                <img class="img-thumbnail"
                                    src="{{ isset($banner) && $banner[0]->path_img ? asset($banner[0]->path_img) : asset('img/dist/default-thumbnail.jpg') }}"
                                    width="300" height="200" id="preview-image1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label text-right">link 1</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="link1" id="link1" value="{{ isset($banner) ? $banner[0]->link : null }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label text-right">picture 2</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image2" id="image2"
                                    value="{{ isset($banner) ? null : 'required' }}">
                                <img class="img-thumbnail"
                                    src="{{ isset($banner) && $banner[1]->path_img ? asset($banner[1]->path_img) : asset('img/dist/default-thumbnail.jpg') }}"
                                    width="300" height="200" id="preview-image2">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label text-right">link 2</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="link2" id="link2"  value="{{ isset($banner) ? $banner[1]->link : null }}">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-info" id="submit-all">Upload</button>
                            </div>
                        </div>
                    </div>
                </form>
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

@endsection
