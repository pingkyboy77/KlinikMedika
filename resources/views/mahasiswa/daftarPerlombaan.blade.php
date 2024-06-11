{{-- @dd($daftar_lomba_ikut) --}}
@extends('mahasiswa.layouts.app')
@section('content')
    {{-- style --}}
    <style>
        thead td p {
            font-weight: bold;

        }
    </style>
    {{-- end style --}}
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Lomba</h5>
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
                            <div class="col-xl-12 col-md-12 justify-content-end">
                                <div class="text-sm-end">
                                    <div class="text-sm-end">
                                        <a href="{{ route('mahasiswa.pengajuan-lomba') }}">
                                            <button type="button"
                                                class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i
                                                    class="mdi mdi-plus me-1"></i> Form Pendaftaran Lomba</button></a>
                                    </div>
                                    {{-- <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".create-task"><i class="mdi mdi-plus me-1"></i> Daftar Lomba</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-nowrap align-middle mb-0" id="tabel-daftar-perlombaan">
                            <thead>
                                <tr>
                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">No.</h5>
                                    </td>
                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Nama Perlombaan</h5>
                                    </td>
                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Kategori</h5>
                                    </td>

                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Nama Ketua</h5>
                                    </td>

                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Nama Dosen</h5>
                                    </td>

                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Jenis Pengajuan</h5>
                                    </td>
                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">File Proposal Pengajuan</h5>
                                    </td>

                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Status</h5>
                                    </td>
                                </tr>

                            </thead>
                            @if ($daftar_lomba_ikut->isNotEmpty())
                                @foreach ($daftar_lomba_ikut as $item)
                                    <tr>
                                        <td>
                                            <p class="mb-0">{{ $loop->iteration }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $item->nama_lomba }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $item->kategori }}</p>
                                        </td>

                                        <td>
                                            <p class="mb-0">{{ $item->nama_ketua }}</p>
                                        </td>

                                        <td>
                                            <p class="mb-0">{{ $item->namadosen }}</p>
                                        </td>

                                        <td>
                                            <p class="mb-0">{{ $item->jenis_pengajuan }}</p>
                                        </td>
                                        <td>
                                            {{-- <p class="mb-0">{{ substr($item->file_proposal_pengajuan, 23) }}</p> --}}
                                            <a href="/{{ $item->file_proposal_pengajuan }}"
                                                download="{{ substr($item->file_proposal_pengajuan, 23) }}">{{ substr($item->file_proposal_pengajuan, 23) }}</a>

                                        </td>

                                        @if ($item->status == 'diterima')
                                            <td class="ps-2">
                                                <a
                                                    href="{{ route('mahasiswa.pengajuan-bimbingan', ['id' => $item->id]) }}">
                                                    <button type="button"
                                                        class="btn btn-success btn-rounded waves-effect waves-light me-2">Ajukan
                                                        Bimbingan</button></a>
                                            </td>
                                        @elseif ($item->status == 'ditolak')
                                            <td class="d-flex ps-2 align-items-center">
                                                <p class="d-flex gap-2 align-items-center m-0">
                                                    <i class="bx bx-x text-danger fw-bold"></i>Decline
                                                </p>
                                            </td>
                                        @else
                                            <td class="d-flex ps-2 align-items-center">
                                                <p class="d-flex gap-2 align-items-center m-0">
                                                    <i class="bx bx-time text-warning fw-bold"></i>Menunggu Persetujuan
                                                </p>
                                            </td>
                                        @endif

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



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    {{-- <script>
        function openModal() {
            var modal = document.querySelector('.create-lomba');
            var modalBootstrap = new bootstrap.Modal(modal);
            modalBootstrap.show();
        }
    </script> --}}
    <script>
        $(document).ready(function() {
            var dataTableExists = $.fn.DataTable.isDataTable('#tabel-daftar-perlombaan');
            if (dataTableExists) {
                $('#tabel-daftar-perlombaan').DataTable().destroy();
            }

            setTimeout(() => {

                $('#tabel-daftar-perlombaan').DataTable({
                    scrollCollapse: true,
                    responsive: true,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": [6]
                        } // Disable sorting for the third column (index 2)
                        // Add more entries as needed for other columns
                    ]
                });
            }, 100);
        });
    </script>
@endsection
