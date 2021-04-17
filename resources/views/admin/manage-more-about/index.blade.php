@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1> แก้ไข CMS </h1>
        <div class="separator mb-5"></div>
    </div>

    <form action="{{ route('admin.more-about.update') }}" method="post">
        @csrf
        <div>
            <div class="form-group mb-2">
                <h1><label for="topic">หน้า</label>
                    <span id="topic">เกี่ยวกับเรา
                    </span>
                </h1>
            </div>

            {{-- <div class="form-group row">
                <label for="" class="col-sm-1 col-form-label">
                    <h3>รูปที่ 1</h3>
                </label>
                <div class="col-sm-11 text-center">
                    <input type="file" class="form-control" name="image1" id="image1">
                    <div class="float-left">
                        <img class="img-thumbnail" src="{{ asset('img/dist/default-thumbnail.jpg') }}" width="300"
                            height="200" id="preview-image-1">
                    </div>
                </div>
            </div> --}}

            <div class="form-group">
                <h3 for="editor1">รายละเอียดแบบย่อ</h3>
                <textarea name="editor1" id="editor1" rows="10" cols="80">
                                                {{ !is_null($more_about) ? $more_about->content : '' }}
                                        </textarea>
            </div>

            {{-- <div class="form-group row">
                <label for="" class="col-sm-1 col-form-label">
                    <h3>รูปที่ 2</h3>
                </label>
                <div class="col-sm-11 text-center">
                    <input type="file" class="form-control" name="image2" id="image2">
                    <div class="float-left">
                        <img class="img-thumbnail" src="{{ asset('img/dist/default-thumbnail.jpg') }}" width="300"
                            height="200" id="preview-image-2">
                    </div>
                </div>
            </div> --}}
            <div class="form-group">
                <h3 for="editor1">รายละเอียดทั้งหมด</h3>
                <textarea name="editor2" id="editor2" rows="10" cols="80">
                                            {{ !is_null($more_about) ? $more_about->detail : '' }}
                                        </textarea>
            </div>
        </div>

        <div class="col-12">
            <div class="separator mt-2 mb-2"></div>
            <button type="submit" class="btn btn-primary">ตกลง</button>
        </div>
    </form>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');

    </script>
@endsection
