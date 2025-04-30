@extends('admin.layouts.app')

@section('title', 'Daftar Staff')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Staff</h1>
            </div>
            {{-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Staff</li>
                </ol>
            </div> --}}
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Data Staff</h3>
                            <a href="{{ route('admin.staff.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i> Tambah Staff
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div style="overflow-x: auto" class="table-responsive">
                            <table id="staff-table" class="table table-bordered table-striped nowrap" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>ID Staff</th>
                                        <th>Email</th>
                                        <th>Telp</th>
                                        <th>Jabatan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data staff ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(function() {
            var table = $('#staff-table').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                responsive: false,
                autoWidth: false,
                ajax: {
                    url: "{{ route('admin.staff.getData') }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'avatar',
                        name: 'avatar',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'StaffID',
                        name: 'StaffID'
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
                        data: 'jabatan',
                        name: 'jabatan'
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
                ],
                order: [
                    [3, 'asc']
                ],
                language: {
                    emptyTable: "Tidak ada data staff yang tersedia",
                    zeroRecords: "Tidak ditemukan hasil yang cocok",
                    processing: "Memuat data...",
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(difilter dari _MAX_ total data)"
                }
            });
            let deleteId = null;

            $(document).on('click', '.delete-btn', function() {
                deleteId = $(this).data('id');
                $('#deleteModal').modal('show');
            });

            $('#confirmDelete').on('click', function() {
                if (deleteId) {
                    $.ajax({
                        url: '/admin/staff/' + deleteId,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#deleteModal').modal('hide');
                            alert(response.success);
                            $('#your-datatable-id').DataTable().ajax
                        .reload(); // Ganti id-nya jika berbeda
                        },
                        error: function(xhr) {
                            $('#deleteModal').modal('hide');
                            alert(xhr.responseJSON?.error || 'Gagal menghapus data.');
                        }
                    });
                }
            });


        });
    </script>
@endsection
