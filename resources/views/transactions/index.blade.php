@extends('admin.layouts.app')
@section('title', 'Pending Treatments')

@section('content')
<div class="container-fluid m-0 p-0">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pending Tindakan</h3>
                </div>
                <div class="card-body">

        <table id="dokter-table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Treatment ID</th>
                    <th>Patient</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
            </div>
        </div>
    </div>
</div>
    

@endsection

@section('scripts')
    <script>
        $(function() {
            let table = $('#dokter-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('dokter.tindakan.data') }}",
                    data: function(d) {
                        d.service_id = $('#filter-service').val();
                        d.status = $('#filter-status').val();
                    }
                },
                columns: [{
                        data: 'transaction_id',
                        name: 'transaction_id'
                    },
                    {
                        data: 'pasien_name',
                        name: 'pasien.PasienName'
                    },
                    {
                        data: 'service_name',
                        name: 'service.ServiceName'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Confirm before cancel
            $(document).on('submit', '.cancel-form', function(e) {
                if (!confirm('Are you sure you want to cancel this treatment?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection
