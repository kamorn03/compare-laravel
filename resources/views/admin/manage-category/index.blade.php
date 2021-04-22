@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>Category</h1>
        <span class="float-right">
            <a href="{{ route('admin.category.add') }}"><i class="fa fa-plus"></i> Add Category </a>
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
            <table class="table table-bordered text-center" id="category-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sub Category</th>
                        <th>edit</th>
                        <th>remove</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endsection

    @push('scripts')
        <script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
        <script>
            $(function() {
                // Edit record
                $('#category-table').on('click', 'td.editor-edit', function(e) {
                    console.log('edit', $(this).children().data('id'));
                });

                // Delete a record
                $('#category-table').on('click', 'td.editor-delete', function(e) {
                    console.log('remove', $(this).children().data('id'));
                });

                $('#category-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.category.list') !!}',
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
                            data: null,
                            className: "dt-center editor-edit",
                            render: function(data, type, row) {
                                return '<a href="/digiso-admin/category/' + row.id +
                                    '/edit"><i class="fa fa-pencil" data-id="' + row.id +
                                    '"></i></a>'
                            }
                        },
                        {
                            data: null,
                            className: "dt-center editor-delete",
                            render: function(data, type, row) {
                                return '<a href="/digiso-admin/category/' + row.id +
                                    '/delete"><i class="fa fa-trash" data-id="' + row.id +
                                    '"></i></a>'
                            }
                        }
                    ]
                });
            });

        </script>
