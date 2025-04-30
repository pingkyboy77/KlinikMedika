@extends('admin.layouts.app')
@section('title', 'Edit Drug')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Drug</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.drugs.update', $drug->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label>Drug ID</label>
                            <input type="text" name="DrugID" value="{{ old('DrugID', $drug->DrugID) }}" class="form-control" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label>Drug Name</label>
                            <input type="text" name="DrugName" value="{{ old('DrugName', $drug->DrugName) }}" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Unit Type</label>
                            <input type="text" name="UnitType" value="{{ old('UnitType', $drug->UnitType) }}" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Price</label>
                            <input type="text" id="price_display" class="form-control" value="{{ old('Price', number_format($drug->Price, 0, '', ',')) }}">
                            <input type="hidden" name="Price" id="price" value="{{ old('Price', $drug->Price) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="1" {{ old('status', $drug->status) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $drug->status) == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
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