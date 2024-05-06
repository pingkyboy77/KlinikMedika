@extends('admin.layouts.app')

@section('content')
<form action="{{ url('/admin/update-User/' . $user->id) . '/edit' }}" method="POST">
    @csrf
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="CreateTask-Task-Name">Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Enter Task Name" value="{{ isset($user) ? $user->nama : old('nama') }}"
                id="CreateTask-Task-Name">
        </div>

    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="CreateTask-Task-Name">Identitas Number</label>
            <input type="text" name="identitas" class="form-control" value="{{ isset($user) ? $user->identitas : old('identitas') }}"
                placeholder="Enter Task Name" id="CreateTask-Task-Name">
        </div>

    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="CreateTask-Team-Member">Password</label>
            <input type="password" name="password" class="form-control"
                placeholder="Enter Password" id="CreateTask-Team-Member">
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="CreateTask-Category">Role</label>
            <select class="form-select" name="role" id="role_update" >
                {{-- <option selected disabled>Role Sebelumnya - {{ isset($user) ? $user->role : old('role') }}</option> --}}
                <option value="admin" @if (isset($user) && $user->role == 'admin')
                    selected
                @endif>Admin</option>
                <option value="mahasiswa" @if (isset($user) && $user->role == 'mahasiswa')
                    selected
                @endif>Mahasiswa</option>
                <option value="dosen" @if (isset($user) && $user->role == 'dosen')
                    selected
                @endif>Dosen</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="CreateTask-Category">Kategori</label>
            <select class="form-select" name="kategori" id="kategori_update">
                <option selected disabled> Select Category </option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="CreateTask-Category">Status</label>
            <select class="form-select" name="status">
                {{-- <option selected> Status Sebelumnya - {{ isset($user) ? $user->status : old('status') }}</option> --}}
                <option value="active" @if (isset($user) && $user->status == 'active')
                    selected
                @endif>Active</option>
                <option value="non active" @if (isset($user) && $user->status == 'non active')
                    selected
                @endif>Non Active</option>
            </select>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12 text-end">
        <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                class="bx bx-x me-1 align-middle"></i> Cancel</button>
        <button type="submit" class="btn btn-success" data-bs-toggle="modal"><i
                class="bx bx-check me-1 align-middle"></i> Confirm</button>
    </div>
</div>
</form>



<script>
     var kategori = @JSON($kategori);
        document.getElementById('role_update').addEventListener('change', function() {
            var role = this.value;
            var kategoriDropdown = document.getElementById('kategori_update');
            kategoriDropdown.innerHTML = '';

            if (role === 'mahasiswa') {
                var option = document.createElement('option');
                option.text = 'Mahasiswa';
                kategoriDropdown.add(option);
            } else if (role === 'dosen') {
                var option_dosen = @JSON($kategori);
                var options = option_dosen;
                options.forEach(function(optionValue) {
                    var option = document.createElement('option');
                    option.text = optionValue;
                    kategoriDropdown.add(option);
                });
            } else if (role === 'admin') {
                var options = ['Super Admin'];
                options.forEach(function(optionValue) {
                    var option = document.createElement('option');
                    option.text = optionValue;
                    kategoriDropdown.add(option);
                });
            }
        });
</script>


@endsection