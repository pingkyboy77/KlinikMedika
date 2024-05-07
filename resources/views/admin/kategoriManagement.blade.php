@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="card-title mb-0 fw-bold">Kategori Management</h5>
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
                        <!-- Button untuk membuka modal -->
                        <div class="text-sm-end">
                            <button type="button" class="btn btn-success btn-rounded waves-effect waves-light"
                                onclick="openModal()"><i class="mdi mdi-plus me-1"></i> Create Kategori</button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-nowrap align-middle mb-0 table-borderless" id="myTable">
                        <thead>
                            <tr>
                                <td class=" d-flex justify-content-start">
                                    <h5 class="text-truncate font-size-14 m-0">No</h5>
                                </td>
                                <td>
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                            class="text-dark">Kategori</a></h5>
                                </td>
                                <td>
                                    Action
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $item)
                            <tr>
                                <td class=" d-flex justify-content-start">
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                            class="text-dark">{{ $loop->iteration }}</a></h5>
                                </td>
                                <td>
                                    <p class="mb-0">{{ $item->kategori }}</p>
                                </td>
                                <td class="d-flex">
                                    {{-- <button type="button" class="btn btn-warning waves-effect waves-light mb-2 me-2" onclick="openEditModal('{{ $item->id }}', '{{ $item->kategori }}')"><i class="bx bx-pencil"></i> Update</button> --}}
                                    <a class="btn btn-warning me-2"
                                        href="{{ route('admin.update-Kategori', ['id' => $item->id]) }}"><i
                                            class="bx bx-pencil"></i>Edit</a>
                                    <form action="{{ route('admin.kategori.delete', ['id' => $item->id]) }}"
                                        method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-delete"><i
                                                class="bx bx-trash-alt"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                        
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<form action="{{ route('admin.kategori-Management.store') }}" method="POST">
    @csrf
    <div class="modal fade create-kategori" tabindex="-1" role="dialog" aria-labelledby="modal_kategori"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_kategori">Create User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi formulir modal -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="kategori">Nama Kategori</label>
                                <input type="text" name="kategori" class="form-control" placeholder="Enter Name"
                                    id="kategori">
                            </div>
                        </div>
                        <!-- Tambahkan input lainnya di sini -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                    class="bx bx-x me-1 align-middle"></i> Cancel</button>
                            <button type="submit" class="btn btn-success"><i class="bx bx-check me-1 align-middle"></i>
                                Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
</form>

<script>
    function openModal() {
        var modal = document.querySelector('.create-kategori');
        var modalBootstrap = new bootstrap.Modal(modal);
        modalBootstrap.show();
    }

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
   <script>
    $(document).ready(function() {
            var dataTableExists = $.fn.DataTable.isDataTable('#myTable');
            if (dataTableExists) {
                $('#myTable').DataTable().destroy();
            }

            setTimeout(() => {

                $('#myTable').DataTable({
                    scrollCollapse: true,
                    responsive: true,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": [2]
                        } // Disable sorting for the third column (index 2)
                        // Add more entries as needed for other columns
                    ]
                });
            }, 100);
        });
</script>

@endsection
