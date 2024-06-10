<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DaftarPengajuan;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    public function getDosenPembimbing(Request $request)
    {
        $kategori = $request->input('kategori');

        // Mendapatkan nama dosen yang memiliki pengajuan diterima sebanyak 2 atau lebih
        $dosen_dengan_pengajuan_diterima = DB::table('daftar_pengajuans')->select('namadosen')->where('status', 'diterima')->groupBy('namadosen')->havingRaw('COUNT(namadosen) >= 2')->pluck('namadosen');

        // Jika ada dosen yang sesuai, ambil dosen dari tabel users berdasarkan kategori dan yang namanya tidak ada dalam daftar $dosen_dengan_pengajuan_diterima
        // Jika tidak, ambil semua dosen dari tabel users berdasarkan kategori
        if ($dosen_dengan_pengajuan_diterima->isNotEmpty()) {
            $dospem = User::where('kategori', $kategori)->whereNotIn('nama', $dosen_dengan_pengajuan_diterima)->get();
        } else {
            $dospem = User::where('kategori', $kategori)->get();
        }

        return response()->json($dospem);
    }
}
