@extends('admin.layouts.app')

@section('content')
    <div class="container m-0 p-0">
        {{-- <h1 class="mb-4">Region Management</h1> --}}

        {{-- Provinsi Section --}}
        <div class="card mb-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Province</h5>
                <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#createProvinsi">Add
                    Province</button>
            </div>
            <div id="createProvinsi" class="collapse card-body">
                <form action="{{ route('admin.region.provinsi.store') }}" method="POST" class="row g-2">
                    @csrf
                    <div class="col-md-10 d-flex gap-2">
                        <input type="text" name="id" class="form-control mb-2" placeholder="Id Provinsi"
                            value="{{ $nextProvId }}" readonly>
                        <input type="text" name="name" class="form-control mb-2" placeholder="Province Name" required>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success w-100">Save</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="provinsiTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Province Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        {{-- Kabupaten Section --}}
        <div class="card mb-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>City / Regency</h5>
                <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#createKabupaten">Add
                    City/Regency</button>
            </div>
            <div id="createKabupaten" class="collapse card-body">
                <form action="{{ route('admin.region.kabupaten.store') }}" method="POST" class="row g-2">
                    @csrf
                    <div class="col-md-4 d-flex gap-2 justify-content-center align-items-center">
                        <input type="text" name="id" class="form-control mb-2" placeholder="Id Kabupaten"
                            value="{{ $nextKabId }}" readonly>
                        <select name="id_prov" id="id_prov3" class="form-select mb-2" required>
                            <option value="">-- Choose Province --</option>
                            @foreach ($regionProv as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-6 ">

                        <input type="text" name="name" class="form-control mb-2" placeholder="City/Regency Name"
                            required>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success w-100">Save</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="kabupatenTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>City/Regency Name</th>
                            <th>Province</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        {{-- Kecamatan Section --}}
        <div class="card mb-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>District</h5>
                <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#createKecamatan">Add
                    District</button>
            </div>
            <div id="createKecamatan" class="collapse card-body">
                <form action="{{ route('admin.region.kecamatan.store') }}" method="POST" class="row g-2">
                    @csrf
                    <div class="col-md-1 d-flex gap-2 justify-content-center align-items-center">
                        <input type="text" name="id" class="form-control mb-2" placeholder="Id kecamatan"
                            value="{{ $nextKecId }}" readonly>
                    </div>
                    <div class="col-md-3 d-flex gap-2 justify-content-center align-items-center">

                        <select name="id_prov" id="id_prov2" class="form-select mb-2" required>
                            <option value="">-- Choose Province --</option>
                            @foreach ($regionProv as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-3 d-flex justify-content-center align-items-center">
                        <select name="id_kab" id="id_kab2" class="form-select mb-2" required>
                            <option value="">-- Choose City/Regency --</option>
                        </select>

                    </div>
                    <div class="col-md-5 ">

                        <input type="text" name="name" class="form-control mb-2" placeholder="District Name"
                            required>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-success w-100">Save</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="kecamatanTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>District Name</th>
                            <th>City / Regency</th>
                            <th>Province</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        {{-- Desa Section --}}
        <div class="card mb-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Village</h5>
                <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#createDesa">Add Village</button>
            </div>
            <div id="createDesa" class="collapse card-body">
                <form action="{{ route('admin.region.desa.store') }}" method="POST" class="row g-2">
                    @csrf
                    <div class="col-md-1 d-flex justify-content-center align-items-center">
                        <input type="text" name="id" class="form-control mb-2" placeholder="Id Desa"
                            value="{{ $nextDesId }}" readonly>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <select name="id_prov" id="id_prov" class="form-select mb-2" required>
                            <option value="">-- Choose Province --</option>
                            @foreach ($regionProv as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center align-items-center">

                        <!-- Kabupaten (akan diubah via JS) -->
<select name="id_kab" id="id_kab" class="form-select mb-2" required>
    <option value="">-- Choose City/Regency --</option>
</select>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center align-items-center">
                        <select name="id_kec" id="id_kec" class="form-select mb-2" required>
                            <option value="">-- Choose District --</option>
                        </select>
                    </div>
                    <div class="col-md-3">

                        <input type="text" name="name" class="form-control" placeholder="Village Name" required>
                    </div>
                    <div class="col-md-12 mt-2">
                        <button class="btn btn-success w-100">Save</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="desaTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Village Name</th>
                            <th>District</th>
                            <th>City / Regency</th>
                            <th>Province</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('#id_prov').on('change', function() {
                var provId = $(this).val();
                // console.log(provId);
                if (provId) {
                    $.ajax({
                        url: '/admin/region/get-kabupaten/' + provId,
                        type: 'GET',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('#id_kab').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#id_kab').on('change', function() {
                var kabId = $(this).val();
                $('#id_kec').empty().append('<option value="">-- Choose District --</option>');
                if (kabId) {
                    $.ajax({
                        url: '/admin/region/get-kecamatan/' + kabId,
                        type: 'GET',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('#id_kec').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });

        $('#id_prov2').on('change', function() {
            const provId = $(this).val();
            const $kabupatenSelect = $('#id_kab2');

            $kabupatenSelect.empty().append('<option value="">-- Choose City / Regency --</option>');

            if (provId) {
                $.ajax({
                    url: '/admin/get-kabupaten/' + provId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $kabupatenSelect.append('<option value="' + value.id + '">' + value
                                .name + '</option>');
                        });
                    }
                });
            }
        });
        $('.select2').select2({
            allowClear: true
        });
        $('#provinsiTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.region.data.provinsi') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'Action',
                    name: 'Action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#kabupatenTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.region.data.kabupaten') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'provinsi_name',
                    name: 'prov.name'
                },
                {
                    data: 'Action',
                    name: 'Action',
                    orderable: false,
                    searchable: false
                }
            ]
        });


        $('#kecamatanTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.region.data.kecamatan') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'kabupaten_name',
                    name: 'kab.name'
                },
                {
                    data: 'provinsi_name',
                    name: 'prov.name'
                },
                {
                    data: 'Action',
                    name: 'Action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#desaTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.region.data.desa') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'kecamatan_name',
                    name: 'kec.name'
                },
                {
                    data: 'kabupaten_name',
                    name: 'kab.name'
                },
                {
                    data: 'provinsi_name',
                    name: 'prov.name'
                },
                {
                    data: 'Action',
                    name: 'Action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        function submitUpdateForm(id) {
            var inputValue = document.getElementById("input-name-" + id).value;
            document.getElementById("hidden-name-" + id).value = inputValue;
            document.getElementById("update-form-" + id).submit();
        }

        function submitDeleteForm(id) {
            if (confirm("Are you sure you want to delete this record?")) {
                document.getElementById("delete-form-" + id).submit();
            }
        }
        });
    </script>
@endsection
