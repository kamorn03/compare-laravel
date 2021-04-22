@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>Manage News</h1>

        <span class="float-right">
            <a href="{{ route('admin.news.add') }}"><i class="fa fa-plus"></i> Add News </a>
        </span>
        <div class="separator mb-5"></div>
    </div>

    {{-- datatable --}}


    <table class="table table-bordered" id="news-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                {{-- <th>Email</th> --}}
                <th>Created At</th>
                <th>Updated At</th>
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
            $('#news-table').on('click', 'td.editor-edit', function(e) {
                console.log('edit', $(this).children().data('id'));
            });

            // Delete a record
            $('#news-table').on('click', 'td.editor-delete', function(e) {
                console.log('remove', $(this).children().data('id'));
            });

            $('#news-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.news.list') !!}',
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
                    },
                    // { data: 'email', name: 'email' },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                
                    {
                        data: null,
                        className: "dt-center editor-edit",
                        render: function(data, type, row) {
                            return '<a href="/digiso-admin/news/' + row.id + '/edit"><i class="fa fa-pencil" data-id="' + row.id + '"></i></a>'
                        }
                    },
                    {
                        data: null,
                        className: "dt-center editor-delete",
                        render: function(data, type, row) {
                            return '<a href="/digiso-admin/news/' + row.id + '/delete"><i class="fa fa-trash" data-id="' + row.id + '"></i></a>'
                        }
                    }
                ]
            });
        });

    </script>
