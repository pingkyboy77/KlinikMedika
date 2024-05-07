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
                            <div class="col-xl-9 col-md-12">
                                <div class="text-sm-end">
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
                                        <h5 class="text-dark font-size-14 m-0">Tempat</h5>
                                    </td>

                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Tanggal</h5>
                                    </td>

                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Action</h5>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($daftar_lomba->isNotEmpty())
                                    @foreach ($daftar_lomba as $item)
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
                                                <p class="mb-0">{{ $item->lokasi }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->tanggal }}</p>
                                            </td>
                                            <td class="ps-2">
                                                <!-- Button untuk membuka modal -->
                                                <div>
                                                    @if ($daftar_lomba_ikut->where('nama_lomba', $item->nama_lomba)->isNotEmpty())
                                                            <span class="text-bold">Sudah Mendaftar</span>
                                                    @else
                                                        <a
                                                            href="{{ route('mahasiswa.pengajuan-lomba', ['nama_lomba' => str_replace(' ','-',$item->nama_lomba), 'nama_akun' => $nama, 'id' => $item->id]) }}">
                                                            <button type="button"
                                                                class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                                                <i class="mdi mdi-plus me-1"></i> Daftar
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-center">Tidak ada data perlombaan</p>
                                        </td>
                                    </tr>
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
        function openModal() {
            var modal = document.querySelector('.create-daftarLomba');
            var modalBootstrap = new bootstrap.Modal(modal);
            modalBootstrap.show();
        }

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
                            "targets": [5]
                        } // Disable sorting for the third column (index 2)
                        // Add more entries as needed for other columns
                    ]
                });
            }, 100);
        });
    </script>
@endsection
