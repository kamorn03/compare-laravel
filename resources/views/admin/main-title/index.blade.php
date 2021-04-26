@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>Add Slide image</h1>
        <div class="separator mb-5"></div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"> Drag and Drop Image</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group row">
                        <form id="dropzoneForm" class="dropzone" id="dropzone" action="{{ route('main-title.upload') }}">
                            @csrf
                        </form>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script> --}}
    <script type="text/javascript">
        Dropzone.options.dropzoneForm = {
            autoProcessQueue: true,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",

            init: function() {
                var submitButton = document.querySelector("#submit-all");
                myDropzone = this;

                // submitButton.addEventListener('click', function() {
                //     myDropzone.processQueue();
                // });

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
                }
            })
        }

        $(document).on('click', '.save_link', function() {
            var id = $(this).attr('link-id');
            // id = id.split('-');
            $.ajax({
                url: "{{ route('main-title.update') }}",
                // headers: {
                //     'CSRFToken': '{{ csrf_token() }}'
                // },
                method: 'post',
                data: {
                    "_token": '{{ csrf_token() }}',
                    'id': id,
                    'link': $('#link-' + id).val(),
                },
                success: function(data) {
                    Swal.fire(
                        'success!',
                        'Data has been saved!',
                        'success'
                    )
                    load_images();
                }
            })
        });

        $(document).on('click', '.remove_image', function() {
            var id = $(this).attr('id');
            console.log(name)

            Swal.fire({
                title: 'Do you want to remove?',
                showCancelButton: true,
                confirmButtonText: `remove`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('main-title.delete') }}",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            Swal.fire('removed!', '', 'success')
                            load_images();
                        }
                    })

                }
            })

        });

    </script>
@endsection
