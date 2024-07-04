<!DOCTYPE html>
<html>
<head>
    <title>Laporan Hasil Lomba</title>
    <style>
        /* Tambahkan CSS untuk mengatur tampilan PDF sesuai kebutuhan */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            word-wrap: break-word;
            font-size: 7px;
        }
        th {
            background-color: #f2f2f2;
        }
        td[colspan="12"] {
            text-align: center;
        }
        h2, p {
            margin: 0;
        }
        /* Tambahkan gaya untuk footer */
        .footer {
            position: fixed;
            bottom: 0;
            right: 0;
            text-align: right;
            font-size: 10px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <td colspan="11" style="text-align: center">
                    <h2 style="text-align: center">Laporan Hasil Lomba</h2>
                </td>
            </tr>
            <tr>
                <td colspan="11" style="text-align: center">
                    <p style="text-align: center">Tanggal: {{ now()->format('d F Y') }}</p>
                </td>
            </tr>
            <tr>
                <th style="width: 3%"></th>
                <th>Nama User Pengajuan</th>
                <th>Nama Ketua Kelompok</th>
                <th style="width: 11%">Dosen Pembimbing</th>
                <th>Tingkatan Lomba</th>
                <th>Identitas Number Ketua</th>
                <th>Nama Lomba</th>
                <th style="width: 10%">Penyelenggara</th>
                <th>Kategori</th>
                <th>File Proposal</th>
                {{-- <th style="width: 11%">Status Pembimbing</th> --}}
                <th style="width: 11%">Hasil Perlombaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lomba as $item)
                <tr>
                    <td rowspan="2">{{ $loop->iteration }}</td>
                    <td>{{ $item->stored_by }}</td>
                    <td>{{ $item->nama_ketua }}</td>
                    <td>{{ $item->namadosen }}</td>
                    <td>{{ $item->tingkatan_lomba }}</td>
                    <td>{{ $item->identitas_number_ketua }}</td>
                    <td>{{ $item->nama_lomba }}</td>
                    <td>{{ $item->penyelenggara }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->file_proposal_pengajuan }}</td>
                    {{-- <td>{{ $item->status }}</td> --}}
                    <td>{{ $item->progress_Lomba ?? 'Belum Ada Hasil' }}</td>
                </tr>
                <tr>
                    <td colspan="10" style="text-align: left">ANGGOTA KELOMPOK : {{ $item->anggota_1 ?? '' }} , {{ $item->anggota_2 ?? '' }} , {{ $item->anggota_3 ?? '' }} , {{ $item->anggota_4 ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        Dicetak oleh: {{ Auth::user()->nama }}<br>
        Tanggal cetak: {{ now()->format('d F Y H:i:s') }}
    </div>
</body>
</html>
