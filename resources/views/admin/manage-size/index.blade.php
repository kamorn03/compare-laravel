@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>ขนาดสินค้า</h1>
        <span class="float-right">
            <a href="{{ route('admin.product.size.add', ['id' => $product->id]) }}"><i class="fa fa-plus"></i>
                เพิ่มขนาดสินค้า </a>
        </span>
        <div class="separator mb-5"></div>
    </div>

    <div class="container" style="margin-top: 80px">
        @if (session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if (session()->has('alert_msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif

        <div class="col-12">
            {{-- {{$product}} --}}
            <table class="table table-bordered text-center" id="collection-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>ขนาดสินค้า</th>
                        <th>edit</th>
                        <th>remove</th>
                    </tr>
                </thead>
            </table>
        </div>

    @endsection

    @push('scripts')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
        <script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
        <script>
            $(function() {
                // Edit record
                $('#collection-table').on('click', 'td.editor-edit', function(e) {
                    console.log('edit', $(this).children().data('id'));
                });

                // Delete a record
                $('#collection-table').on('click', 'td.editor-delete', function(e) {
                    console.log('remove', $(this).children().data('id'));
                });

                $('#collection-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.product.size.list', ['id' => $product->id]) !!}',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'size',
                            name: 'size'
                        },
                        {
                            data: null,
                            className: "dt-center editor-edit",
                            render: function(data, type, row) {
                                var product = '{!! $product->id !!}';
                                return '<a href="/digiso-admin/product/' + product + '/size/' +
                                    row.id +
                                    '/edit"><i class="fa fa-pencil" data-id="' + row.id +
                                    '"></i></a>'
                            }
                        },
                        {
                            data: null,
                            className: "dt-center editor-delete",
                            render: function(data, type, row) {
                                var product = '{!! $product->id !!}';
                                return '<a href="/digiso-admin/product/' + product + '/size/' +
                                    row.id + '/delete"><i class="fa fa-trash" data-id="' + row.id +
                                    '"></i></a>'
                            }
                        }
                    ]
                });
            });

        </script>
