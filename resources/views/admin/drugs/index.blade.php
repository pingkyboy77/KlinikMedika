@extends('admin.layouts.app')
@section('title', 'Drugs')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Data Drugs</h3>
                        <a href="{{ route('admin.drugs.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Add Drug
                        </a>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="drugs-table" class="table table-bordered table-striped nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Drug ID</th>
                                    <th>Name</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        $(function() {
            $('#drugs-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.drugs.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'DrugID',
                        name: 'DrugID'
                    },
                    {
                        data: 'DrugName',
                        name: 'DrugName'
                    },
                    {
                        data: 'UnitType',
                        name: 'UnitType'
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
                    }
                ]
            });
        });
    </script>
@endsection
