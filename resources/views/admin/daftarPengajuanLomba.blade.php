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
                                {{-- <div class="pb-3 pb-xl-0">
                                    <form class="email-search">
                                        <div class="position-relative">
                                            <input type="text" class="form-control bg-light" placeholder="Search...">
                                            <span class="bx bx-search font-size-18"></span>
                                        </div>
                                    </form>
                                </div> --}}
                            </div>
                            <div class="col-xl-9 col-md-12">
                                <div class="text-sm-end">
                                    {{-- <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".create-task"><i class="mdi mdi-plus me-1"></i> Create Task</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-nowrap align-middle mb-0" id="myTable">
                            <thead>
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
                            </thead>

                            <tbody>  
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
