@extends('admin.layouts.app')
@section('content')
    {{-- style --}}
    <style>
        thead td p {
            font-weight: bold;

        }
    </style>
    {{-- end style --}}
    <form action="{{ route('admin.updated.daftarPengajuanBimbingan', ['id'=>$daftarPengajuan->id]) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Edit Pengajuan Bimbingan Perlombaan {{ $daftarPengajuan->nama_lomba }}</h5>
                        <input type="hidden" name="nama_lomba" value="{{ $daftarPengajuan->nama_lomba }}">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Nama Dosen Pembimbing</h5>
                                <p>{{ $daftarPengajuan->namadosen }}</p>
                                <input type="hidden" name="namadosen" value="{{ $daftarPengajuan->namadosen }}">
                            </div>
                            <div class="col-md-6">
                                <h5>Akun Yang mengajukan</h5>
                                <p>{{ $daftarPengajuan->stored_by }}</p>
                                <input type="hidden" name="stored_by" value="{{ $daftarPengajuan->stored_by }}">
                            </div>
                            <div class="col-md-6">
                                <h5>Nama Perlombaan</h5>
                                <p>{{ $daftarPengajuan->nama_lomba }}</p>
                                <input type="hidden" name="nama_lomba" value="{{ $daftarPengajuan->nama_lomba }}">
                            </div>
                            <div class="col-md-6">
                                <h5>Kategori Perlombaan</h5>
                                <p>{{ $daftarPengajuan->kategori_lomba }}</p>
                                <input type="hidden" name="kategori_lomba" value="{{ $daftarPengajuan->kategori_lomba }}">
                            </div>
                            <div class="col-md-6">
                                <h5>Nama Ketua Kelompok</h5>
                                <p>{{ $daftarPengajuan->nama_ketua }}</p>
                                <input type="hidden" name="nama_ketua" value="{{ $daftarPengajuan->nama_ketua }}">
                            </div>
                            <div class="col-md-6">
                                <h5>Nim Ketua Kelompok</h5>
                                <p>{{ $daftarPengajuan->identitas_number_ketua }}</p>
                                <input type="hidden" name="identitas_number_ketua" value="{{ $daftarPengajuan->identitas_number_ketua }}">
                            </div>
                            <div class="col-md-4">
                                <h5>Lokasi Bimbingan</h5>
                                <input type="text" name="lokasi_bimbingan" class="form-control" value="{{ isset($daftarPengajuan) ? $daftarPengajuan->lokasi_bimbingan : old('lokasi_bimbingan') }}">
                                
                            </div>
                            <div class="col-md-4">
                                <h5>Tanggal Bimbingan</h5>
                                <input type="date" name="tanggal_bimbingan" class="form-control" value="{{ isset($daftarPengajuan) ? $daftarPengajuan->tanggal_bimbingan : old('tanggal_bimbingan') }}">
                            </div>
                            <div class="col-md-4">
                                <h5>Waktu Bimbingan</h5>
                                <input type="time" name="waktu_bimbingan" class="form-control"  value="{{ isset($daftarPengajuan) ? $daftarPengajuan->waktu_bimbingan : old('waktu_bimbingan') }}">
                            </div>
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
@endsection
