@extends('admin.layouts.app')

@section('content')
{{-- <div class="container">
    <h1>Create User</h1> --}}

    <form action="{{ route('admin.user-Management.store') }}" method="POST">
        @csrf

        <div class="row card m-0 py-3">
            <div class="card-header">
                <h5>Create New User</h5>
            </div>

            <div class="row card-body">
                <!-- Nama -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Identitas -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="identitas">Identitas Number</label>
                        <input type="text" name="identitas" id="identitas" class="form-control @error('identitas') is-invalid @enderror" placeholder="Masukkan Identitas" value="{{ old('identitas') }}">
                        @error('identitas')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                             <div class="mb-3">
                                 <label class="form-label" for="email">E-mail</label>
                                 <input type="email" name="email" id="email"
                                     class="form-control @error('email') is-invalid @enderror" required
                                     value="{{ old('email') }}">

                                 @error('email')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                             </div>
                         </div>

                <!-- Password -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <!-- Password Checklist -->
                        <ul class="list-unstyled mt-2">
                            <li id="capital" class="text-danger"><i class="bx bx-x"></i> Mengandung huruf besar</li>
                            <li id="number" class="text-danger"><i class="bx bx-x"></i> Mengandung angka</li>
                            <li id="symbol" class="text-danger"><i class="bx bx-x"></i> Mengandung simbol (@$!%*#?&-+=)</li>
                            <li id="length" class="text-danger"><i class="bx bx-x"></i> Panjang 8-16 karakter</li>
                        </ul>
                    </div>
                </div>

                <!-- Role -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="role">Role</label>
                        <select class="form-select @error('role') is-invalid @enderror" name="role" id="role">
                            <option selected disabled>Pilih Role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="dokter" {{ old('role') == 'dokter' ? 'selected' : '' }}>Dokter</option>
                            <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                        </select>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="status">Status</label>
                       <select class="form-select @error('status') is-invalid @enderror" name="status" >
                            <option selected disabled>Pilih Status</option>
                            <option value="1" {{ old('1') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('0') == 'non active' ? 'selected' : '' }}>Non Active</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Tombol Submit -->
                <div class="col-12 text-end mt-3">
                    <a href="{{ route('admin.user-Management') }}" class="btn btn-danger me-2">
                        <i class="bx bx-x me-1 align-middle"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-success" id="submitBtn">
                        <i class="bx bx-check me-1 align-middle"></i> Confirm
                    </button>
                </div>
            </div>

        </div>
    </form>
{{-- </div> --}}
@endsection

@section('scripts')
<!-- Script password checklist sama seperti sebelumnya -->
<script>
    const passwordInput = document.getElementById('password');

    passwordInput.addEventListener('input', function() {
        const value = passwordInput.value;

        if (/[A-Z]/.test(value)) {
            document.getElementById('capital').classList.replace('text-danger', 'text-success');
            document.getElementById('capital').innerHTML = '<i class="bx bx-check"></i> Mengandung huruf besar';
        } else {
            document.getElementById('capital').classList.replace('text-success', 'text-danger');
            document.getElementById('capital').innerHTML = '<i class="bx bx-x"></i> Mengandung huruf besar';
        }

        if (/\d/.test(value)) {
            document.getElementById('number').classList.replace('text-danger', 'text-success');
            document.getElementById('number').innerHTML = '<i class="bx bx-check"></i> Mengandung angka';
        } else {
            document.getElementById('number').classList.replace('text-success', 'text-danger');
            document.getElementById('number').innerHTML = '<i class="bx bx-x"></i> Mengandung angka';
        }

        if (/[!@#$%^&*()_\-+=]/.test(value)) {
            document.getElementById('symbol').classList.replace('text-danger', 'text-success');
            document.getElementById('symbol').innerHTML = '<i class="bx bx-check"></i> Mengandung simbol (@$!%*#?&-+=)';
        } else {
            document.getElementById('symbol').classList.replace('text-success', 'text-danger');
            document.getElementById('symbol').innerHTML = '<i class="bx bx-x"></i> Mengandung simbol (@$!%*#?&-+=)';
        }

        if (value.length >= 8 && value.length <= 16) {
            document.getElementById('length').classList.replace('text-danger', 'text-success');
            document.getElementById('length').innerHTML = '<i class="bx bx-check"></i> Panjang 8-16 karakter';
        } else {
            document.getElementById('length').classList.replace('text-success', 'text-danger');
            document.getElementById('length').innerHTML = '<i class="bx bx-x"></i> Panjang 8-16 karakter';
        }

        validatePassword();
    });

    function validatePassword() {
        const value = passwordInput.value;
        const hasCapital = /[A-Z]/.test(value);
        const hasNumber = /\d/.test(value);
        const hasSymbol = /[@$!%*#?&_\-+=]/.test(value);
        const lengthValid = value.length >= 8 && value.length <= 16;

        document.getElementById('submitBtn').disabled = !(hasCapital && hasNumber && hasSymbol && lengthValid);
    }
</script>
@endsection
