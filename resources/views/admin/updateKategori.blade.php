@extends('admin.layouts.app')

@section('content')
<form action="{{ url('/admin/update-Kategori/' . $kategori->id) . '/edit' }}" method="POST">
    @csrf
    <!-- Isi formulir modal -->
    <div class="row card p-3 m-0">
        <div class="card-header border-0 px-3 pt-3 pb-0">
            <h5>Update Kategori</h5>
        </div>
        <div class="card-body p-3">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="kategori">Nama Kategori</label>
                    <input type="text" name="kategori" class="form-control" placeholder="Enter Name"
                        value="{{ isset($kategori) ? $kategori->kategori : old('kategori') }}" id="kategori">
                </div>
            </div>
            <!-- Tambahkan input lainnya di sini -->
            <div class="modal-footer border-0 p-0">
                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                        class="bx bx-x me-1 align-middle"></i> Cancel</button>
                <button type="submit" class="btn btn-success"><i class="bx bx-check me-1 align-middle"></i>
                    Confirm</button>
            </div>
        </div>
    </div>
</form>
@endsection
