@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1> Manage About Us</h1>
        <div class="separator mb-5"></div>
    </div>

    <form action="{{ route('admin.more-about.update') }}" method="post">
        @csrf
        <div>
            {{-- <div class="form-group mb-2">
                <h1>
                    <span id="topic">About Us
                    </span>
                </h1>
            </div> --}}


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
                <label for="meta_keyword" class="col-sm-2 col-form-label text-right">Sub detail</label>
                <div class="col-sm-10">
                    <textarea name="editor1" id="editor1" rows="10" cols="80">
                                {{ !is_null($more_about) ? $more_about->content : '' }}
                        </textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="meta_keyword" class="col-sm-2 col-form-label text-right">Detail</label>
                <div class="col-sm-10">
                    <textarea name="editor2" id="editor2" rows="10" cols="80">
                            {{ !is_null($more_about) ? $more_about->detail : '' }}
                        </textarea>
                </div>
            </div>
        </div>
        <div class="col-12 w-100 text-center">
            <div class="separator mt-2 mb-2 "></div>
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
