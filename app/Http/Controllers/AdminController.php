<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lomba;
use App\Models\Kategori;
use Illuminate\Http\Request;

use App\Models\DaftarPengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function beranda()
    {
        $kategori = Kategori::get()->count();
        $lomba = Lomba::get()->count();
        $user_jumlah = User::get()->count();
        $pengajuan_jumlah = DaftarPengajuan::get()->count();
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        return view('admin.dashboard', compact('nama', 'kategori', 'lomba', 'user_jumlah','role', 'pengajuan_jumlah'));
    }
    public function userManagement()
    {
        $data_users = User::get();
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        // $nama = 'super admin';
        // $role = 'super admin';
        $data_users = User::get();
        $kategori = Kategori::orderBy('created_at', 'desc')->pluck('kategori');
        return view('admin.userManagement', compact('nama','role', 'data_users', 'kategori'));
    }
    public function lombaManagement()
    {
        $user_role = 'Super Admin';
        $lomba = Lomba::orderBy('created_at', 'desc')->get();
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        // dd($lomba);
        return view('admin.lombaManagement', compact('lomba', 'nama', 'role'));
    }
    public function daftarPengajuanLomba()
    {
        $user_role = 'Super Admin';
        $lomba = Lomba::orderBy('created_at', 'desc')->get();
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $pengajuan_jumlah = DaftarPengajuan::get();
        // dd($lomba);
        return view('admin.pengajuanLombaManagement', compact('lomba', 'nama', 'role', 'pengajuan_jumlah'));
    }
    public function kategoriManagement()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $kategori = Kategori::orderBy('created_at', 'desc')->get();
        return view('admin.kategoriManagement', compact('kategori', 'nama', 'role'));
    }

    public function storeUser(Request $request)
    {
        $data = request()->validate([
            'nama' => 'required',
            'identitas' => 'required',
            'password' => 'required',
            'role' => 'required',
            'kategori' => 'required',
            'status' => 'required',
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return $this->userManagement();
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->nama = $request->nama;
        $user->identitas = $request->identitas;
        if ($request->password) {
            $user->password = bcrypt($request->password); // enkripsi password baru jika diisi
        }
        // Tambahkan bidang lain jika perlu di sini
        $user->save();
        return response()->json(['success' => true]);
    }

    public function storelomba(Request $request)
    {
        $data = request()->validate([
            'nama_lomba' => 'required',
            'kategori' => 'required',
            'lokasi' => 'required',
            'tanggal' => 'required'
        ]);
        Lomba::create($data);
        return $this->lombaManagement();
    }

    public function storeKategori(Request $request)
    {
        $data = request()->validate([
            'kategori' => 'required'
        ]);
        Kategori::create($data);
        return $this->kategoriManagement();
    }

}
