@extends('admin.layouts.app')
@section('content')
<style>
    .card-box:hover {
        background-color: #f0f0f0; /* Ubah warna abu-abu di sini */
    }
</style>
    <div class="row">

        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-4">
                    <a href="{{ route('admin.user-Management') }}">
                    <div class="card card-box">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-soft-primary">
                                            <i class="bx bx-user-circle font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 font-size-15">User Management</h6>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="mt-4 pt-1 mb-0 font-size-22">{{ $user_jumlah ?? '0' }} User<span
                                            class="text-success fw-medium font-size-13 align-middle"> </h4>
                                    <div class="d-flex mt-1 align-items-end overflow-hidden">
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-0 text-truncate">{{ date('Y-m-d H:i:s') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-4">
                    <a href="{{ route('admin.daftarPengajuanLomba') }}">
                    <div class="card card-box">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-soft-primary">
                                            <i class="bx bx-calendar-event font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 font-size-15">Daftar Pengajuan Lomba Management</h6>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="mt-4 pt-1 mb-0 font-size-22">{{ $pengajuan_jumlah }} Pengajuan<span
                                            class="text-success fw-medium font-size-13 align-middle"> </h4>
                                    <div class="d-flex mt-1 align-items-end overflow-hidden">
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-0 text-truncate">{{ date('Y-m-d H:i:s') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-4">
                    <a href="{{ route('admin.daftarPengajuanLomba') }}">
                    <div class="card card-box">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-soft-primary">
                                            <i class="bx bx-calendar-event font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 font-size-15">Daftar Pengajuan Bimbingan Management</h6>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="mt-4 pt-1 mb-0 font-size-22">{{ $jumlah_bimbingan }} Bimbingan<span
                                            class="text-success fw-medium font-size-13 align-middle"> </h4>
                                    <div class="d-flex mt-1 align-items-end overflow-hidden">
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-0 text-truncate">{{ date('Y-m-d H:i:s') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-4">
                    <a href="{{ route('admin.lomba-Management') }}">
                    <div class="card card-box">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-soft-primary">
                                            <i class="bx bx-line-chart font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 font-size-15">Perlombaan Management</h6>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="mt-4 pt-1 mb-0 font-size-22">{{ $lomba ?? '0' }} Perlombaan<span
                                            class="text-success fw-medium font-size-13 align-middle"> </h4>
                                    <div class="d-flex mt-1 align-items-end overflow-hidden">
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-0 text-truncate">{{ date('Y-m-d H:i:s') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-4">
                    <a href="{{ route('admin.kategori-Management') }}">
                    <div class="card card-box">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-soft-primary">
                                            <i class="bx bx-adjust font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 font-size-15">Kategori Management</h6>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="mt-4 pt-1 mb-0 font-size-22">{{ $kategori ?? '0' }} Kategori<span
                                            class="text-success fw-medium font-size-13 align-middle"> </h4>
                                    <div class="d-flex mt-1 align-items-end overflow-hidden">
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-0 text-truncate">{{ date('Y-m-d H:i:s') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
