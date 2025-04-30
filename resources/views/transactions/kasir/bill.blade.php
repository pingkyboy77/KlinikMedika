<!DOCTYPE html>
<html>
<head>
    <title>Bill</title>
    <style>
        body { font-family: sans-serif; }
        .header, .footer { text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        <h2>KLINIK INOVA MEDIKA SOLUSINDO</h2>
        <p>Billing Statement</p>
    </div>

    <p><strong>Treatment ID:</strong> {{ $transaction->transaction_id }}</p>
    <p><strong>Patient:</strong> {{ $transaction->pasien->PasienName }}</p>
    <p><strong>Service:</strong> {{ $transaction->service->ServiceName }}</p>

    <h4>Charges</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Unit</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        @php $total = 0; @endphp

        {{-- Service Charge --}}
        <tr>
            <td>{{ $transaction->service->ServiceName }}</td>
            <td>-</td>
            <td>1</td>
            <td>{{ number_format($transaction->service->Price, 0) }}</td>
            <td>{{ number_format($transaction->service->Price, 0) }}</td>
        </tr>
        @php $total += $transaction->service->Price; @endphp

        {{-- Drugs --}}
        @foreach($transaction->drugDetails as $detail)
            <tr>
                <td>{{ $detail->drug->DrugName }}</td>
                <td>{{ $detail->drug->UnitType }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->drug->Price, 0) }}</td>
                <td>{{ number_format($detail->drug->Price * $detail->quantity, 0) }}</td>
            </tr>
            @php $total += $detail->drug->Price * $detail->quantity; @endphp
        @endforeach
        </tbody>
    </table>

    <h4>Total: Rp{{ number_format($total, 0) }}</h4>

    <div class="footer">
        <p>Thank you for your visit</p>
    </div>
</body>
</html>
