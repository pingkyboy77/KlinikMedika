@extends('admin.layouts.app')
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
                    <h5 class="card-title mb-0">Perlombaan Management</h5>
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
                            {{-- <div class="text-sm-end">
                                <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                    onclick="openModal()"><i class="mdi mdi-plus me-1"></i> Create Lomba</button>
                            </div> --}}
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="myTable" class="table table-nowrap align-middle mb-0">
                            <thead>
                                <tr>
                                    <td class=" d-flex justify-content-center">
                                        <h5 class="text-truncate font-size-14 m-0">No</h5>
                                    </td>
                                    <td>
                                        <p class="mb-0">Nama Perlombaan</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Kategori</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Lokasi</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Tanggal</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Action</p>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lomba->isNotEmpty())
                                    @foreach ($lomba as $item)
                                        <tr>
                                            <td class="d-flex justify-content-center">
                                                <p class="mb-0">{{ $item->id }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->nama_lomba }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->kategori }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->lokasi }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->tanggal }}</p>
                                            </td>
                                            <td class="d-flex">
                                                <a class="btn btn-warning me-2"
                                                    href="{{ url('/admin/update-Lomba/' . $item->id) . '/edit' }}"><i
                                                        class="bx bx-pencil"></i>Edit</a>
                                                <form action="{{ url('/admin/lomba-Management/' . $item->id) }}"
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-delete"><i
                                                            class="bx bx-trash-alt"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Data Kosong</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

    

    


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    var form = this.parentElement;
                    var url = form.getAttribute('action');

                    Swal.fire({
                        title: 'Apakah anda yakin menghapus data?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
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
                            "targets": [5]
                        } // Disable sorting for the third column (index 2)
                        // Add more entries as needed for other columns
                    ]
                });
            }, 100);
        });
    </script>
@endsection
