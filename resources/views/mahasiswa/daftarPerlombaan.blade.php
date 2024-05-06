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
                            <div class="col-xl-3 col-md-12">
                                <div class="pb-3 pb-xl-0">
                                    <form class="email-search">
                                        <div class="position-relative">
                                            <input type="text" class="form-control bg-light" placeholder="Search...">
                                            <span class="bx bx-search font-size-18"></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xl-9 col-md-12">
                                <div class="text-sm-end">
                                    {{-- <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".create-task"><i class="mdi mdi-plus me-1"></i> Daftar Lomba</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-nowrap align-middle mb-0">
                            <thead>
                                <tr>
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
                                                        <a
                                                            href="{{ route('mahasiswa.pengajuan-lomba', ['nama_lomba' => $item->nama_lomba, 'nama_akun' => $nama, 'kategori' => $item->kategori]) }}">
                                                            <button type="button"
                                                                class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                                                <i class="mdi mdi-plus me-1"></i> Daftar
                                                            </button>
                                                        </a>
                                                    </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center">Tidak ada data</p>
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


    <!-- Modal -->
    <form action="#" method="POST">
        @csrf
        <div class="modal fade create-daftarLomba" tabindex="-1" role="dialog" aria-labelledby="daftarLomba"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="daftarLomba">Tambah Lomba</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Isi formulir modal -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="kategori">Nama Kategori</label>
                                    <input type="text" name="kategori" class="form-control" placeholder="Enter Name"
                                        id="kategori">
                                </div>
                            </div>
                            <!-- Tambahkan input lainnya di sini -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                class="bx bx-x me-1 align-middle"></i> Cancel</button>
                        <button type="submit" class="btn btn-success"><i class="bx bx-check me-1 align-middle"></i>
                            Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function openModal() {
            var modal = document.querySelector('.create-daftarLomba');
            var modalBootstrap = new bootstrap.Modal(modal);
            modalBootstrap.show();
        }
    </script>
@endsection
