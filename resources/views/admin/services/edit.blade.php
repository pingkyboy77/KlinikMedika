@extends('admin.layouts.app')
@section('title', 'Edit Service')
@section('content')
<div class="container-fluid m-0 p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Service</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-3">
                            <label>Service ID</label>
                            <input type="text" name="ServicesID" value="{{ old('ServicesID', $service->ServicesID) }}" class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label>Service Name</label>
                            <input type="text" name="ServiceName" value="{{ old('ServiceName', $service->ServiceName) }}" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Price</label>
                            <input type="text" id="price" name="Price" class="form-control"
                                   value="{{ old('Price', number_format($service->Price, 2, '.', ',')) }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="1" {{ old('status', $service->status) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $service->status) == '0' ? 'selected' : '' }}>Inactive</option>
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