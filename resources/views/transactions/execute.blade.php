@extends('admin.layouts.app')
@section('title', 'Execute Treatment')

@section('content')
@php
    use Carbon\Carbon;
    $umur = Carbon::parse($transaction->pasien->tgl_lahir)->age;
@endphp

<div class="container-fluid">
    <form action="{{ route('dokter.tindakan.update', $transaction->id) }}" method="POST">
        @csrf
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Execute Tindakan - {{ $transaction->transaction_id }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Patient:</strong> {{ $transaction->pasien->PasienName }}</p>
                <p><strong>Umur:</strong> {{ $umur }} tahun</p>
                <p><strong>Riwayat Alergi:</strong> {{ $transaction->pasien->allergy ?? '-' }}</p>
                <p><strong>Service:</strong> {{ $transaction->service->ServiceName }}</p>

                <div class="form-group">
                    <label for="diagnosis">Diagnosis <span class="text-danger">*</span></label>
                    <textarea name="diagnosis" class="form-control" required></textarea>
                </div>

                <hr>
                <h5>Prescribe Drugs</h5>
                <div id="drug-container">
                    <div class="row drug-entry mb-2">
                        <div class="col-md-6">
                            <select name="drugs[0][drug_id]" class="form-control" required>
                                <option value="">-- Select Drug --</option>
                                @foreach($drugs as $drug)
                                    <option value="{{ $drug->id }}" data-unit="{{ $drug->UnitType }}">{{ $drug->DrugName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="drugs[0][quantity]" class="form-control" placeholder="Quantity" required>
                            <small class="text-muted drug-unit"></small>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-remove-drug">X</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary btn-add-drug">+ Add Drug</button>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('dokter.tindakan.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Save Treatment</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    let index = 1;

    // Tambah obat
    $('.btn-add-drug').click(function () {
        const html = `
            <div class="row drug-entry mb-2">
                <div class="col-md-6">
                    <select name="drugs[${index}][drug_id]" class="form-control" required>
                        <option value="">-- Select Drug --</option>
                        @foreach($drugs as $drug)
                            <option value="{{ $drug->id }}" data-unit="{{ $drug->UnitType }}">{{ $drug->DrugName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" name="drugs[${index}][quantity]" class="form-control" placeholder="Quantity" required>
                    <small class="text-muted drug-unit"></small>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-remove-drug">X</button>
                </div>
            </div>`;
        $('#drug-container').append(html);
        index++;
    });

    // Hapus baris obat
    $(document).on('click', '.btn-remove-drug', function () {
        $(this).closest('.drug-entry').remove();
    });

    // Tampilkan unit obat saat dipilih
    $(document).on('change', 'select[name^="drugs"]', function () {
        const unit = $(this).find('option:selected').data('unit');
        $(this).closest('.drug-entry').find('.drug-unit').text(unit ? `Satuan: ${unit}` : '');
    });
</script>
@endsection
