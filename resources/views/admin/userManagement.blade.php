{{-- @dd($data_users); --}}
@extends('admin.layouts.app')
@section('content')
{{-- <style>
    #myTable tbody td {
    height: 50px; /* Atur tinggi sel sesuai kebutuhan */
} --}}
</style>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">User Management</h5>
                </div>
                <div class="card-body">

                    <div class="">
                        <div class="row mb-2">
                            <div class="col-xl-12 col-md-12">
                                <div class="pb-3 pb-xl-0">
                                    <form class="email-search">
                                        <div class="position-relative">
                                        <h5>TABEL DATA USER MAHASISWA</h5>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- <div class="col-xl-9 col-md-12">
                                <div class="text-sm-end">
                                    <button type="button"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                        data-bs-toggle="modal" data-bs-target=".create-user"><i
                                            class="mdi mdi-plus me-1"></i> Create User</button>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="table-responsive mb-5">
                        <table class="table table-nowrap align-middle mb-0" id="myTable">
                            <thead class="fw-bold">
                                <tr>
                                    <td>
                                        <p class="mb-0">No</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Nama User</p>
                                    </td>

                                    <td>
                                        <p class="mb-0">Identitas Number</p>
                                    </td>
                                    {{-- <td>
                                        <p class="mb-0">Password</p>
                                    </td> --}}
                                    <td>
                                        <p class="mb-0">Role</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Prodi</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Tahun Angkatan</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">SKS Tempuh</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">IPK</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Kategori</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Status</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Action</p>
                                    </td>
                                </tr>


                            </thead>

                            <tbody>
                                @if ($data_users->isNotEmpty())
                                    @foreach ($data_users as $item)
                                        <tr>
                                            <td>
                                                <p class="mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->nama }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->identitas }}</p>
                                            </td>
                                            {{-- <td>
                                                <p class="mb-0">{{ $item->password }}</p>
                                            </td> --}}
                                            <td>
                                                <p class="mb-0">{{ $item->role }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->prodi }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->angkatan_tahun }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->sks_ditempuh }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->ipk }}</p>
                                            </td>
                                            
                                            <td>
                                                <p class="mb-0">{{ $item->kategori }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->status }}</p>
                                            </td>
                                            <td class="d-flex">
                                                <a class="btn btn-warning me-2"
                                                    href="{{ url('/admin/update-User/' . $item->id) . '/edit' }}"><i
                                                        class="bx bx-pencil"></i>Edit</a>
                                                <form action="{{ url('/admin/user-Management/' . $item->id) }}"
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-delete"><i
                                                            class="bx bx-trash-alt"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    {{-- <tr>
                                        <td colspan="8">
                                            <p class="text-center">Belum ada User</p>
                                        </td>
                                    </tr> --}}
                                @endif
                            </tbody>
                        </table>
                    </div>



                    <div class="mt-5">
                        <div class="row mb-2">
                            <div class="col-xl-12 col-md-12">
                                <div class="pb-3 pb-xl-0">
                                    <form class="email-search">
                                        <div class="position-relative">
                                        <h5>TABEL DATA USER DOSEN</h5>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- <div class="col-xl-9 col-md-12">
                                <div class="text-sm-end">
                                    <button type="button"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                        data-bs-toggle="modal" data-bs-target=".create-user"><i
                                            class="mdi mdi-plus me-1"></i> Create User</button>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-nowrap align-middle mb-0" id="tabeldosen">
                            <thead class="fw-bold">
                                <tr>
                                    <td>
                                        <p class="mb-0">No</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Nama User</p>
                                    </td>

                                    <td>
                                        <p class="mb-0">NIP / NIDN</p>
                                    </td>
                                    {{-- <td>
                                        <p class="mb-0">Password</p>
                                    </td> --}}
                                    <td>
                                        <p class="mb-0">Role</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Kategori</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Jabatan Fungsional</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Email</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Status</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Action</p>
                                    </td>
                                </tr>


                            </thead>

                            <tbody>
                                @if ($data_users_dosen->isNotEmpty())
                                    @foreach ($data_users_dosen as $item)
                                        <tr>
                                            <td>
                                                <p class="mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->nama }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->identitas }} / {{ $item->NIDN }}</p>
                                            </td>
                                            {{-- <td>
                                                <p class="mb-0">{{ $item->password }}</p>
                                            </td> --}}
                                            <td>
                                                <p class="mb-0">{{ $item->role }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->kategori }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->pangkat_akademik }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->email }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->status }}</p>
                                            </td>
                                            <td class="d-flex">
                                                <a class="btn btn-warning me-2"
                                                    href="{{ url('/admin/update-User/' . $item->id) . '/edit' }}"><i
                                                        class="bx bx-pencil"></i>Edit</a>
                                                <form action="{{ url('/admin/user-Management/' . $item->id) }}"
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-delete"><i
                                                            class="bx bx-trash-alt"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    {{-- <tr>
                                        <td colspan="8">
                                            <p class="text-center">Belum ada User</p>
                                        </td>
                                    </tr> --}}
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

    @include('admin.modals')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    var form = this.parentElement;
                    var url = form.getAttribute('action');

                    Swal.fire({
                        title: 'Apakah anda yakin menghapus data?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
   <script>
    $(document).ready(function() {
            var dataTableExists = $.fn.DataTable.isDataTable('#myTable');
            var dataTableExists2 = $.fn.DataTable.isDataTable('#tabeldosen');
            if (dataTableExists) {
                $('#myTable').DataTable().destroy();
            }
            if (dataTableExists2) {
                $('#tabeldosen').DataTable().destroy();
            }

            setTimeout(() => {

                $('#myTable').DataTable({
                    scrollCollapse: true,
                    responsive: true,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": [10]
                        } // Disable sorting for the third column (index 2)
                        // Add more entries as needed for other columns
                    ]
                });
            }, 100);
            setTimeout(() => {

                $('#tabeldosen').DataTable({
                    scrollCollapse: true,
                    responsive: true,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": [8]
                        } // Disable sorting for the third column (index 2)
                        // Add more entries as needed for other columns
                    ]
                });
            }, 100);
        });
</script>
@endsection
