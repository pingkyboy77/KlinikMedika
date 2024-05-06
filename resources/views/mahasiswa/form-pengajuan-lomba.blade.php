@extends('mahasiswa.layouts.app')
@section('content')
    {{-- style --}}
    <style>
        thead td p {
            font-weight: bold;

        }
    </style>
    {{-- end style --}}
    <form action="{{ route('mahasiswa.store.pengajuan-lomba') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Form Pendaftaran Perlombaan {{ $nama_lomba }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" value="{{ $nama_lomba }}" name="nama_lomba">
                        <input type="hidden" value="{{ $nama_akun }}" name="stored_by">
                        <input type="hidden" value="{{ $kategori }}" name="kategori">
                         <div class="col-md-6">
                             <div class="mb-3">
                                 <label class="form-label" for="CreateTask-Task-Name">Nama Ketua</label>
                                 <input type="text" name="nama_ketua" class="form-control" placeholder="Enter Task Name"
                                     id="CreateTask-Task-Name">
                             </div>

                         </div>
                         <div class="col-md-6">
                             <div class="mb-3">
                                 <label class="form-label" for="CreateTask-Task-Name">Identitas Number</label>
                                 <input type="number" name="identitas_number_ketua" class="form-control"
                                     placeholder="Enter Task Name" id="CreateTask-Task-Name">
                             </div>

                         </div>
                         <div class="col-md-6">
                             <div class="mb-3">
                                 <label class="form-label" for="CreateTask-Category">Dosen Pembimbing</label>
                                 <select class="form-select" name="namadosen" id="kategori">
                                     <option selected disabled> Select Dosen </option>
                                     @foreach ($dospem as $item)
                                         <option value="{{ $item->nama }}"> {{ $item->nama }} </option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                     </div>
                     <div class="row mt-2">
                         <div class="col-12 text-end">
                             <button type="submit" class="btn btn-success"><i
                                     class="bx bx-check me-1 align-middle"></i> Confirm</button>
                         </div>
                     </div>

                </div>
            </div>
        </div>

    </div>
    </form>

@endsection
