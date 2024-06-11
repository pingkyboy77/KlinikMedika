{{-- @dd(str_replace([' ', ',', '.', ' '], '-', $dospem[0]->nama)) --}}
@extends('mahasiswa.layouts.app')
@section('content')
    <style>
        thead td p {
            font-weight: bold;

        }
    </style>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Dosen Pembimbing</h5>
                </div>
                <div class="card-body">

                    <div class="">
                        <div class="row mb-2">
                            {{-- <div class="col-xl-3 col-md-12">
                                <div class="pb-3 pb-xl-0">
                                    <form class="email-search">
                                        <div class="position-relative">
                                            <input type="text" class="form-control bg-light" placeholder="Search...">
                                            <span class="bx bx-search font-size-18"></span>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}
                            <div class="col-xl-9 col-md-12">
                                <div class="text-sm-end">
                                    {{-- <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".create-task"><i class="mdi mdi-plus me-1"></i> Create Task</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-nowrap align-middle mb-0" id="tabel-data-dosen-pembimbing">
                            <thead>
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
                                @if ($dospem->isNotEmpty())
                                    @foreach ($dospem as $item)
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
                                                <a class="btn btn-success me-2 d-flex justify-content-center align-items-center gap-1" target="_blank"
                                                    href="{{ url('https://new-fik.upnvj.ac.id/team-category/dosen-d3-sistem-informasi/') }}"><i
                                                        class="bx bx-search"></i>Lihat Profil</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">
                                            <p class="mb-0 text-center">Data tidak ditemukan</p>
                                        </td>
                                @endif
                            </tbody>


                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            var dataTableExists = $.fn.DataTable.isDataTable('#tabel-data-dosen-pembimbing');
            if (dataTableExists) {
                $('#tabel-data-dosen-pembimbing').DataTable().destroy();
            }

            setTimeout(() => {

                $('#tabel-data-dosen-pembimbing').DataTable({
                    scrollCollapse: true,
                    responsive: true,
                });
            }, 100);
        });
    </script>
@endsection
