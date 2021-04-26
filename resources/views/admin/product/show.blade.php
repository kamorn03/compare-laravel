@extends('admin-layouts.main-ui')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-tasks">
                <div class="card-body">
                    <div class="col-12">

                        <h1 class="float-left">Products</h1>

                        <span class="float-right">
                            <a href="{{ route('admin.product.add') }}"><i class="fa fa-plus"></i> add product </a>
                        </span>
                        <div class="separator mb-5"></div>
                    </div>

                    {{-- datatable --}}


                    <table class="table table-bordered" id="product-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Created at</th>
                                <th>Add size</th>
                                <th>Add image</th>
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script>
        $(function() {
            // Edit record
            $('#product-table').on('click', 'td.editor-edit', function(e) {
                console.log('edit', $(this).children().data('id'));
            });

            // Delete a record
            $('#product-table').on('click', 'td.editor-delete', function(e) {
                console.log('remove', $(this).children().data('id'));
            });

            $('#product-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.product.list') !!}',
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'image_path',
                        render: function(data, type, row) {
                            var img = window.location.protocol + "//" + window.location.hostname +
                                "/img/cards/" + row.image_path;
                            console.log(img);
                            return '<img src="' + img + '" alt=' + row.image_path +
                                ' width="160" height="160"\>'
                        }
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: null,
                        className: "dt-center editor-edit",
                        render: function(data, type, row) {
                            return '<a href="/digiso-admin/product/' + row.id +
                                '/size"><i class="iconsminds-maximize"></i> Add size</a>'
                        }
                    },
                    {
                        data: null,
                        className: "dt-center editor-edit",
                        render: function(data, type, row) {
                            return '<a href="/digiso-admin/product/' + row.id +
                                '/add_image">Add image</a>'
                        }
                    },
                    {
                        data: null,
                        className: "dt-center editor-edit",
                        render: function(data, type, row) {
                            return '<a href="/digiso-admin/product/' + row.id +
                                '/edit"><i class="tim-icons icon-pencil" data-id="' + row.id +
                                '"></i></a>'
                        }
                    },
                    {
                        data: null,
                        className: "dt-center editor-delete",
                        render: function(data, type, row) {
                            return '<a href="/digiso-admin/product/' + row.id +
                                '/remove"><i class="fa fa-trash" data-id="' + row.id + '"></i></a>'
                        }
                    }
                ]
            });
        });

    </script>
    <style>
        .card-tasks {
            height: 100%;
        }

    </style>
@endsection
