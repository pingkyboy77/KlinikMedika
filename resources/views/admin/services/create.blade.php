@extends('admin.layouts.app')
@section('title', 'Add Service')
@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Service</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.services.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Service ID</label>
                            <input type="text" name="ServicesID" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Service Name</label>
                            <input type="text" name="ServiceName" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Price</label>
                            <input type="text" id="price_display" class="form-control" placeholder="e.g. 100,000">
                            <input type="hidden" name="Price" id="price">
                        </div>

                        <div class="form-group mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <button class="btn btn-primary" type="submit">Save</button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const displayInput = document.getElementById('price_display');
            const hiddenInput = document.getElementById('price');

            function formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            function unformatNumber(str) {
                return str.replace(/,/g, '');
            }

            displayInput.addEventListener('input', function() {
                const numeric = unformatNumber(displayInput.value);
                if (!isNaN(numeric)) {
                    hiddenInput.value = numeric;
                    displayInput.value = formatNumber(numeric);
                } else {
                    hiddenInput.value = '';
                }
            });

            // Trigger once for preloaded value
            displayInput.dispatchEvent(new Event('input'));
        });
    </script>
@endsection
