@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>รายการ รอชำระเงิน</h1>
        <div class="separator mb-5"></div>
    </div>

    {{-- datatable --}}


    <table class="table table-bordered" id="order-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
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
            $('#order-table').on('click', 'td.editor-edit', function(e) {
                console.log('edit', $(this).children().data('id'));
            });

            // Delete a record
            $('#order-table').on('click', 'td.editor-delete', function(e) {
                console.log('remove', $(this).children().data('id'));
            });

            $('#order-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.order.list', ['status' => $status]) !!}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
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
                            return '<i class="fa fa-pencil" data-id="' + row.id + '"></i>'
                        }
                    },
                    {
                        data: null,
                        className: "dt-center editor-delete",
                        render: function(data, type, row) {
                            return '<i class="fa fa-trash" data-id="' + row.id + '"></i>'
                        }
                    }
                ]
            });
        });

    </script>
