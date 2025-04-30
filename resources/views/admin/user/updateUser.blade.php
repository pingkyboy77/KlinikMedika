@extends('admin.layouts.app')

@section('content')
    <form action="{{ url('/admin/update-User/' . $user->id) . '/edit' }}" method="POST">
        @csrf
        <div class="row card m-0 py-3">
            <div class="card-header">
                <h5>Update User</h5>
            </div>

            <div class="row card-body">

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Task-Name">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Enter Task Name"
                            value="{{ isset($user) ? $user->nama : old('nama') }}" id="CreateTask-Task-Name" readonly>
                            @if ($errors->has('nama'))
                            <div class="text-danger">{{ $errors->first('nama') }}</div>
                        @endif
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Task-Name">Identitas Number</label>
                        <input type="text" name="identitas" class="form-control"
                            value="{{ isset($user) ? $user->identitas : old('identitas') }}" placeholder="Enter Task Name"
                            id="CreateTask-Task-Name" readonly>
                            @if ($errors->has('identitas'))
                            <div class="text-danger">{{ $errors->first('identitas') }}</div>
                        @endif
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Task-Name">E-mail</label>
                        <input type="text" name="email" class="form-control"
                            value="{{ isset($user) ? $user->email : old('email') }}" placeholder="Enter Task Name"
                            id="CreateTask-Task-Name" readonly>
                            @if ($errors->has('email'))
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="CreateTask-Category">Role</label>
                    <select class="form-select" name="role" id="role_update">
                        {{-- <option selected disabled>Role Sebelumnya - {{ isset($user) ? $user->role : old('role') }}
                    </option> --}}
                        <option value="admin" @if (isset($user) && $user->role == 'admin') selected @endif>Admin</option>
                        <option value="staff" @if (isset($user) && $user->role == 'staff') selected @endif>Staff</option>
                        <option value="dokter" @if (isset($user) && $user->role == 'dokter') selected @endif>Dokter</option>
                        <option value="Kasir" @if (isset($user) && $user->role == 'Kasir') selected @endif>Kasir</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="CreateTask-Category">Status</label>
                    <select class="form-select" name="status">
                        {{-- <option selected> Status Sebelumnya - {{ isset($user) ? $user->status : old('status') }}
                    </option> --}}
                        <option value="1" @if (isset($user) && $user->status == '1') selected @endif>Active</option>
                        <option value="0" @if (isset($user) && $user->status == '0') selected @endif>Non Active</option>
                    </select>
                </div>
            </div>
            <div class="col-12 text-end mt-3">
                <a href="#" onclick="history.back();">
                    <button type="button" class="btn btn-danger me-1">
                        <i class="bx bx-x me-1 align-middle"></i> Cancel
                    </button>
                </a>
                <button type="submit" class="btn btn-success" data-bs-toggle="modal"><i
                        class="bx bx-check me-1 align-middle"></i> Confirm</button>
            </div>
        </div>

        </div>
    </form>




@endsection
