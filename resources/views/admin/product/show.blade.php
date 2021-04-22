@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>Products</h1>

        <span class="float-right">
            <a href="{{ route('admin.product.add') }}"><i class="fa fa-plus"></i> add product </a>
        </span>
        <div class="separator mb-5"></div>
    </div>

    {{-- datatable --}}


    <table class="table table-bordered" id="product-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>รูป</th>
                <th>วันที่แก้ไข</th>
                <th>add size</th>
                <th>เพิ่มรูปภาพ</th>
                <th>edit</th>
                <th>remove</th>
            </tr>
        </thead>
    </table>

@endsection

@push('scripts')
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
                        name: 'id'
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
                                '/size"><i class="iconsminds-maximize"></i> เพิ่มขนาดสินค้า</a>'
                        }
                    },
                    {
                        data: null,
                        className: "dt-center editor-edit",
                        render: function(data, type, row) {
                            return '<a href="/digiso-admin/product/' + row.id +
                                '/add_image">เพิ่มรูปภาพ</a>'
                        }
                    },
                    {
                        data: null,
                        className: "dt-center editor-edit",
                        render: function(data, type, row) {
                            return '<a href="/digiso-admin/product/' + row.id +
                                '/edit"><i class="fa fa-pencil" data-id="' + row.id + '"></i></a>'
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
