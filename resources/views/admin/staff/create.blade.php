@extends('admin.layouts.app')

@section('title', 'Add New Staff')

@section('content')
    <div class="container-fluid m-0 p-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Staff Form</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    {{-- Basic Info --}}
                                    <div class="form-group">
                                        <label for="name">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control mb-2 @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="StaffID">Staff ID <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control mb-2 @error('StaffID') is-invalid @enderror" id="StaffID"
                                            name="StaffID" value="{{ old('StaffID') }}" required>
                                        @error('StaffID')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control mb-2 @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="telp">Phone Number</label>
                                        <input type="text" class="form-control mb-2 @error('telp') is-invalid @enderror"
                                            id="telp" name="telp" value="{{ old('telp') }}">
                                        @error('telp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_lahir">Date of Birth</label>
                                        <input type="date"
                                            class="form-control mb-2 @error('tgl_lahir') is-invalid @enderror"
                                            id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                                        @error('tgl_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jabatan">Job Position <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control mb-2 @error('jabatan') is-invalid @enderror" id="jabatan"
                                            name="jabatan" value="{{ old('jabatan') }}" required>
                                        @error('jabatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="foto">Profile Picture <span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('foto') is-invalid @enderror" id="foto"
                                                name="foto" accept="image/*" required>
                                            <label class="custom-file-label" for="foto">Choose file</label>
                                        </div>
                                        <small class="form-text text-muted">Format: JPG, JPEG, PNG. Max size: 2MB.</small>
                                        @error('foto')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror

                                        <div class="mt-3">
                                            <img id="foto-preview" src="#" alt="Image Preview" class="img-thumbnail"
                                                style="display:none; max-height: 200px;">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    {{-- Location Fields --}}
                                    <div class="form-group">
                                        <label for="id_prov">Province <span class="text-danger">*</span></label>
                                        <select class="form-control mb-2" id="id_prov" name="id_prov" required>
                                            <option value="">-- Select Province --</option>
                                            @foreach ($provinsi as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="id_kab">City/Regency</label>
                                        <select class="form-control mb-2" id="id_kab" name="id_kab" disabled>
                                            <option value="">-- Select City/Regency --</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="id_kec">District</label>
                                        <select class="form-control mb-2" id="id_kec" name="id_kec" disabled>
                                            <option value="">-- Select District --</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="id_des">Village</label>
                                        <select class="form-control mb-2" id="id_des" name="id_des" disabled>
                                            <option value="">-- Select Village --</option>
                                        </select>
                                    </div>

                                    {{-- Address & Others --}}
                                    <div class="form-group">
                                        <label for="alamat">Address</label>
                                        <textarea class="form-control mb-2 @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                            rows="4">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_masuk">Join Date</label>
                                        <input type="date"
                                            class="form-control mb-2 @error('tgl_masuk') is-invalid @enderror"
                                            id="tgl_masuk" name="tgl_masuk"
                                            value="{{ old('tgl_masuk', date('Y-m-d')) }}">
                                        @error('tgl_masuk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_keluar">Left Date</label>
                                        <input type="date"
                                            class="form-control mb-2 @error('tgl_keluar') is-invalid @enderror"
                                            id="tgl_keluar" name="tgl_keluar" value="{{ old('tgl_keluar') }}">
                                        @error('tgl_keluar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text"
                                            class="form-control mb-2 @error('status') is-invalid @enderror"
                                            id="status_label" value="{{ old('status') === '0' ? 'Inactive' : 'Active' }}"
                                            readonly>

                                        <input type="hidden" name="status" id="status2"
                                            value="{{ old('status', '1') }}">

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                </div>
                            </div>

                            {{-- Form Buttons --}}
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary ml-2">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();

            $('#foto').on('change', function (e) {
    const input = this;
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            $('#foto-preview')
                .attr('src', e.target.result)
                .show();
        }

        reader.readAsDataURL(input.files[0]);
    }
});
            $('#tgl_keluar').change(function() {
                const leftDate = $(this).val();

                if (leftDate) {
                    $('#status2').val('0');
                    $('#status_label').val('Inactive');
                } else {
                    $('#status2').val('1');
                    $('#status_label').val('Active');
                }
            });



            $('#id_prov').change(function() {
                let id = $(this).val();
                $('#id_kab').html('<option>-- Loading --</option>').prop('disabled', true);
                $('#id_kec').html('<option>-- Select District --</option>').prop('disabled', true);
                $('#id_des').html('<option>-- Select Village --</option>').prop('disabled', true);

                if (id) {
                    $.get("/admin/staff/get-kabupaten/" + id, function(data) {
                        let options = '<option>-- Select City/Regency --</option>';
                        $.each(data, function(i, item) {
                            options += `<option value="${item.id}">${item.name}</option>`;
                        });
                        $('#id_kab').html(options).prop('disabled', false);
                    });
                }
            });

            $('#id_kab').change(function() {
                let id = $(this).val();
                $('#id_kec').html('<option>-- Loading --</option>').prop('disabled', true);
                $('#id_des').html('<option>-- Select Village --</option>').prop('disabled', true);

                if (id) {
                    $.get("/admin/staff/get-kecamatan/" + id, function(data) {
                        let options = '<option>-- Select District --</option>';
                        $.each(data, function(i, item) {
                            options += `<option value="${item.id}">${item.name}</option>`;
                        });
                        $('#id_kec').html(options).prop('disabled', false);
                    });
                }
            });

            $('#id_kec').change(function() {
                let id = $(this).val();
                $('#id_des').html('<option>-- Loading --</option>').prop('disabled', true);

                if (id) {
                    $.get("/admin/staff/get-desa/" + id, function(data) {
                        let options = '<option>-- Select Village --</option>';
                        $.each(data, function(i, item) {
                            options += `<option value="${item.id}">${item.name}</option>`;
                        });
                        $('#id_des').html(options).prop('disabled', false);
                    });
                }
            });
        });
    </script>
@endsection
