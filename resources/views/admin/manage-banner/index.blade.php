@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>เพิ่มรูป แบนเนอร์</h1>
        <div class="separator mb-5"></div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label text-right">picture 1</label>
                        <div class="col-sm-10 text-center">
                            <input type="file" class="form-control" name="image1" id="image1"
                                value="{{ isset($product) && $product->image_path ? null : 'required' }}">
                            <img class="img-thumbnail"
                                src="{{ isset($product) && $product->image_path ? asset('img/cards/' . $product->image_path) : asset('img/dist/default-thumbnail.jpg') }}"
                                width="300" height="200" id="preview-image1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label text-right">picture 2</label>
                        <div class="col-sm-10 text-center">
                            <input type="file" class="form-control" name="image2" id="image2"
                                value="{{ isset($product) && $product->image_path ? null : 'required' }}">
                            <img class="img-thumbnail"
                                src="{{ isset($product) && $product->image_path ? asset('img/cards/' . $product->image_path) : asset('img/dist/default-thumbnail.jpg') }}"
                                width="300" height="200" id="preview-image2">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div style="text-align: center;">
                            <button type="button" class="btn btn-info" id="submit-all">Upload</button>
                        </div>
                    </div>



                </div>
            </div>

            {{-- <textarea name="editor1" id="editor1" rows="10" cols="80">
                This is my textarea to be replaced with CKEditor 4.
            </textarea> --}}
            {{-- <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Uploaded Image</h3>
                </div>
                <div class="panel-body" id="uploaded_image">
                </div>
            </div> --}}
            {{-- <textarea id="editor1" name="editor1"></textarea> --}}
        </div>
    </div>
  
   
@endsection
