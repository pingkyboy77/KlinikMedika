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
                            <input type="hidden" value="{{ $nama }}" name="stored_by">
                            <input type="hidden" value="{{ $daftarPengajuan->kategori }}" name="kategori"> 

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="nama_lomba">Nama Perlombaan</label>
                                    <input type="text" name="nama_lomba" class="form-control" placeholder="Enter Name"
                                        id="nama_lomba" value="{{ isset($daftarPengajuan) ? $daftarPengajuan->nama_lomba : old('nama_lomba') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                            <div class="mb-3">
                                 <label class="form-label" for="CreateTask-Category">Tingkatan Lomba</label>
                                 <select class="form-select" name="tingkatan_lomba" required>
                                     <!-- <option selected disabled> Select Tingkatan </option> -->
                                     <option value="Kota" @if($daftarPengajuan->tingkatan_lomba == 'Kota') selected @endif>Kota</option>
                                     <option value="Provinsi" @if($daftarPengajuan->tingkatan_lomba == 'Provinsi') selected @endif>Provinsi</option>
                                     <option value="Nasional" @if($daftarPengajuan->tingkatan_lomba == 'Nasional') selected @endif>Nasional</option>
                                     <option value="Internasional" @if($daftarPengajuan->tingkatan_lomba == 'Internasional') selected @endif>Internasional</option>
                                 </select>
                                 @error('tingkatan_lomba')
                                     <div class="text-danger">{{ $message }}</div>
                                 @enderror
                             </div>
                            </div>
                            <div class="col-md-6">
                            <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Nim Ketua</label>
                                    <input type="number" name="identitas_number_ketua" class="form-control"
                                        placeholder="Enter Identitas" id="nim_ketua" value="{{ isset($daftarPengajuan) ? $daftarPengajuan->identitas_number_ketua : old('identitas_number_ketua') }}">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Nama Ketua</label>
                                    <input type="text" name="hidden_nama_ketua" class="form-control"
                                        placeholder="Enter Name" disabled id="hidden_nama_ketua" value="{{ isset($daftarPengajuan) ? $daftarPengajuan->nama_ketua : old('nama_ketua') }}" >
                                        <input type="hidden" name="nama_ketua" id="nama_ketua" value="{{ isset($daftarPengajuan) ? $daftarPengajuan->nama_ketua : old('nama_ketua') }}">
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
                            <div class="col-md-6 mb-5">
                            <div class="mb-3">
                                 <label class="form-label" for="CreateTask-Category">Program Studi</label>
                                 <select class="form-select" name="prodi" required>
                                     <!-- <option selected disabled> Select Tingkatan </option> -->
                                     <option value="S1 Informatika"  @if($daftarPengajuan->program_studi == 'S1 Informatika') selected @endif>S1 Informatika</option>
                                     <option value="S1 Sistem Informasi"  @if($daftarPengajuan->program_studi == 'S1 Sistem Informasi') selected @endif>S1 Sistem Informasi</option>
                                     <option value="D3 SIstem Informasi" @if($daftarPengajuan->program_studi == 'D3 SIstem Informasi') selected @endif>D3 SIstem Informasi</option>
                                 </select>
                                 @error('program_studi')
                                     <div class="text-danger">{{ $message }}</div>
                                 @enderror
                             </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Anggota 1 (Nama - Nim)</label>
                                    <input type="text" name="anggota_1" class="form-control"
                                        placeholder="Enter Anggota 1" id="CreateTask-Task-Name" value="{{ isset($daftarPengajuan) ? $daftarPengajuan->anggota_1 : old('anggota_1') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Anggota 2 (Nama - Nim)</label>
                                    <input type="text" name="anggota_2" class="form-control"
                                        placeholder="Enter Anggota 2" id="CreateTask-Task-Name" value="{{ isset($daftarPengajuan) ? $daftarPengajuan->anggota_2 : old('anggota_2') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Anggota 3 (Nama - Nim)</label>
                                    <input type="text" name="anggota_3" class="form-control"
                                        placeholder="Enter Anggota 3" id="CreateTask-Task-Name" value="{{ isset($daftarPengajuan) ? $daftarPengajuan->anggota_3 : old('anggota_3') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Anggota 4 (Nama - Nim)</label>
                                    <input type="text" name="anggota_4" class="form-control"
                                        placeholder="Enter Anggota 4" id="CreateTask-Task-Name" value="{{ isset($daftarPengajuan) ? $daftarPengajuan->anggota_4 : old('anggota_4') }}">
                                </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const usermahasiswa = @JSON($usermahasiswa);
        $(document).ready(function() {
            console.log(usermahasiswa);
            $('#nim_ketua').on('input', function() {
                var nim = $(this).val();
                var nama_ketua = '';

                // Cari nama berdasarkan nim yang diinput
                usermahasiswa.forEach(function(mahasiswa) {
                    if (mahasiswa.identitas === nim) {
                        nama_ketua = mahasiswa.nama;
                    }
                });

                // Update nilai nama_ketua berdasarkan hasil pencarian
                $('#nama_ketua').val(nama_ketua);
                $('#hidden_nama_ketua').val(nama_ketua);
            });
        });
    </script>
@endsection
