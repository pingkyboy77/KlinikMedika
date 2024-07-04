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
        $jumlah_lomba_pengajuan = DaftarPengajuan::where('namadosen', $nama)->get()->count();
        $notif = DaftarPengajuan::where('namadosen', $nama)->where('status', 'menunggu persetujuan')->get()->count();
        $jumlah_daftar_bimbingan = DaftarBimbingan::where('namadosen', $nama)->where('status', 'diterima')->where('namadosen', $nama)->get()->count();
        $jumlah_bimbingan_pengajuan = DaftarBimbingan::where('namadosen', $nama)->where('status', 'Menunggu Persetujuan')->get()->count();
        return view('dosen.dashboard', compact('role', 'jumlah_lomba_pengajuan', 'nama', 'jumlah_daftar_bimbingan', 'jumlah_bimbingan_pengajuan', 'notif'));
    }

    public function daftarBimbingan()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $daftar_bimbingan = DaftarBimbingan::where('namadosen', $nama)
            ->where(function ($query) {
                $query->where('status', 'diterima')->orWhere('status', 'Di jadwalkan Ulang');
            })
            ->orderBy('created_at', 'asc')
            ->get();
        $notif = DaftarPengajuan::where('namadosen', $nama)->where('status', 'menunggu persetujuan')->get()->count();
        $jumlah_daftar_bimbingan = DaftarBimbingan::where('namadosen', $nama)->where('status', 'diterima')->where('namadosen', $nama)->get()->count();
        return view('dosen.daftarBimbingan', compact('role', 'nama', 'daftar_bimbingan', 'notif'));
    }
    public function pengajuanLomba()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $daftar_lomba_pengajuan = DaftarPengajuan::where('namadosen', $nama)->orderBy('created_at', 'desc')->get();
        $notif = DaftarPengajuan::where('namadosen', $nama)->where('status', 'menunggu persetujuan')->get()->count();
        $jumlah_daftar_bimbingan = DaftarBimbingan::where('namadosen', $nama)->where('status', 'diterima')->where('namadosen', $nama)->get()->count();
        return view('dosen.pengajuanLomba', compact('role', 'nama', 'daftar_lomba_pengajuan', 'notif'));
    }
    public function jadwalBimbingan()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $daftar_bimbingan_pengajuan = DaftarBimbingan::where('namadosen', $nama)->orderBy('created_at', 'asc')->get();
        $notif = DaftarPengajuan::where('namadosen', $nama)->where('status', 'menunggu persetujuan')->get()->count();
        $jumlah_daftar_bimbingan = DaftarBimbingan::where('namadosen', $nama)->where('status', 'diterima')->where('namadosen', $nama)->get()->count();
        return view('dosen.jadwalBimbingan', compact('role', 'nama', 'daftar_bimbingan_pengajuan', 'notif' ));
    }
    public function updateStatusLomba(Request $request, $id, $status)
    {
        // dd($status);
        $daftar_lomba = DaftarPengajuan::find($id);
        $daftar_lomba->status = $request->status;
        $daftar_lomba->save();
        Alert::success('Sukses', 'Data Berhasil Di Update');
        return redirect()->route('dosen.pengajuanLomba');
    }
    public function updateStatusBimbingan(Request $request, $id, $status)
    {
        // dd($status, $request->all());
        $daftar_lomba = DaftarBimbingan::find($id);
        // $daftar_lomba->lokasi_bimbingan = $request->lokasi_bimbingan;
        $daftar_lomba->tanggal_bimbingan = $request->tanggal_bimbingan;
        $daftar_lomba->waktu_bimbingan = $request->waktu_bimbingan;
        $daftar_lomba->status = $status;
        $daftar_lomba->save();
        Alert::success('Sukses', 'Data Berhasil Di Update');
        return redirect()->route('dosen.jadwalBimbingan');
    }
    public function updateStatusBimbinganACC(Request $request, $id, $status)
    {
        // dd($status, $request->all());
        $daftar_lomba = DaftarBimbingan::find($id);
        $daftar_lomba->status = $status;
        $daftar_lomba->save();
        Alert::success('Sukses', 'Data Berhasil Di Update');
        return redirect()->route('dosen.jadwalBimbingan');
    }
}
