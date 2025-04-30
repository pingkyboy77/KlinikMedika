<!DOCTYPE html>
<html>

<head>
    <title>Clinic Report</title>
    <style>
        body {
            font-family: sans-serif;
        }

        h3 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h3>Klinik Inova Medika Solusindo</h3>
    <h3>Clinic Transaction Report</h3>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Patient</th>
                <th>Service</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $trx)
                <tr>
                    <td>{{ $trx->created_at->format('Y-m-d') }}</td>
                    <td>{{ $trx->pasien->PasienName }}</td>
                    <td>{{ $trx->service->ServiceName }}</td>
                    <td>{{ ucfirst($trx->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
