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
            <select class="form-select" name="role" id="role" >
                <option selected disabled>Role Sebelumnya - {{ isset($user) ? $user->role : old('role') }}</option>
                <option value="Admin">Admin</option>
                <option value="Mahasiswa">Mahasiswa</option>
                <option value="Dosen">Dosen</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="CreateTask-Category">Kategori</label>
            <select class="form-select" name="kategori" id="kategori">
                <option selected disabled> Select Category </option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label" for="CreateTask-Category">Status</label>
            <select class="form-select" name="status">
                <option selected> Status Sebelumnya - {{ isset($user) ? $user->status : old('status') }}</option>
                <option>Active</option>
                <option>Non Active</option>
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
   document.getElementById('role').addEventListener('change', function() {
       var role = this.value;
       var kategoriDropdown = document.getElementById('kategori');
       kategoriDropdown.innerHTML = '';

       if (role === 'Mahasiswa') {
           var option = document.createElement('option');
           option.text = 'Mahasiswa';
           kategoriDropdown.add(option);
       } else if (role === 'Dosen') {
           var options = ['UI/UX', 'Jaringan', 'Website'];
           options.forEach(function(optionValue) {
               var option = document.createElement('option');
               option.text = optionValue;
               kategoriDropdown.add(option);
           });
       } else if (role === 'Admin') {
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