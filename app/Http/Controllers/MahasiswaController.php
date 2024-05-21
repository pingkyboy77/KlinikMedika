<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lomba;
use App\Models\daftarLomba;
use Illuminate\Http\Request;
use App\Models\DaftarBimbingan;
use App\Models\DaftarPengajuan;
use Illuminate\Support\Facades\DB;
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
        $history_jumlah = DaftarPengajuan::get()->count();
        $bimbingan_jumlah = DaftarBimbingan::get()->count();
        
        return view('mahasiswa.dashboard', compact('role', 'nama', 'dospem_jumlah', 'lomba_jumlah', 'history_jumlah', 'bimbingan_jumlah'));
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
        $daftar_lomba_ikut = DaftarPengajuan::where('stored_by', $nama)->get();
        return view('mahasiswa.daftarPerlombaan', compact('role', 'nama', 'daftar_lomba', 'daftar_lomba_ikut'));
    }
    public function history()
    {
        $user = Auth::user();
        // dd($user);
        $nama = $user->nama;
        $role = $user->role;
        $daftar_lomba_ikut = DaftarPengajuan::where('stored_by', $nama)->orderBy('created_at', 'desc')->get();
        $daftar_bimbingan = DaftarBimbingan::where('stored_by', $nama)->orderBy('created_at', 'desc')->get();
        return view('mahasiswa.history', compact('role', 'nama', 'daftar_lomba_ikut', 'daftar_bimbingan'));
    }
    public function jadwalBimbingan()
    {
        $user = Auth::user();
        // dd($user);
        $nama = $user->nama;
        $role = $user->role;
        $daftar_bimbingan = DaftarBimbingan::where('stored_by', $nama)->where('status','diterima')->orderBy('created_at', 'asc')->get();
        return view('mahasiswa.jadwalBimbingan', compact('role', 'nama', 'daftar_bimbingan'));
    }
    public function pengajuanLomba($nama_lomba, $nama_akun, $id)
    {
        // Check if the user has already submitted this competition
        $nama_lomba = str_replace('-', ' ', $nama_lomba);
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
            $dosen_dengan_pengajuan_diterima = DB::table('daftar_pengajuans')->select('namadosen')->where('status', 'diterima')->groupBy('namadosen')->having(DB::raw('count(namadosen)'), '<', 2)->pluck('namadosen');
            // dd($dosen_dengan_pengajuan_diterima); 
            // Ambil dosen sesuai kategori dari daftar pengajuan dan filter berdasarkan dosen yang di atas
            $dospem = User::where('kategori', $kategori)
                ->whereIn('nama', $dosen_dengan_pengajuan_diterima)
                ->get();

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
                'file_proposal_pengajuan' => 'required|file',
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

    public function pengajuanBimbingan($id)
    {
        // dd('masuk');
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $acc_lomba = DaftarPengajuan::where('id', $id)->first();
        // dd($acc_lomba);
        return view('mahasiswa.form-pengajuan-bimbingan', compact('role', 'nama', 'acc_lomba'));
    }
    public function pengajuanBimbinganStore(Request $request){
        $data = $request->validate([
            'stored_by' => 'required',
            'nama_ketua' => 'required',
            'nama_lomba' => 'required',
            'identitas_number_ketua' => 'required',
            'kategori_lomba' => 'required',
            'namadosen' => 'required',
            'lokasi_bimbingan' => 'required',
            'tanggal_bimbingan' => 'required',
            'waktu_bimbingan' => 'required',
        ]);
        $data['jenis_pengajuan'] = 'Pengajuan Bimbingan';
        $data['status'] = 'Menunggu Persetujuan';
        Alert::success('Sukses', 'Data Berhasil Di Update');
        DaftarBimbingan::create($data);
        return redirect()->route('mahasiswa.jadwalBimbingan');
        // dd($data);
    }
}
