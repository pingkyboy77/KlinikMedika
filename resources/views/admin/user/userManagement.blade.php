{{-- @dd($data_users); --}}
@extends('admin.layouts.app')
@section('content')
    {{-- <style>
    #myTable tbody td {
    height: 50px; /* Atur tinggi sel sesuai kebutuhan */
} --}}
    </style>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-6">
                            <h5 class="card-title mb-0">User Management</h5>
                        </div>

                        <div class="col-xl-6 col-md-6 col-6">
                            <div class="text-sm-end d-flex justify-content-end align-items-center">
                                <a href="{{ url('/admin/create-User/') }}">
                                    <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light"
                                        data-bs-toggle="modal" data-bs-target=".create-user"><i
                                            class="mdi mdi-plus me-1"></i>
                                        Create User</button></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label for="filterRole" class="form-label">Filter</label>
                        <div class="col-md-6">
                            <select id="filterRole" class="form-select">
                                <option value="">-- All Role --</option>
                                <option value="admin">Admin</option>
                                <option value="staff">Staff</option>
                                <option value="dokter">Dokter</option>
                                <option value="kasir">Kasir</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <select id="filterStatus" class="form-select">
                                <option value="">-- All Status --</option>
                                <option value="1">Active</option>
                                <option value="0">Non Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive mb-5">
                        <table class="table table-nowrap align-middle mb-0" id="myTable">
                            <thead class="fw-bold">
                                <tr>
                                    <td>
                                        <p class="mb-0">No</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Name</p>
                                    </td>

                                    <td>
                                        <p class="mb-0">Identitas Number</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Email</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Role</p>
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
                                @if ($data_users->isNotEmpty())
                                    @foreach ($data_users as $item)
                                        <tr>
                                            <td>
                                                <p class="mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->nama }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->identitas }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->email }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-uppercase">{{ $item->role }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    @if ($item->status == 1)
                                                        <i class="bx bx-check-circle text-success"></i>
                                                        <span class="text-success">Active</span>
                                                    @else
                                                        <i class="bx bx-x-circle text-danger"></i>
                                                        <span class="text-danger">Non Active</span>
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <a class="btn text-primary me-2 d-flex justify-content-center align-items-center gap-1"
                                                    href="{{ url('/admin/update-User/' . $item->id) . '/edit' }}"><i
                                                        class="bx bx-pencil"></i>Edit</a>
                                                <form action="{{ url('/admin/user-Management/' . $item->id) }}"
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn text-danger btn-delete"><i
                                                            class="bx bx-x"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    {{-- <tr>
                                        <td colspan="8">
                                            <p class="text-center">Belum ada User</p>
                                        </td>
                                    </tr> --}}
                                @endif
                            </tbody>
                        </table>
                    </div>




                </div>
            </div>
        </div>

    </div>

    {{-- @include('admin.modals') --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
            var table;

            function initDataTable() {
                var dataTableExists = $.fn.DataTable.isDataTable('#myTable');
                if (dataTableExists) {
                    $('#myTable').DataTable().destroy();
                }

                setTimeout(() => {
                    table = $('#myTable').DataTable({
                        scrollCollapse: true,
                        responsive: true,
                        "columnDefs": [{
                                "orderable": false,
                                "targets": [6]
                            },
                            {
                                "targets": 5,
                                "render": function(data, type, row) {
                                    if (type === 'filter') {
                                        var span = $('<div>').html(data).find('span')
                                    .text();
                                        return span.trim();
                                    }
                                    return data;
                                }
                            }
                        ]
                    });

                    $('#filterRole').on('change', function() {
                        applyFilters();
                    });

                    $('#filterStatus').on('change', function() {
                        applyFilters();
                    });

                    function applyFilters() {
                        var selectedRole = $('#filterRole').val();
                        var selectedStatus = $('#filterStatus').val();

                        table.column(4).search(selectedRole ? '^' + selectedRole + '$' : '', true, false);

                        if (selectedStatus !== '') {
                            var statusText = selectedStatus == '1' ? 'Active' : 'Non Active';
                            table.column(5).search(statusText, true, false);
                        } else {
                            table.column(5).search('', true, false);
                        }

                        table.draw();
                    }



                }, 100);
            }

            initDataTable();
        });
    </script>


@endsection
