@extends('admin.layouts.app')

@section('content')
<form action="{{ url('/admin/update-Kategori/' . $kategori->id) . '/edit' }}" method="POST">
    @csrf
                    <!-- Isi formulir modal -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="kategori">Nama Kategori</label>
                                <input type="text" name="kategori" class="form-control" placeholder="Enter Name"
                                    value="{{ isset($kategori) ? $kategori->kategori : old('kategori') }}" id="kategori">
                            </div>
                        </div>
                        <!-- Tambahkan input lainnya di sini -->
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
</form>
@endsection
