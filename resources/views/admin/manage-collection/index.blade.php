@extends('admin-layouts.main-ui')

@section('content')
    <div class="form-group row">
        <div class="col-12">
            <h2 class="pull-left">Sub Category</h2>
            <span class="pull-right">
                <a href="{{ route('admin.collection.add') }}"><i class="fa fa-plus"></i> Add Sub Category </a>
            </span>
            <div class="separator mb-5"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-tasks">
                <div class="card-body">
                    <div style="margin-top: 80px">
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
                            <table class="table table-bordered text-center" id="collection-table" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category</th>
                                        <th>edit</th>
                                        <th>remove</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                ajax: '{!! route('admin.collection.datalist') !!}',
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
                            return '<a href="/digiso-admin/collection/' + row.id +
                                '/edit"><i class="tim-icons icon-pencil" data-id="' + row.id +
                                '"></i></a>'
                        }
                    },
                    {
                        data: null,
                        className: "dt-center editor-delete",
                        render: function(data, type, row) {
                            return '<a href="/digiso-admin/collection/' + row.id +
                                '/delete"><i class="fa fa-trash" data-id="' + row.id + '"></i></a>'
                        }
                    }
                ]
            });
        });

    </script>
