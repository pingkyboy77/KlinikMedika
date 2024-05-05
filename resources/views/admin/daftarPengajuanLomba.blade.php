@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                                        <h5 class="card-title mb-0">Daftar Pengajuan</h5>
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
                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Nama Perlombaan</h5>
                                    </td>
                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Kategori</h5>
                                    </td>

                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Nama Ketua</h5>
                                    </td>

                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Nama Dosen</h5>
                                    </td>

                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Jenis Pengajuan</h5>
                                    </td>

                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Action</h5>
                                    </td>
                                </tr>
                                

                                <tr>
                                    <td>
                                        <p class="mb-0">Hackathon UI/UX</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">UI/UX</p>
                                    </td>

                                    <td>
                                        <p class="mb-0">Arwaa Althifal</p>
                                    </td>

                                    <td>
                                        <p class="mb-0">Rehan Fadillah, S.kom, M.Kom</p>
                                    </td>

                                    <td>
                                        <p class="mb-0">Pengajuan Lomba</p>
                                    </td>

                                    <td class="ps-2">
                                        <button type="button" class="btn btn-success btn-rounded waves-effect waves-light me-2" ><i class="bx bx-edit-alt"></i> Edit</button>
                                        <button type="button" class="btn btn-danger btn-rounded waves-effect waves-light me-2" ><i class="bx bx-trash-alt"></i> Delete</button>
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
