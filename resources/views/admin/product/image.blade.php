@extends('admin-layouts.main-ui')

@section('content')
    <div class="form-group row">
        <div class="col-12">
            <h1 class="pull-left">Add Product Images ({{ $product->name }})</h1>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.product') }}"> Back</a>
            </div>
            <div class="separator mb-5"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-tasks">
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Select Image</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12">
                                            <form id="dropzoneForm" class="dropzone" id="dropzone"
                                                action="{{ route('product.upload.image', ['id' => $product->id]) }}">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Uploaded Image</h3>
                                </div>
                                <div class="panel-body mt-5" id="uploaded_image">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    <script type="text/javascript">
        Dropzone.options.dropzoneForm = {
            // maxFiles: 30,
            parallelUploads: 30,
            paramName: "product",
            autoProcessQueue: true,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            init: function() {
                var submitButton = document.querySelector("#submit-all");
                myDropzone = this;

                // submitButton.addEventListener('click', function() {
                //     myDropzone.processQueue();
                // });

                // this.on("sendingmultiple", function(data, xhr, formData) {
                //     // formData.append("firstname", jQuery("#firstname").val());
                //     // formData.append("lastname", jQuery("#lastname").val());

                //     formData.append("title", $("#title").val());
                //     console.log(formData)
                //     formData.append("name", $("#name").val());
                //     formData.append("price", $("#price").val());
                // });
                this.on("complete", function() {
                    // if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    //     var _this = this;
                    //     _this.removeAllFiles();
                    // }
                    console.log('complete');
                    load_images();
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
                console.log(name);
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
        };

        load_images();

        function load_images() {
            $.ajax({
                url: "{{ route('product.image.fetch', ['id' => $product->id]) }}",
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
    <style>
        .dropzone .dz-preview.dz-image-preview {
            background: white;
            z-index: 0;
        }

        .card-tasks {
            height: 100%;
        }

    </style>
@endsection
