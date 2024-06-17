{{-- @dd($kategori); --}}
@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Pengajuan Lomba Management</h5>
                </div>
                <div class="card-body">

                    <div class="">
                        <div class="row mb-2">
                            <div class="col-xl-3 col-md-12">
                                <div class="pb-3 pb-xl-0">
                                    {{-- <form class="email-search">
                                        <div class="position-relative">
                                            <input type="text" class="form-control bg-light" placeholder="Search...">
                                            <span class="bx bx-search font-size-18"></span>
                                        </div>
                                    </form> --}}
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
                        <table class="table table-nowrap align-middle mb-0" id="tabelpengajuan">
                            <thead>
                                <tr>
                                    <td style="width:5%">
                                        <p class="mb-0">No.</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Nama User Pengajuan</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Nama Ketua Kelompok</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Tingkatan Lomba</p>
                                    </td>

                                    <td>
                                        <p class="mb-0">Identitas Number Ketua</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Nama Lomba</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Kategori</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">File Proposal</p>
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
                                @if ($pengajuan_jumlah->isNotEmpty())
                                    @foreach ($pengajuan_jumlah as $item)
                                        <tr>
                                            <td style="width:5%">
                                                <p class="mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->stored_by }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->nama_ketua }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->tingkatan_lomba }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->identitas_number_ketua }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->nama_lomba }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->kategori }}</p>
                                            </td>
                                            <td>
                                                <a href="/{{ $item->file_proposal_pengajuan }}"
                                                    download="{{ substr($item->file_proposal_pengajuan, 23) }}">{{ substr($item->file_proposal_pengajuan, 23) }}</a>

                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->status }}</p>
                                            </td>
                                            <td class="d-flex">
                                                <a class="btn btn-warning me-2"
                                                    href="{{ route('account.update.daftarPengajuanLomba', ['id' => $item->id]) }}"><i
                                                        class="bx bx-pencil"></i>Edit</a>
                                                <form
                                                    action="{{ route('account.DaftarPengajuan.delete', ['id' => $item->id]) }}"
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-delete"><i
                                                            class="bx bx-trash-alt"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            var dataTableExists = $.fn.DataTable.isDataTable('#tabelpengajuan');
            if (dataTableExists) {
                $('#tabelpengajuan').DataTable().destroy();
            }

            setTimeout(() => {

                $('#tabelpengajuan').DataTable({
                    scrollCollapse: true,
                    responsive: true,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": [9]
                        } // Disable sorting for the third column (index 2)
                        // Add more entries as needed for other columns
                    ]
                });
            }, 100);
        });
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
@endsection
