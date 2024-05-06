@extends('admin.layouts.app')

@section('content')
<form action="{{ url('/admin/update-Lomba/' . $lomba->id) . '/edit' }}" method="POST">
    @csrf
                    <!-- Isi formulir modal -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="nama_lomba">Nama Perlombaan</label>
                                <input type="text" name="nama_lomba" class="form-control" placeholder="Enter Name" value="{{ isset($lomba) ? $lomba->nama_lomba : old('nama_lomba') }}"
                                    id="nama_lomba">
                            </div>
                        </div>
                        <!-- Tambahkan input lainnya di sini -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="CreateTask-Category">Kategori</label>
                                <select class="form-select" name="kategori" id="kategori">
                                    @foreach ($kategoriOptions as $option)
                                        <option value="{{ $option }}" {{ isset($lomba) && $lomba->kategori == $option ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="lokasi">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" placeholder="Enter Place" value="{{ isset($lomba) ? $lomba->lokasi : old('lokasi') }}"
                                    id="lokasi">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" placeholder="Enter Place" value="{{ isset($lomba) ? $lomba->tanggal : old('tanggal') }}"
                                    id="tanggal">
                            </div>
                        </div>
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
@endsection