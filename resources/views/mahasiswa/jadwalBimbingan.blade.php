@extends('mahasiswa.layouts.app')
@section('content')
    {{-- style --}}
    <style>
        thead td p {
            font-weight: bold;

        }
    </style>
    {{-- end stly --}}
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Jadwal Bimbingan</h5>
                </div>
                <div class="card-body">



                    <div class="table-responsive">
                        <table class="table table-nowrap align-middle mb-0" id="tabel-jadwal-bimbingan">
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
                                        <h5 class="text-dark font-size-14 m-0">Lokasi Bimbingan</h5>
                                    </td>
                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Tanggal Bimbingan</h5>
                                    </td>
                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Waktu Bimbingan</h5>
                                    </td>

                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Status</h5>
                                    </td>
                                </tr>

                            </thead>

                            <tbody>

                                @if ($daftar_bimbingan->isNotEmpty())
                                    @foreach ($daftar_bimbingan as $item)
                                        <tr>
                                            <td>
                                                <p class="mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->nama_lomba }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->kategori_lomba }}</p>
                                            </td>

                                            <td>
                                                <p class="mb-0">{{ $item->nama_ketua }}</p>
                                            </td>

                                            <td>
                                                <p class="mb-0">{{ $item->namadosen }}</p>
                                            </td>

                                            <td>
                                                <p class="mb-0">{{ $item->lokasi_bimbingan }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->tanggal_bimbingan }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->waktu_bimbingan }}</p>
                                            </td>


                                            <td class="d-flex ps-2 align-items-center">
                                                @if ($item->status == 'diterima')
                                                    <p class="d-flex gap-2 align-items-center m-0">
                                                        <i class="bx bx-check text-success fw-bold"></i>accepted
                                                    </p>
                                                    {{-- </td> --}}
                                                @elseif ($item->status == 'ditolak')
                                                    {{-- <td class="d-flex ps-2 align-items-center"> --}}
                                                    <p class="d-flex gap-2 align-items-center m-0">
                                                        <i class="bx bx-x text-danger fw-bold"></i>Decline
                                                    </p>
                                                    {{-- </td> --}}
                                                @else
                                                    {{-- <td class="d-flex ps-2 align-items-center"> --}}
                                                    <p class="d-flex gap-2 align-items-center m-0">
                                                        <i class="bx bx-time text-info fw-bold"></i>Waiting
                                                    </p>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    {{-- <tr>
                                        <td colspan="9" class="text-center">Tidak Ada Bimbingan</td>
                                    </tr> --}}
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
            var dataTableExists = $.fn.DataTable.isDataTable('#tabel-jadwal-bimbingan');
            if (dataTableExists) {
                $('#tabel-jadwal-bimbingan').DataTable().destroy();
            }

            setTimeout(() => {

                $('#tabel-jadwal-bimbingan').DataTable({
                    scrollCollapse: true,
                    responsive: true,
                });
            }, 100);
        });
    </script>
@endsection
