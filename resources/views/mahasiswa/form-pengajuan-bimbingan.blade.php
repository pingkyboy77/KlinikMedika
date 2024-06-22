{{-- @dd($acc_lomba) --}}
@extends('mahasiswa.layouts.app')
@section('content')
    {{-- style --}}
    <style>
        thead td p {
            font-weight: bold;

        }
    </style>
    {{-- end style --}}
    <form action="{{ route('mahasiswa.store.pengajuan-bimbingan') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Form Pengajuan Bimbingan Perlombaan {{ $acc_lomba->nama_lomba }}</h5>
                        <input type="hidden" name="nama_lomba" value="{{ $acc_lomba->nama_lomba }}">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Nama Dosen Pembimbing</h5>
                                <p>{{ $acc_lomba->namadosen }}</p>
                                <input type="hidden" name="namadosen" value="{{ $acc_lomba->namadosen }}">
                            </div>
                            <div class="col-md-6">
                                <h5>Nomor Telp Dosen</h5>
                                <p>{{ $data_dosen->no_hp }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Hari Bimbingan Dosen</h5>
                                <p>{{ $data_dosen->day_bimbingan }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Akun Yang mengajukan</h5>
                                <p>{{ $acc_lomba->stored_by }}</p>
                                <input type="hidden" name="stored_by" value="{{ $acc_lomba->stored_by }}">
                            </div>
                            <div class="col-md-6">
                                <h5>Nama Perlombaan</h5>
                                <p>{{ $acc_lomba->nama_lomba }}</p>
                                <input type="hidden" name="nama_lomba" value="{{ $acc_lomba->nama_lomba }}">
                            </div>
                            <div class="col-md-6">
                                <h5>Kategori Perlombaan</h5>
                                <p>{{ $acc_lomba->kategori }}</p>
                                <input type="hidden" name="kategori_lomba" value="{{ $acc_lomba->kategori }}">
                            </div>
                            <div class="col-md-6">
                                <h5>Nama Ketua Kelompok</h5>
                                <p>{{ $acc_lomba->nama_ketua }}</p>
                                <input type="hidden" name="nama_ketua" value="{{ $acc_lomba->nama_ketua }}">
                            </div>
                        </div>
                        <div class="row mt-4">
                            {{-- <div class="col-md-4">
                                <h5>Lokasi Bimbingan</h5>
                                <input type="text" name="lokasi_bimbingan" class="form-control">
                                
                            </div> --}}
                            {{-- <div class="row mt-4"> --}}
                                <div class="col-md-6">
                                    <h5>Tanggal Bimbingan</h5>
                                    <input type="date" name="tanggal_bimbingan" id="tanggal_bimbingan"
                                        class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <h5>Waktu Bimbingan</h5>
                                    <input type="time" name="waktu_bimbingan" class="form-control">
                                </div>
                            {{-- </div> --}}
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <a href="#" onclick="history.back();">
                                    <button type="button" class="btn btn-danger me-1">
                                        <i class="bx bx-x me-1 align-middle"></i> Cancel
                                    </button>
                                </a>
                                <button type="submit" class="btn btn-success"><i class="bx bx-check me-1 align-middle"></i>
                                    Confirm</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tanggalBimbinganInput = document.getElementById('tanggal_bimbingan');
            const validDay = "{{ $data_dosen->day_bimbingan }}";

            tanggalBimbinganInput.addEventListener('change', function() {
                const selectedDate = new Date(tanggalBimbinganInput.value);
                const currentDate = new Date();

                // Check if the selected date is before today
                if (selectedDate < currentDate.setHours(0, 0, 0, 0)) {
                    alert('Tanggal tidak valid');
                    tanggalBimbinganInput.value = '';
                    return;
                }

                // Get the selected day of the week
                const days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                const selectedDay = days[selectedDate.getDay()];

                // Check if the selected day matches the valid day
                if (selectedDay !== validDay) {
                    alert(`Dosen hanya bisa di hari ${validDay}`);
                    tanggalBimbinganInput.value = '';
                }
            });
        });
    </script>
@endsection
