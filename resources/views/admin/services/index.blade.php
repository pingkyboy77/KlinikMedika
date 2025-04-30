@extends('admin.layouts.app')
@section('title', 'Services')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Data Services</h3>
                            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i> Tambah Service
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div style="overflow-x: auto" class="table-responsive">
                            <table id="services-table" class="table table-bordered table-striped nowrap"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Services ID</th>
                                        <th>Service Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection


@section('scripts')

    <script>
        $(function() {
            let table = $('#services-table').DataTable();
table.clear().destroy();

            $('#services-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.services.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'ServicesID',
                        name: 'ServicesID'
                    },
                    {
                        data: 'ServiceName',
                        name: 'ServiceName'
                    },
                    {
                        data: 'Price',
                        name: 'Price'
                    },
                    {
                        data: 'status_badge',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            $('body').on('click', '.delete-btn', function() {
                const id = $(this).data("id");
                if (confirm("Are you sure to delete this service?")) {
                    $.ajax({
                        url: '/admin/services/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#services-table').DataTable().ajax.reload();
                            alert(response.success);
                        }
                    });
                }
            });
        });
    </script>
@endsection
