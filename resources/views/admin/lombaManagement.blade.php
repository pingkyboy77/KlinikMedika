@extends('admin.layouts.app')
@section('content')
{{-- style --}}
<style>
    thead td p{
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
                            <!-- Button untuk membuka modal -->
                            <div class="text-sm-end">
                                <button type="button"
                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                    onclick="openModal()"><i class="mdi mdi-plus me-1"></i> Create Lomba</button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-nowrap align-middle mb-0">
                            <thead>
                                <tr>
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
                                            <a class="btn btn-warning me-2" href="{{ url('/admin/update-Lomba/' . $item->id) . '/edit' }}"><i class="bx bx-pencil"></i>Edit</a>
                                            <form action="{{ url('/admin/lomba-Management/' . $item->id) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-delete"><i class="bx bx-trash-alt"></i> Delete</button>
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

    <!-- Modal -->
    <form action="{{ route('admin.lomba-Management.store') }}" method="POST">
        @csrf
        <div class="modal fade create-lomba" tabindex="-1" role="dialog" aria-labelledby="modal_lomba" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_lomba">Create User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Isi formulir modal -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="nama_lomba">Nama Perlombaan</label>
                                    <input type="text" name="nama_lomba" class="form-control" placeholder="Enter Name"
                                        id="nama_lomba">
                                </div>
                            </div>
                            <!-- Tambahkan input lainnya di sini -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Category">Kategori</label>
                                    <select class="form-select" name="kategori" id="kategori">
                                        <option selected disabled> Select Kategori </option>
                                        <option value="UI/UX">UI/UX</option>
                                        <option value="Jaringan">Jaringan</option>
                                        <option value="Website">Website</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="lokasi">Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control" placeholder="Enter Place"
                                        id="lokasi">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" placeholder="Enter Place"
                                        id="tanggal">
                                </div>
                            </div>
                        </div>
                    </div>
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
            var modal = document.querySelector('.create-lomba');
            var modalBootstrap = new bootstrap.Modal(modal);
            modalBootstrap.show();
        }
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
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
@endsection
