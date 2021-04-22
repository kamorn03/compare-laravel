@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>Manage News</h1>
        <div class="separator mb-5"></div>
    </div>

    <form action="">
        <div>
            <textarea name="editor1" id="editor1" rows="10" cols="80">
                                        This is my textarea to be replaced with CKEditor 4.
                                </textarea>
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

    </script>


@endsection
