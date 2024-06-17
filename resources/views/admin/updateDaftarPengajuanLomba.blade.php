@extends('admin.layouts.app')

@section('content')
    <form action="{{ route('admin.updated.daftarPengajuanLomba', ['id' => $daftarPengajuan]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Update Pengajuan Perlombaan {{ $daftarPengajuan->nama_lomba }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- <input type="hidden" value="{{ $nama_lomba }}" name="nama_lomba">
                            <input type="hidden" value="{{ $nama_akun }}" name="stored_by">
                            <input type="hidden" value="{{ $kategori }}" name="kategori"> --}}
                            <div class="col-md-6">
                            <div class="mb-3">
                                 <label class="form-label" for="CreateTask-Category">Tingkatan Lomba</label>
                                 <select class="form-select" name="tingkatan_lomba" required>
                                     <option selected disabled> Select Tingkatan </option>
                                     <option value="Kota">Kota</option>
                                     <option value="Provinsi">Provinsi</option>
                                     <option value="Nasional">Nasional</option>
                                     <option value="Internasional">Internasional</option>
                                 </select>
                                 @error('tingkatan_lomba')
                                     <div class="text-danger">{{ $message }}</div>
                                 @enderror
                             </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Identitas Number Ketua</label>
                                    <input type="number" name="identitas_number_ketua" class="form-control"
                                        value="{{ isset($daftarPengajuan) ? $daftarPengajuan->identitas_number_ketua : old('identitas_number_ketua') }}"
                                        placeholder="Enter Task Name" id="CreateTask-Task-Name">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">No Telp Ketua</label>
                                    <input type="number" name="no_telp_ketua" class="form-control"
                                        value="{{ isset($daftarPengajuan) ? $daftarPengajuan->no_telp_ketua : old('no_telp_ketua') }}"
                                        placeholder="Enter Task Name" id="CreateTask-Task-Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Email Ketua</label>
                                    <input type="email" name="email_ketua" class="form-control"
                                        value="{{ isset($daftarPengajuan) ? $daftarPengajuan->email_ketua : old('email_ketua') }}"
                                        placeholder="Enter Email Name" id="CreateTask-Task-Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Category">Dosen Pembimbing</label>
                                    <select class="form-select" name="namadosen" id="kategori">
                                        <option selected disabled> Select Dosen </option>
                                        @foreach ($dospem as $item)
                                            <option value="{{ $item->nama }}"
                                                @if ($daftarPengajuan->namadosen === $item->nama) selected @endif>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Category">status</label>
                                    <select class="form-select" name="status" id="kategori">
                                        <option value="diterima" @if ($daftarPengajuan->status == 'diterima') selected @endif>Diterima
                                        </option>
                                        <option value="ditolak" @if ($daftarPengajuan->status == 'ditolak') selected @endif>Ditolak
                                        </option>
                                        <option value="Menunggu Persetujuan"
                                            @if ($daftarPengajuan->status == 'Menunggu Persetujuan') selected @endif>Menunggu Persetujuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="file_proposal_pengajuan">File Proposal Pengajuan</label>
                                    <input type="file" name="file_proposal_pengajuan" class="form-control">
                                    <div class=" d-grid pt-2 ps-1">
                                        <label for="">File Sebelumnya :</label>
                                        <p>{{ @substr($daftarPengajuan->file_proposal_pengajuan, 23) ?? 'Tidak Ada File Yang Dipilih' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-end d-flex g-3 justify-content-end">
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
