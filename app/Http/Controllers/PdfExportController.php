<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use App\Models\DaftarPengajuan;

class PdfExportController extends Controller
{
    public function export(Request $request)
    {
        // Ambil semua data jika tidak ada filter
        $lomba = DaftarPengajuan::all();

        // Load view blade ke variabel $html
        $html = view('admin.laporan_pdf', compact('lomba'))->render();

        // Buat objek Dompdf baru
        $dompdf = new Dompdf();

        // Muat HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        // Tampilkan PDF ke pengguna
        return $dompdf->stream('laporan_hasil_lomba.pdf');
    }

    public function exportFiltered(Request $request, $month, $year, $progress)
    {
        // Lakukan logika filter di sini
        // Contoh: $data = DaftarPengajuan::where(...)->get();

        // Ambil data yang akan diekspor
        // Jika filter adalah "all", maka tidak perlu menambahkan kondisi di query
        $query = DaftarPengajuan::query();

        if ($month !== 'all') {
            $query->whereRaw('MONTH(tanggal) = ?', [$month]);
        }

        if ($year !== 'all') {
            $query->whereRaw('YEAR(tanggal) = ?', [$year]);
        }

        if ($progress !== 'all') {
            $query->where('progress_lomba', $progress);
        }

        // Ambil data yang sesuai filter
        $lomba = $query->get();

        // Load view blade ke variabel $html
        $html = view('admin.laporan_pdf', compact('lomba'))->render();

        // Buat objek Dompdf baru
        $dompdf = new Dompdf();

        // Muat HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        // Tampilkan PDF ke pengguna
        return $dompdf->stream('laporan_hasil_lomba_filtered.pdf');
    }
}
