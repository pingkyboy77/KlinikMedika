@extends('dosen.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                                        <h5 class="card-title mb-0">Daftar Pengajuan Bimbingan Lomba</h5>
                                    </div>
                <div class="card-body">

                    <div class="">
                        <div class="row mb-2">
                            <div class="col-xl-3 col-md-12">
                                <div class="pb-3 pb-xl-0">
                                    <form class="email-search">
                                        <div class="position-relative">
                                            <input type="text" class="form-control bg-light" placeholder="Search...">
                                            <span class="bx bx-search font-size-18"></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xl-9 col-md-12">
                                <div class="text-sm-end">
                                    {{-- <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".create-task"><i class="mdi mdi-plus me-1"></i> Create Task</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-nowrap align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th>
                                        <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                class="text-dark">Nama Mahasiswa</a></h5>
                                    </th>
                                    <th>
                                        <p class="mb-0">Nama Perlombaan</p>
                                    </th>
                                    <th>
                                        <p class="mb-0">Kategori</p>
                                    </th>
                                    <th>
                                        <p class="mb-0">Tanggal</p>
                                    </th>
                                    <th>
                                        <p class="mb-0">Action</p>
                                    </th>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="mb-0">Arwaa Althifal Suhermanja</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Lomba UI/UX</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">UI/UX</p>
                                    </td>

                                    <td>
                                        <p class="mb-0">20-07-2024</p>
                                    </td>
                                    <td class="d-flex gap-2 ps-2">
                                            <button type="button" class="d-flex align-items-center btn btn-success btn-rounded waves-effect waves-light" >
                                                <i class="bx bx-check fw-bold"></i> Accept</button>
                                                <button type="button" class="d-flex align-items-center btn btn-danger btn-rounded waves-effect waves-light" >
                                                    <i class="bx bx-x fw-bold"></i> Decline</button>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
