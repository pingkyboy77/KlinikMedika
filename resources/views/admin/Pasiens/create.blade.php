@extends('admin.layouts.app')

@section('title', 'Tambah Pasien')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Pasien</h3>
                </div>
                <form action="{{ route('staff.pasiens.store') }}" method="POST">
                    @csrf
                    <div class="card-body row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
    <label>No Registrasi</label>
    <input type="text" name="registration_number" class="form-control" value="{{ $registrationNumber }}" readonly>
</div>


                            <div class="form-group mb-2">
                                <label>No Identitas <span class="text-danger">*</span></label>
                                <input type="text" name="identity_number" class="form-control @error('identity_number') is-invalid @enderror" value="{{ old('identity_number') }}" required>
                                @error('identity_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label>No Asuransi</label>
                                <input type="text" name="insurance_number" class="form-control @error('insurance_number') is-invalid @enderror" value="{{ old('insurance_number') }}">
                                @error('insurance_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label>Nama Pasien <span class="text-danger">*</span></label>
                                <input type="text" name="PasienName" class="form-control @error('PasienName') is-invalid @enderror" value="{{ old('PasienName') }}" required>
                                @error('PasienName') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}">
                                @error('tgl_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label>Telepon</label>
                                <input type="text" name="telp" class="form-control @error('telp') is-invalid @enderror" value="{{ old('telp') }}">
                                @error('telp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label>Alergi</label>
                                <textarea name="allergy" class="form-control @error('allergy') is-invalid @enderror">{{ old('allergy') }}</textarea>
                                @error('allergy') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- Region --}}
                            <div class="form-group mb-2">
                                <label>Provinsi</label>
                                <select name="id_prov" id="id_prov" class="form-control">
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach($provinsi as $prov)
                                        <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label>Kabupaten/Kota</label>
                                <select name="id_kab" id="id_kab" class="form-control" disabled>
                                    <option value="">-- Pilih Kabupaten/Kota --</option>
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label>Kecamatan</label>
                                <select name="id_kec" id="id_kec" class="form-control" disabled>
                                    <option value="">-- Pilih Kecamatan --</option>
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label>Desa/Kelurahan</label>
                                <select name="id_des" id="id_des" class="form-control" disabled>
                                    <option value="">-- Pilih Desa --</option>
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <a href="{{ route('staff.pasiens.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
        $('#id_prov').change(function () {
            const provID = $(this).val();
            $('#id_kab').html('<option>Loading...</option>').prop('disabled', true);
            $('#id_kec, #id_des').html('<option>-- Pilih --</option>').prop('disabled', true);

            if (provID) {
                $.get(`/staff/pasiens/get-kabupaten/${provID}`, function (data) {
                    let html = '<option>-- Pilih Kabupaten/Kota --</option>';
                    $.each(data, function (i, kab) {
                        html += `<option value="${kab.id}">${kab.name}</option>`;
                    });
                    $('#id_kab').html(html).prop('disabled', false);
                });
            }
        });

        $('#id_kab').change(function () {
            const kabID = $(this).val();
            $('#id_kec').html('<option>Loading...</option>').prop('disabled', true);
            $('#id_des').html('<option>-- Pilih Desa --</option>').prop('disabled', true);

            if (kabID) {
                $.get(`/staff/pasiens/get-kecamatan/${kabID}`, function (data) {
                    let html = '<option>-- Pilih Kecamatan --</option>';
                    $.each(data, function (i, kec) {
                        html += `<option value="${kec.id}">${kec.name}</option>`;
                    });
                    $('#id_kec').html(html).prop('disabled', false);
                });
            }
        });

        $('#id_kec').change(function () {
            const kecID = $(this).val();
            $('#id_des').html('<option>Loading...</option>').prop('disabled', true);

            if (kecID) {
                $.get(`/staff/pasiens/get-desa/${kecID}`, function (data) {
                    let html = '<option>-- Pilih Desa --</option>';
                    $.each(data, function (i, desa) {
                        html += `<option value="${desa.id}">${desa.name}</option>`;
                    });
                    $('#id_des').html(html).prop('disabled', false);
                });
            }
        });
    });
</script>
@endsection
