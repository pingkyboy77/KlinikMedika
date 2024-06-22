@extends('dosen.layouts.app')
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
                    <h5 class="card-title mb-0">Daftar Pengajuan Bimbingan Lomba</h5>
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
                        <table class="table table-nowrap align-middle mb-0" id="jadwal-bimbingan">
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

                                    {{-- <td>
                                        <h5 class="text-dark font-size-14 m-0">Lokasi Bimbingan</h5>
                                    </td> --}}
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
                                @if ($daftar_bimbingan_pengajuan->isNotEmpty())
                                    @foreach ($daftar_bimbingan_pengajuan as $item)
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
                                            {{-- <td>
                                                <p class="mb-0">{{ $item->lokasi_bimbingan }}</p>
                                            </td> --}}
                                            <td>
                                                <p class="mb-0">{{ $item->tanggal_bimbingan }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->waktu_bimbingan }}</p>
                                            </td>

                                            @if ($item->status == 'diterima')
                                                <td class="d-flex ps-2 align-items-center">
                                                    <p class="d-flex gap-2 align-items-center m-0">
                                                        <i class="bx bx-check text-success fw-bold"></i>accepted
                                                    </p>
                                                </td>
                                            @elseif ($item->status == 'Di jadwalkan Ulang')
                                                <td class="d-flex ps-2 align-items-center">
                                                    <p class="d-flex gap-2 align-items-center m-0">
                                                        <i class="bx bx-check text-warning fw-bold"></i>Reschedule
                                                    </p>
                                                </td>
                                            @else
                                                <td class=" d-flex gap-2">
                                                    <form
                                                        action="{{ route('dosen.updatepengajuanACC.bimbingan', ['id' => $item->id, 'status' => 'diterima']) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="d-flex align-items-center btn btn-success btn-rounded waves-effect waves-light gap-2">
                                                            <i class="bx bx-check fw-bold"></i> Accept</button>
                                                    </form>
                                                    {{-- <form action="{{ route('dosen.updatepengajuan.bimbingan', ['id'=>$item->id, 'status' => 'Di jadwalkan Ulang']) }}" method="POST"> --}}
                                                    @csrf
                                                    <button type="submit" onclick="openModal()"
                                                        class="d-flex align-items-center btn btn-warning btn-rounded waves-effect waves-light gap-2">
                                                        <i class="bx bx-time text-white fw-bold"></i> Reschedule</button>
                                                    {{-- </form> --}}
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
    @if ($daftar_bimbingan_pengajuan->isNotEmpty())
        <form action="{{ route('dosen.updatepengajuan.bimbingan', ['id' => $item->id, 'status' => 'Di jadwalkan Ulang']) }}"
            method="POST">
            @csrf
            <div class="modal fade reschedule" tabindex="-1" role="dialog" aria-labelledby="modal_kategori"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal_kategori">RESCHEDULE BIMBINGAN</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Isi formulir modal -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h5>Tanggal Bimbingan</h5>
                                    <input type="date" name="tanggal_bimbingan" id="tanggal_bimbingan"
                                        class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <h5>Waktu Bimbingan</h5>
                                    <input type="time" name="waktu_bimbingan" id="waktu_bimbingan" class="form-control">
                                </div>
                            </div>
                            <!-- Tambahkan input lainnya di sini -->
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
    @endif
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        function openModal() {
            var modal = document.querySelector('.reschedule');
            var modalBootstrap = new bootstrap.Modal(modal);
            modalBootstrap.show();
        }
    </script>
    <script>
        $(document).ready(function() {
            var dataTableExists = $.fn.DataTable.isDataTable('#jadwal-bimbingan');
            if (dataTableExists) {
                $('#jadwal-bimbingan').DataTable().destroy();
            }

            setTimeout(() => {

                $('#jadwal-bimbingan').DataTable({
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tanggalBimbinganInput = document.getElementById('tanggal_bimbingan');
            const waktuBimbinganInput = document.getElementById('waktu_bimbingan');

            tanggalBimbinganInput.addEventListener('change', function() {
                const selectedDate = new Date(tanggalBimbinganInput.value);
                const currentDate = new Date();

                // Check if the selected date is before today
                if (selectedDate < currentDate.setHours(0, 0, 0, 0)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tanggal tidak valid',
                        text: 'Tanggal tidak boleh sebelum hari ini.',
                    });
                    tanggalBimbinganInput.value = '';
                    return;
                }

            });

            waktuBimbinganInput.addEventListener('change', function() {
                const selectedTime = waktuBimbinganInput.value;
                const [hours, minutes] = selectedTime.split(':').map(Number);

                // Check if the selected time is within 08:00 to 17:00
                if (hours < 8 || (hours === 17 && minutes > 0) || hours > 17) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Waktu tidak valid',
                        text: 'Waktu bimbingan harus antara jam 08:00 sampai 17:00.',
                    });
                    waktuBimbinganInput.value = '';
                }
            });
        });
    </script>
@endsection
