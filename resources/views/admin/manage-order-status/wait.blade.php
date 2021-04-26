@extends('admin-layouts.main-ui')

@section('content')

    <div class="col-12">
        @php
            // $title = [
            //     'watting_payment' => 'รอการชำระเงิน',
            //     'successful_payment' => 'แจ้งชำระเงินแล้ว รอตรวจสอบ',
            //     'waiting_delivery' => 'กำลังดำเนินการ',
            //     'successful_delivery' => 'ส่งสินค้าแล้ว',
            //     'cancel' => 'ชำระเงินผิด',
            // ];
            $title = [
                'watting_payment' => 'Watting Payment',
                'successful_payment' => 'Successful Payment',
                'waiting_delivery' => 'Waiting Delivery',
                'successful_delivery' => 'Successful Delivery',
                'cancel' => 'Cancel',
            ];
        @endphp
        <h2>Order {{ $title[$status] }}</h2>
        <div class="separator mb-5"></div>
    </div>

    {{-- datatable --}}
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-tasks">
                <div class="card-body">
                    <div style="margin-top: 30px">
                        <table class="table table-bordered" id="order-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Order_no</th>
                                    <th>USER</th>
                                    {{-- <th>Email</th> --}}
                                    <th>Created At</th>
                                    <th>Update Status</th>

                                    {{-- option field to update status --}}

                                    {{-- <th>edit</th>
                <th>remove</th> --}}
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        name: 'id',
                        render: function(data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'order_no',
                        name: 'order_no',
                        className: "dt-center",
                        render: function(data, type, row) {
                            // 
                            return '<a href="/digiso-admin/order/{!! $status !!}/no/' + row
                                .order_no +
                                '">' + row.order_no + '</a>'
                        }
                    },
                    {
                        data: 'user_id',
                        name: 'user_id',
                        className: "dt-center editor-edit",
                        render: function(data, type, row) {
                            var address = JSON.parse(row.address.replace(/&quot;/g, '"'))
                            console.log(address)
                            return address.email ? address.email : null
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    // {
                    //     data: null,
                    //     className: "dt-center editor-edit",
                    //     render: function(data, type, row) {
                    //         return '<i class="fa fa-pencil" data-id="' + row.id + '"></i>'
                    //     }
                    // },
                    // {
                    //     data: null,
                    //     className: "dt-center editor-delete",
                    //     render: function(data, type, row) {
                    //         return '<i class="fa fa-trash" data-id="' + row.id + '"></i>'
                    //     }
                    // }
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
