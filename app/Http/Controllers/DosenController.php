<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarBimbingan;
use App\Models\DaftarPengajuan;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DosenController extends Controller
{
    public function beranda()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $jumlah_lomba_pengajuan = DaftarPengajuan::get()->count();
        $jumlah_daftar_bimbingan = DaftarBimbingan::where('status', 'diterima')->get()->count();
        $jumlah_bimbingan_pengajuan = DaftarBimbingan::where('status' , 'Menunggu Persetujuan')->get()->count();
        return view('dosen.dashboard', compact('role','jumlah_lomba_pengajuan','nama', 'jumlah_daftar_bimbingan', 'jumlah_bimbingan_pengajuan'));
    }

    public function daftarBimbingan()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $daftar_bimbingan = DaftarBimbingan::where('namadosen', $nama)->where('status','diterima')->orderBy('created_at', 'asc')->get();
        return view('dosen.daftarBimbingan', compact('role','nama', 'daftar_bimbingan'));
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
        $daftar_bimbingan_pengajuan = DaftarBimbingan::where('namadosen', $nama)->orderBy('created_at', 'asc')->get();
        return view('dosen.jadwalBimbingan', compact('role','nama', 'daftar_bimbingan_pengajuan'));
    }
    public function updateStatusLomba(Request $request, $id , $status)
    {
        // dd($status);
        $daftar_lomba = DaftarPengajuan::find($id);
        $daftar_lomba->status = $request->status;
        $daftar_lomba->save();
        Alert::success('Sukses', 'Data Berhasil Di Update');
        return redirect()->route('dosen.pengajuanLomba');
    }
    public function updateStatusBimbingan(Request $request, $id , $status)
    {
        // dd($status);
        $daftar_lomba = DaftarBimbingan::find($id);
        $daftar_lomba->status = $request->status;
        $daftar_lomba->save();
        Alert::success('Sukses', 'Data Berhasil Di Update');
        return redirect()->route('dosen.jadwalBimbingan');
    }
}
