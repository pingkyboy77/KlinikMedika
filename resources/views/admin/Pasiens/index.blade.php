@extends('admin.layouts.app')

@section('title', 'Data Pasien')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Data Pasien</h3>
                        <a href="{{ route('staff.pasiens.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Tambah Pasien
                        </a>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="pasiens-table" class="table table-bordered table-striped nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Registration Number</th>
                                    <th>Identity Number</th>
                                    <th>Insurance Number</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Alamat</th>
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
            $('#pasiens-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('staff.pasiens.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'registration_number',
                        name: 'registration_number'
                    },
                    {
                        data: 'identity_number',
                        name: 'identity_number'
                    },
                    {
                        data: 'insurance_number',
                        name: 'insurance_number'
                    },
                    {
                        data: 'PasienName',
                        name: 'PasienName'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'telp',
                        name: 'telp'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
