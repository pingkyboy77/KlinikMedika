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
                            {{-- <div class="col-xl-3 col-md-12">
                                <div class="pb-3 pb-xl-0">
                                    <form class="email-search">
                                        <div class="position-relative">
                                            <input type="text" class="form-control bg-light" placeholder="Search...">
                                            <span class="bx bx-search font-size-18"></span>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}
                            <div class="col-xl-9 col-md-12">
                                <div class="text-sm-end">
                                    {{-- <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".create-task"><i class="mdi mdi-plus me-1"></i> Create Task</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-nowrap align-middle mb-0" id="pengajuan-lomba">
                            <thead>
                                <tr>
                                    <th>
                                        <h5 class="text-truncate font-size-14 m-0">No.</h5>
                                    </th>
                                    <th>
                                        <h5 class="text-truncate font-size-14 m-0">Diajukan Oleh</h5>
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
                                        <p class="mb-0">Link Url Lomba</p>
                                    </th>
                                    <th>
                                        <p class="mb-0">Flyer Lomba</p>
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
                                                <p class="mb-0">{{ $loop->iteration }}</p>
                                            </td>
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
                                                <p class="mb-0">{{ $item->url }}</p>
                                            </td>
                                            <!-- Existing Image Display -->
                                            <td>
                                                <img src="{{ asset($item->image_flyer) }}" alt="" width="100%"
                                                    id="currentImage" style="cursor: pointer;">
                                            </td>
                                            <td>
                                                <a href="/{{ $item->file_proposal_pengajuan }}"
                                                    download="{{ substr($item->file_proposal_pengajuan, 23) }}">{{ substr($item->file_proposal_pengajuan, 23) }}</a>
                                            </td>
                                            @if ($item->status == 'diterima')
                                                <td class="ps-2 align-items-center ">
                                                    <p class="gap-2 align-items-center m-0 d-flex">
                                                        <i class="bx bx-check text-success fw-bold m-0 p-0"></i>accepted
                                                    </p>
                                                </td>
                                            @elseif ($item->status == 'ditolak')
                                                <td class="ps-2 align-items-center">
                                                    <p class="gap-2 align-items-center d-flex m-0">
                                                        <i class="bx bx-x text-danger fw-bold"></i>Decline
                                                    </p>
                                                </td>
                                            @else
                                                <td class=" gap-2">
                                                    <form
                                                        action="{{ route('dosen.updatepengajuan.lomba', ['id' => $item->id, 'status' => 'diterima']) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="d-flex align-items-center btn btn-success btn-rounded waves-effect waves-light">
                                                            <i class="bx bx-check fw-bold"></i> Accept</button>
                                                    </form>
                                                    <form
                                                        action="{{ route('dosen.updatepengajuan.lomba', ['id' => $item->id, 'status' => 'ditolak']) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="d-flex align-items-center btn btn-danger btn-rounded waves-effect waves-light">
                                                            <i class="bx bx-x fw-bold"></i> Decline</button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>



                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Modal for Image Preview -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagePreviewModalLabel">IMAGE FLYER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="imagePreviewModalImg" src="" alt="Image Preview"
                        style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        document.getElementById('currentImage').addEventListener('click', function() {
            var imgSrc = this.src;
            var modalImg = document.getElementById('imagePreviewModalImg');
            modalImg.src = imgSrc;
            var imagePreviewModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
            imagePreviewModal.show();
        });
        $(document).ready(function() {
            var dataTableExists = $.fn.DataTable.isDataTable('#pengajuan-lomba');
            if (dataTableExists) {
                $('#pengajuan-lomba').DataTable().destroy();
            }

            setTimeout(() => {

                $('#pengajuan-lomba').DataTable({
                    scrollCollapse: true,
                    responsive: true,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": [6]
                        } // Disable sorting for the third column (index 2)
                        // Add more entries as needed for other columns
                    ]
                });
            }, 100);
        });
    </script>
@endsection
