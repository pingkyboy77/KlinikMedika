@extends('mahasiswa.layouts.app')
@section('content')
<style>
    thead td p{
        font-weight: bold;

    }
</style>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                                        <h5 class="card-title mb-0">Daftar Dosen Pembimbing</h5>
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
                        <table class="table table-nowrap align-middle mb-0" id="myTable">
                            <thead>
                                <tr>
                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Nama Dosen Pembimbing</h5>
                                    </td>
                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">NIDN</h5>
                                    </td>

                                    <td>
                                        <h5 class="text-dark font-size-14 m-0">Kategori</h5>
                                    </td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dospem as $item)
                                <tr>
                                    <td>
                                        <p class="mb-0">{{ $item->nama }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $item->identitas }}</p>
                                    </td>

                                    <td>
                                        <p class="mb-0">{{ $item->kategori }}</p>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
   <script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": [2] } // Menonaktifkan sorting pada kolom 1 dan 3
            ]
        });
    });
</script>
@endsection
