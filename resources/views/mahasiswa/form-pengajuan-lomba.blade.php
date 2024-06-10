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
                        <h5 class="card-title mb-0">Form Pendaftaran Lomba</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="nama_lomba">Nama Perlombaan</label>
                                    <input type="text" name="nama_lomba" class="form-control" placeholder="Enter Name"
                                        id="nama_lomba">
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="lokasi">Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control" placeholder="Enter Place"
                                        id="lokasi">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" placeholder="Enter Place"
                                        id="tanggal">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Nama Ketua</label>
                                    <input type="text" name="nama_ketua" class="form-control"
                                        placeholder="Enter Task Name" id="CreateTask-Task-Name">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Nim Ketua</label>
                                    <input type="number" name="identitas_number_ketua" class="form-control"
                                        placeholder="Enter Task Name" id="CreateTask-Task-Name">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">No Telp Ketua</label>
                                    <input type="number" name="no_telp_ketua" class="form-control"
                                        placeholder="Enter Task Name" id="CreateTask-Task-Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Email Ketua</label>
                                    <input type="email" name="email_ketua" class="form-control"
                                        placeholder="Enter Email Name" id="CreateTask-Task-Name">
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="file_proposal_pengajuan">File Proposal Pengajuan</label>
                                    <input type="file" name="file_proposal_pengajuan" class="form-control">
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


    <script>
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
