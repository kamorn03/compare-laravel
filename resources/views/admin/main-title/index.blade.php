@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>เพิ่มรูป บนสไลด์</h1>
        <div class="separator mb-5"></div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Select Image</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group row">
                        <form id="dropzoneForm" class="dropzone" id="dropzone" action="{{ route('main-title.upload') }}">
                            @csrf
                        </form>
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
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Uploaded Image</h3>
                </div>
                <div class="panel-body" id="uploaded_image">

                </div>
            </div>
            {{-- <textarea id="editor1" name="editor1"></textarea> --}}
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script> --}}
    <script type="text/javascript">
        // setTimeout(function() {
        //     var text = {!! json_encode($maintext->toArray()) !!};
        //     for (var i = 0; i < text.length; i++) {
        //         CKEDITOR.replace('title-ck-' + text[i].id);

        //     }
        // }, 500)
        // CKEDITOR.replace('editor1');
        Dropzone.options.dropzoneForm = {
            autoProcessQueue: false,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",

            init: function() {
                var submitButton = document.querySelector("#submit-all");
                myDropzone = this;

                submitButton.addEventListener('click', function() {
                    myDropzone.processQueue();
                });

                this.on("complete", function() {
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                        var _this = this;
                        _this.removeAllFiles();
                    }
                    load_images();
                });

            }

        };

        load_images();

        function load_images() {
            $.ajax({
                url: "{{ route('main-title.fetch') }}",
                success: function(data) {
                    $('#uploaded_image').html(data);
                    // setTimeout(function() {
                    //     var text = {!! json_encode($maintext->toArray()) !!};
                    //     for (var i = 0; i < text.length; i++) {
                    //         CKEDITOR.replace('title-ck-' + text[i].id);
                    //     }
                    // }, 500)
                }
            })
        }

        $(document).on('click', '.save_title', function() {
            var id = $(this).attr('id');
            id = id.split('-');
            $.ajax({
                url: "{{ route('main-title.update') }}",
                // headers: {
                //     'CSRFToken': '{{ csrf_token() }}'
                // },
                method: 'post',
                data: {
                    "_token": '{{ csrf_token() }}',
                    'id': id[2],
                    'title': $('#title-line-1-' + id[2]).val(),
                    'description': CKEDITOR.instances['title-ck-' + id[2]].getData(),
                },
                success: function(data) {
                    load_images();
                }
            })
        });

        $(document).on('click', '.remove_image', function() {
            var id = $(this).attr('id');
            console.log(name)
            $.ajax({
                url: "{{ route('main-title.delete') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    load_images();
                }
            })
        });

    </script>
@endsection
