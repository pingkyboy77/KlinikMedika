@extends('admin.layouts.app')

@section('title', 'Staff Details')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex  justify-content-end align-items-center">
            <div class="col-6 d-flex justify-content-start align-items-center">
                <h3 class="card-title">Staff Details</h3>
            </div>
        <div class="col-6 d-flex justify-content-end align-items-center">
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">Back</a>
                </div></div>
        <div class="card-body row">
            <div class="col-md-4 text-center">
                <img src="{{ asset('storage/staff/' . $staff->foto) }}" alt="Photo" class="img-thumbnail mb-3" style="max-width: 250px;">
                <h4>{{ $staff->name }}</h4>
                <p><strong>{{ $staff->jabatan }}</strong></p>
            </div>
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr><th>Staff ID</th><td>{{ $staff->StaffID }}</td></tr>
                    <tr><th>Email</th><td>{{ $staff->email }}</td></tr>
                    <tr><th>Phone</th><td>{{ $staff->telp }}</td></tr>
                    <tr><th>Date of Birth</th><td>{{ $staff->tgl_lahir }} ({{ \Carbon\Carbon::parse($staff->tgl_lahir)->age }} years old)</td></tr>
                    <tr><th>Join Date</th><td>{{ $staff->tgl_masuk }}</td></tr>
                    <tr><th>Left Date</th><td>{{ $staff->tgl_keluar ?? '-' }}</td></tr>
                    <tr>
                        <th>Length of Service</th>
                        <td>
                            @php
                                $join = \Carbon\Carbon::parse($staff->tgl_masuk);
                                $end = $staff->tgl_keluar ? \Carbon\Carbon::parse($staff->tgl_keluar) : now();
                                $diff = $join->diff($end);
                            @endphp
                            {{ $diff->y }} years, {{ $diff->m }} months, {{ $diff->d }} days
                        </td>
                    </tr>
                    <tr><th>Status</th><td>{{ $staff->status == 1 ? 'Active' : 'Inactive' }}</td></tr>
                    <tr><th>Address</th><td>{{ $staff->alamat }}</td></tr>
                    <tr><th>Province</th><td>{{ $staff->provinsi->name ?? '-' }}</td></tr>
                    <tr><th>City/Regency</th><td>{{ $staff->kabupaten->name ?? '-' }}</td></tr>
                    <tr><th>District</th><td>{{ $staff->kecamatan->name ?? '-' }}</td></tr>
                    <tr><th>Village</th><td>{{ $staff->desa->name ?? '-' }}</td></tr>
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection
