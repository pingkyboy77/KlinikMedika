{{-- @dd($usermahasiswa) --}}
@extends('mahasiswa.layouts.app')
@section('content')
    {{-- style --}}
    <style>
        thead td p {
            font-weight: bold;

        }
    </style>
    {{-- end style --}}
    <form action="{{ route('mahasiswa.store.pengajuan-lomba') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Form Daftar Mahasiswa FIK Mengikuti Lomba dan Pengajuan Dosen Pembimbing</h5>
                    </div>
                    <div class="card-body">
                        <div class="section" style="margin-bottom: 10px; font-size: 20px; font-weight: 700; text-decoration: underline;" >Data Perlombaan</div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="nama_lomba">Nama Perlombaan</label>
                                    <input type="text" name="nama_lomba" class="form-control" placeholder="Enter Name"
                                        id="nama_lomba">
                                </div>
                            </div>
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
                                    <label class="form-label" for="penyelenggara">Penyelenggara</label>
                                    <input type="text" name="penyelenggara" class="form-control" placeholder="Enter Penyelenggara"
                                        id="penyelenggara">
                                </div>
                            </div>
                          

                            <!-- Tambahkan input lainnya di sini -->

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Category">Kategori</label>
                                    <select class="form-select" name="kategori" id="kategori">
                                        <option selected disabled> Select Kategori </option>
                                        @foreach ($kategori as $option)
                                            <option value="{{ $option }}">
                                                {{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <div class="mb-3">
                                    <label class="form-label" for="lokasi">Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control" placeholder="Enter Place"
                                        id="lokasi">
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <div class="mb-3">
                                    <label class="form-label" for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" placeholder="Enter Place"
                                        id="tanggal">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="namadosen">Dosen Pembimbing</label>
                                    <select class="form-select" name="namadosen" id="namadosen">
                                        <option selected disabled> Select Dosen </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-3">
                                    <label class="form-label" for="file_proposal_pengajuan">File Proposal
                                        Pengajuan</label>
                                    <input type="file" name="file_proposal_pengajuan" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="section" style="margin-bottom: 10px; font-size: 20px; font-weight: 700; text-decoration: underline;" >Data Mahasiswa</div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Nim Ketua</label>
                                    <input type="number" name="identitas_number_ketua" class="form-control"
                                        placeholder="Enter Identitas" id="nim_ketua">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Nama Ketua</label>
                                    <input type="text" name="hidden_nama_ketua" class="form-control"
                                        placeholder="Enter Name" disabled id="hidden_nama_ketua">
                                        <input type="hidden" name="nama_ketua" id="nama_ketua">
                                </div>

                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Prodi</label>
                                    <input type="text" name="hidden_prodi" class="form-control"
                                        placeholder="Enter Name" disabled id="hidden_prodi">
                                        <input type="hidden" name="prodi" id="prodi">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">No Telp Ketua</label>
                                    <input type="number" name="no_telp_ketua" class="form-control"
                                        placeholder="Enter Task Name" id="CreateTask-Task-Name">
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Email Ketua</label>
                                    <input type="email" name="email_ketua" class="form-control"
                                        placeholder="Enter Email Name" id="CreateTask-Task-Name">
                                </div>
                            </div>
    </div>
    <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Anggota 1 (Nama - Nim)</label>
                                    <input type="text" name="anggota_1" class="form-control"
                                        placeholder="Enter Anggota 1" id="CreateTask-Task-Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Anggota 2 (Nama - Nim)</label>
                                    <input type="text" name="anggota_2" class="form-control"
                                        placeholder="Enter Anggota 2" id="CreateTask-Task-Name">
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Anggota 3 (Nama - Nim)</label>
                                    <input type="text" name="anggota_3" class="form-control"
                                        placeholder="Enter Anggota 3" id="CreateTask-Task-Name">
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Anggota 4 (Nama - Nim)</label>
                                    <input type="text" name="anggota_4" class="form-control"
                                        placeholder="Enter Anggota 4" id="CreateTask-Task-Name">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <a href="#" onclick="history.back();">
                                    <button type="button" class="btn btn-danger me-1">
                                        <i class="bx bx-x me-1 align-middle"></i> Cancel
                                    </button>
                                </a>
                                <button type="submit" class="btn btn-success"><i
                                        class="bx bx-check me-1 align-middle"></i>
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
                var prodi = '';

                // Cari nama berdasarkan nim yang diinput
                usermahasiswa.forEach(function(mahasiswa) {
                    if (mahasiswa.identitas === nim) {
                        nama_ketua = mahasiswa.nama;
                        prodi = mahasiswa.prodi;
                    }
                });

                // Update nilai nama_ketua berdasarkan hasil pencarian
                $('#nama_ketua').val(nama_ketua);
                $('#hidden_nama_ketua').val(nama_ketua);
                $('#prodi').val(prodi);
                $('#hidden_prodi').val(prodi);
            });
        });
        document.getElementById('kategori').addEventListener('change', function() {
            var kategori = this.value;
            console.log(kategori);
            fetch(`/get-dosen-pembimbing?kategori=${kategori}`)
                .then(response => response.json())
                .then(data => {
                    var namadosenSelect = document.getElementById('namadosen');
                    namadosenSelect.innerHTML = '<option selected disabled>Select Dosen</option>';
                    console.log(data);
                    data.forEach(dosen => {
                        var option = document.createElement('option');
                        option.value = dosen.nama;
                        option.textContent = dosen.nama;
                        namadosenSelect.appendChild(option);
                    });
                })
        });
    </script>
@endsection
