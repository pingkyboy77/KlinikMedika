<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lomba;
use App\Models\daftarLomba;
use Illuminate\Http\Request;
use App\Models\DaftarPengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaController extends Controller
{
    public function beranda()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $dospem_jumlah = User::where('role', 'dosen')->count();
        $lomba_jumlah = Lomba::count();
        return view('mahasiswa.dashboard', compact('role', 'nama', 'dospem_jumlah', 'lomba_jumlah'));
    }
    public function daftarDosenPembimbing()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $dospem = User::where('role', 'dosen')->get();
        // dd($user);

        return view('mahasiswa.daftarDosenPembimbing', compact('role', 'nama', 'dospem'));
    }
    public function daftarPerlombaan(Request $request)
    {
        $user = Auth::user();
        // dd($user);
        $nama = $user->nama;
        $role = $user->role;
        $daftar_lomba = Lomba::orderBy('created_at', 'desc')->get();
        // dd($daftar_lomba);
        return view('mahasiswa.daftarPerlombaan', compact('role', 'nama', 'daftar_lomba'));
    }
    public function history()
    {
        $user = Auth::user();
        // dd($user);
        $nama = $user->nama;
        $role = $user->role;
        $daftar_lomba_ikut = DaftarPengajuan::where('stored_by', $nama)->orderBy('created_at', 'desc')->get();
        // dd($daftar_lomba_ikut);
        return view('mahasiswa.history', compact('role', 'nama', 'daftar_lomba_ikut'));
    }
    public function jadwalBimbingan()
    {
        $user = Auth::user();
        // dd($user);
        $nama = $user->nama;
        $role = $user->role;
        return view('mahasiswa.jadwalBimbingan', compact('role', 'nama'));
    }
    public function pengajuanLomba($nama_lomba, $nama_akun, $id)
    {
        // Check if the user has already submitted this competition
        $data_pengajuan = DaftarPengajuan::where('nama_lomba', $nama_lomba)->where('stored_by', $nama_akun)->first();

        if ($data_pengajuan != null) {
            return redirect()->back()->with('error', 'Anda sudah mengajukan lomba ini');
        } else {
            // Get the authenticated user
            $user = Auth::user();

            // Extract user details
            $nama = $user->nama;
            $role = $user->role;

            // Get competition category
            $kategori = Lomba::where('id', $id)->pluck('kategori')->first();

            // Get supervisors for the competition category
            $dospem = User::where('kategori', $kategori)->get();

            // Pass parameters to the view
            return view('mahasiswa.form-pengajuan-lomba', compact('role', 'nama', 'nama_lomba', 'nama_akun', 'kategori', 'dospem'));
        }
    }

    public function pengajuanLombaStore(Request $request)
    {
        try {
            // Validation rules
            // dd($request->all());
            $data = $request->validate([
                'nama_ketua' => 'required',
                'identitas_number_ketua' => 'required',
                'email_ketua' => 'required',
                'no_telp_ketua' => 'required',
                'namadosen' => 'required',
                'file_proposal_pengajuan' => 'required|file'
            ]);
            // dd($data);
            if ($request->hasFile('file_proposal_pengajuan')) {
                $file_proposal_pengajuan = $request->file('file_proposal_pengajuan');
                $file_name = time() . '-' . $file_proposal_pengajuan->getClientOriginalName();
                
                $storage = 'uploads/file_pengajuan/';
                $file_proposal_pengajuan->move($storage, $file_name);
                $data['file_proposal_pengajuan'] = $storage . $file_name;
            } else {
                $data['file_proposal_pengajuan'] = null;
            }


            
            // Populate other data
            $data['stored_by'] = Auth::user()->nama;
            $data['jenis_pengajuan'] = 'Pengajuan Lomba';
            $data['kategori'] = $request->kategori;
            $data['nama_lomba'] = $request->nama_lomba;
            $data['status'] = 'Menunggu Persetujuan';
            // Save data to database
            // dd($data);
            Alert::success('Sukses', 'Data Berhasil Di Update');
            DaftarPengajuan::create($data);

            return redirect()->route('mahasiswa.history')->with('success', 'Pengajuan berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
