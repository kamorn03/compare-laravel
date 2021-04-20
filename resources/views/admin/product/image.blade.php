@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>เพิ่มรูป สินค้า</h1>
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
                        <form id="dropzoneForm" class="dropzone" id="dropzone"
                            action="{{ route('product.upload.image', ['id' => $product->id]) }}">
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
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Uploaded Image</h3>
                </div>
                <div class="panel-body" id="uploaded_image">
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('editor1');
        Dropzone.options.dropzoneForm = {
            autoProcessQueue: false,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            init: function() {
                var submitButton = document.querySelector("#submit-all");
                myDropzone = this;

                submitButton.addEventListener('click', function() {
                    myDropzone.processQueue();
                });

                // this.on("sendingmultiple", function(data, xhr, formData) {
                //     // formData.append("firstname", jQuery("#firstname").val());
                //     // formData.append("lastname", jQuery("#lastname").val());

                //     formData.append("title", $("#title").val());
                //     console.log(formData)
                //     formData.append("name", $("#name").val());
                //     formData.append("price", $("#price").val());
                // });
                this.on("complete", function() {
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                        var _this = this;
                        _this.removeAllFiles();
                    }
                    console.log('complete');
                    // load_images();
                });
            },
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 500000,
            removedfile: function(file) {
                var name = file.upload.filename;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ url('delete') }}',
                    data: {
                        filename: name
                    },
                    success: function(data) {
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
        };

        load_images();

        function load_images() {
            $.ajax({
                url: "{{ route('product.image.fetch', ['id' => $product->id ]) }}",
                success: function(data) {
                    $('#uploaded_image').html(data);
                }
            })
        }

        $(document).on('click', '.remove_image', function() {
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ route('product.image.delete') }}",
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
