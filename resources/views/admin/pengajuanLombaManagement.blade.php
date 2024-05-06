{{-- @dd($kategori); --}}
@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Pengajuan Lomba Management</h5>
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
                            {{-- <div class="col-xl-9 col-md-12">
                                <div class="text-sm-end">
                                    <button type="button"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                        data-bs-toggle="modal" data-bs-target=".create-user"><i
                                            class="mdi mdi-plus me-1"></i> Create User</button>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-nowrap align-middle mb-0">
                            <thead>
                                <tr>
                                    <td style="width:5%">
                                        <p class="mb-0">No.</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Nama User Pengajuan</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Nama Ketua Kelompok</p>
                                    </td>

                                    <td>
                                        <p class="mb-0">Identitas Number Ketua</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Nama Lomba</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Kategori</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Status</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Action</p>
                                    </td>
                                </tr>


                            </thead>

                            <tbody>
                                @if ($pengajuan_jumlah->isNotEmpty())
                                @foreach ($pengajuan_jumlah as $item)
                                    <tr>
                                    <td style="width:5%">
                                        <p class="mb-0">{{ $loop->iteration }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $item->stored_by }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $item->nama_ketua }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $item->identitas_number_ketua }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $item->nama_lomba }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $item->kategori }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $item->status }}</p>
                                    </td>
                                    <td>
                                            <button type="button"
                                                class="btn btn-warning btn-rounded waves-effect waves-light mb-2 me-2"
                                                onclick="editUser({{ $item->id }})"><i class="bx bx-pencil"></i>
                                                Edit</button>
                                            <button type="button"
                                                class="btn btn-danger btn-rounded waves-effect waves-light mb-2 me-2"><i
                                                    class="bx bx-trash-alt"></i> Delete</button>
                                        </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8" class="text-center">Data Kosong</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
