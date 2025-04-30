@extends('admin.layouts.app')

@section('title', 'Generate Tindakan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Generate Tindakan</h3>
                </div>
                <form action="{{ route('staff.pasiens.generate-visit.store') }}" method="POST">
                    @csrf
                    <div class="card-body row">
                        <div class="col-md-6">
                            {{-- Pasien (readonly) --}}
                            <div class="form-group mb-2">
                                <label>Pasien</label>
                                <input type="text" class="form-control" value="{{ $pasien->PasienName }}" readonly>
                                <input type="hidden" name="pasien_id" value="{{ $pasien->id }}">
                            </div>

                            {{-- Pilih Dokter --}}
                            <div class="form-group mb-2">
                                <label>Choose Doctor <span class="text-danger">*</span></label>
                                <select name="doctor_id" class="form-control @error('doctor_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Dokter --</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->nama }}</option>
                                    @endforeach
                                </select>
                                @error('doctor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- Pilih Layanan --}}
                            <div class="form-group mb-2">
                                <label>Choose Service <span class="text-danger">*</span></label>
                                <select name="service_id" class="form-control @error('service_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Layanan --</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->ServiceName }}</option>
                                    @endforeach
                                </select>
                                @error('service_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('staff.pasiens.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
