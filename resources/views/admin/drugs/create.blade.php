@extends('admin.layouts.app')
@section('title', 'Add Drug')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Drug</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.drugs.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Drug ID</label>
                            <input type="text" name="DrugID" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Drug Name</label>
                            <input type="text" name="DrugName" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Unit Type</label>
                            <input type="text" name="UnitType" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Price</label>
                            <input type="text" id="price_display" class="form-control">
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
                        <a href="{{ route('admin.drugs.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('price_display').addEventListener('input', function () {
        let value = this.value.replace(/[^\d]/g, '');
        let formatted = new Intl.NumberFormat().format(value);
        document.getElementById('price_display').value = formatted;
        document.getElementById('price').value = value;
    });
</script>
@endsection