<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarPengajuan;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function beranda()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        return view('dosen.dashboard', compact('role','nama'));
    }

    public function daftarBimbingan()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        return view('dosen.daftarBimbingan', compact('role','nama'));
    }
    public function pengajuanLomba()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $daftar_lomba_pengajuan = DaftarPengajuan::where('namadosen', $nama)->orderBy('created_at', 'desc')->get();
        return view('dosen.pengajuanLomba', compact('role','nama' , 'daftar_lomba_pengajuan'));
    }
    public function jadwalBimbingan()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        return view('dosen.jadwalBimbingan', compact('role','nama'));
    }
}
