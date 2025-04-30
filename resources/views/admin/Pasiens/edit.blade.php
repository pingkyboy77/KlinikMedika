@extends('admin.layouts.app')

@section('title', 'Edit Pasien')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Pasien</h3>
                </div>
                <form action="{{ route('staff.pasiens.update', $pasien->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No Registrasi</label>
                                <input type="text" name="registration_number" class="form-control" value="{{ $pasien->registration_number }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>No Identitas <span class="text-danger">*</span></label>
                                <input type="text" name="identity_number" class="form-control @error('identity_number') is-invalid @enderror" value="{{ old('identity_number', $pasien->identity_number) }}" required>
                                @error('identity_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>No Asuransi</label>
                                <input type="text" name="insurance_number" class="form-control @error('insurance_number') is-invalid @enderror" value="{{ old('insurance_number', $pasien->insurance_number) }}">
                                @error('insurance_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Nama Pasien <span class="text-danger">*</span></label>
                                <input type="text" name="PasienName" class="form-control @error('PasienName') is-invalid @enderror" value="{{ old('PasienName', $pasien->PasienName) }}" required>
                                @error('PasienName') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir', $pasien->tgl_lahir) }}">
                                @error('tgl_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $pasien->email) }}" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="text" name="telp" class="form-control @error('telp') is-invalid @enderror" value="{{ old('telp', $pasien->telp) }}">
                                @error('telp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Alergi</label>
                                <textarea name="allergy" class="form-control @error('allergy') is-invalid @enderror">{{ old('allergy', $pasien->allergy) }}</textarea>
                                @error('allergy') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- Region --}}
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select name="id_prov" id="id_prov" class="form-control">
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach($provinsi as $prov)
                                        <option value="{{ $prov->id }}" {{ old('id_prov', $pasien->id_prov) == $prov->id ? 'selected' : '' }}>
                                            {{ $prov->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Kabupaten/Kota</label>
                                <select name="id_kab" id="id_kab" class="form-control">
                                    <option value="">-- Pilih Kabupaten/Kota --</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select name="id_kec" id="id_kec" class="form-control">
                                    <option value="">-- Pilih Kecamatan --</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Desa/Kelurahan</label>
                                <select name="id_des" id="id_des" class="form-control">
                                    <option value="">-- Pilih Desa --</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $pasien->alamat) }}</textarea>
                                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <a href="{{ route('staff.pasiens.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-warning">Update</button>
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
        const selectedKab = '{{ old('id_kab', $pasien->id_kab) }}';
        const selectedKec = '{{ old('id_kec', $pasien->id_kec) }}';
        const selectedDes = '{{ old('id_des', $pasien->id_des) }}';

        function loadKab(provID, callback) {
            if (provID) {
                $.get(`/staff/pasiens/get-kabupaten/${provID}`, function (data) {
                    let html = '<option>-- Pilih Kabupaten/Kota --</option>';
                    $.each(data, function (i, kab) {
                        const selected = (kab.id == selectedKab) ? 'selected' : '';
                        html += `<option value="${kab.id}" ${selected}>${kab.name}</option>`;
                    });
                    $('#id_kab').html(html).prop('disabled', false);
                    if (callback) callback();
                });
            }
        }

        function loadKec(kabID, callback) {
            if (kabID) {
                $.get(`/staff/pasiens/get-kecamatan/${kabID}`, function (data) {
                    let html = '<option>-- Pilih Kecamatan --</option>';
                    $.each(data, function (i, kec) {
                        const selected = (kec.id == selectedKec) ? 'selected' : '';
                        html += `<option value="${kec.id}" ${selected}>${kec.name}</option>`;
                    });
                    $('#id_kec').html(html).prop('disabled', false);
                    if (callback) callback();
                });
            }
        }

        function loadDes(kecID) {
            if (kecID) {
                $.get(`/staff/pasiens/get-desa/${kecID}`, function (data) {
                    let html = '<option>-- Pilih Desa --</option>';
                    $.each(data, function (i, des) {
                        const selected = (des.id == selectedDes) ? 'selected' : '';
                        html += `<option value="${des.id}" ${selected}>${des.name}</option>`;
                    });
                    $('#id_des').html(html).prop('disabled', false);
                });
            }
        }

        // On Load: populate dependent selects
        const provInit = $('#id_prov').val();
        if (provInit) {
            loadKab(provInit, function () {
                loadKec(selectedKab, function () {
                    loadDes(selectedKec);
                });
            });
        }

        $('#id_prov').change(function () {
            const provID = $(this).val();
            $('#id_kab, #id_kec, #id_des').html('<option>-- Pilih --</option>').prop('disabled', true);
            loadKab(provID);
        });

        $('#id_kab').change(function () {
            const kabID = $(this).val();
            $('#id_kec, #id_des').html('<option>-- Pilih --</option>').prop('disabled', true);
            loadKec(kabID);
        });

        $('#id_kec').change(function () {
            const kecID = $(this).val();
            $('#id_des').html('<option>-- Pilih --</option>').prop('disabled', true);
            loadDes(kecID);
        });
    });
</script>
@endsection
