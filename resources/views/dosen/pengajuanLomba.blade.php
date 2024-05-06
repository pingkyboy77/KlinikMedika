@extends('dosen.layouts.app')
@section('content')
    {{-- style --}}
    <style>
        thead td p {
            font-weight: bold;

        }
    </style>
    {{-- end stly --}}
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
                            <thead>
                                <tr>
                                    <th>
                                        <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                class="text-dark">Mahasiswa Akun Pengajuan</a></h5>
                                    </th>
                                    <th>
                                        <p class="mb-0">Nama Ketua Kelompok</p>
                                    </th>
                                    <th>
                                        <p class="mb-0">Nama Perlombaan</p>
                                    </th>
                                    <th>
                                        <p class="mb-0">Kategori</p>
                                    </th>
                                    <th>
                                        <p class="mb-0">Tanggal Pengajuan</p>
                                    </th>
                                    <th>
                                        <p class="mb-0">File Proposal</p>
                                    </th>
                                    <th>
                                        <p class="mb-0">Action</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($daftar_lomba_pengajuan->isNotEmpty())
                                @foreach ($daftar_lomba_pengajuan as $item)
                                    <tr>
                                        <td>
                                            <p class="mb-0">{{ $item->stored_by }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $item->nama_ketua }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $item->nama_lomba }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $item->kategori }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $item->created_at }}</p>
                                        </td>
                                        <td>
                                            <a href="/{{ $item->file_proposal_pengajuan }}" download="{{ substr($item->file_proposal_pengajuan, 23) }}">{{ substr($item->file_proposal_pengajuan, 23) }}</a>
                                        </td>
                                        @if ($item->status == 'diterima')
                                            <td class="d-flex ps-2 align-items-center">
                                                <p class="d-flex gap-2 align-items-center m-0">
                                                    <i class="bx bx-check text-success fw-bold"></i>accepted
                                                </p>
                                            </td>
                                        @elseif ($item->status == 'ditolak')
                                            <td class="d-flex ps-2 align-items-center">
                                                <p class="d-flex gap-2 align-items-center m-0">
                                                    <i class="bx bx-x text-danger fw-bold"></i>Decline
                                                </p>
                                            </td>
                                        @else
                                        <td class=" d-flex gap-2">
                                            <button type="button"
                                                class="d-flex align-items-center btn btn-success btn-rounded waves-effect waves-light">
                                                <i class="bx bx-check fw-bold"></i> Accept</button>
                                            <button type="button"
                                                class="d-flex align-items-center btn btn-danger btn-rounded waves-effect waves-light">
                                                <i class="bx bx-x fw-bold"></i> Decline</button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">
                                            <div class="text-center">
                                                <p class="text-muted font-italic">Tidak Ada Pengajuan Bimbingan Perlombaan</p>
                                            </div>
                                        </td>
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
