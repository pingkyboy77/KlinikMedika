<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Lomba;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function beranda()
    {
        $user_role = 'Super Admin';
        return view('admin.dashboard', compact('user_role'));
    }
    public function userManagement()
    {
        $user_role = 'Super Admin';
        $user = User::orderBy('created_at', 'desc')->get();
        return view('admin.userManagement', compact('user_role', 'user'));
    }
    public function lombaManagement()
    {
        $user_role = 'Super Admin';
        $lomba = Lomba::orderBy('created_at', 'desc')->get();
        // dd($lomba);
        return view('admin.lombaManagement', compact('user_role', 'lomba'));
    }
    public function kategoriManagement()
    {
        $user_role = 'Super Admin';
        $kategori = Kategori::orderBy('created_at', 'desc')->get();
        return view('admin.kategoriManagement', compact('user_role', 'kategori'));
    }
    public function updateKategori($id)
    {
        
        $user_role = 'Super Admin';
        $kategori = Kategori::find($id);
        return view('admin.updateKategori', compact('user_role', 'kategori'));
    }

    public function updateUser($id)
    {
        
        $user_role = 'Super Admin';
        $user = User::find($id);
        return view('admin.updateUser', compact('user_role', 'user'));
    }
    public function updateLomba($id)
{
    $user_role = 'Super Admin';
    $lomba = Lomba::find($id);
    $kategoriOptions = Kategori::pluck('kategori', 'id');

    return view('admin.updateLomba', compact('user_role', 'lomba', 'kategoriOptions'));
}

    public function store(Request $request)
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
        $user_role = 'admin';
        $route = $user_role . '/user-Management';
        Alert::success('Sukses', 'Data Berhasil ditambahkan');
        return redirect($route);
    }

    public function storelomba(Request $request)
{
    try {
        $data = $request->validate([
            'nama_lomba' => 'required',
            'kategori' => 'required',
            'lokasi' => 'required',
            'tanggal' => 'required'
        ]);

        Lomba::create($data);
        $user_role = 'admin';
        $route = $user_role . '/lomba-Management';
        Alert::success('Sukses', 'Data Berhasil ditambahkan');
        return redirect($route);
    } catch (QueryException $e) {
        // Tangani kesalahan saat input data
        Alert::error('Gagal', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        return redirect()->back();
    }
}

    public function storeKategori(Request $request)
    {
        $data = request()->validate([
            'kategori' => 'required'
        ]);
        Kategori::create($data);
        Alert::success('Sukses', 'Data Berhasil ditambahkan');
        $user_role = 'admin';
        $route = $user_role . '/kategori-Management';
        Alert::success('Sukses', 'Data Berhasil ditambahkan');
        return redirect($route);
    }

    public function destroyuser($id)
    {
        $user = User::find($id);

        if (!$user) {
            Alert::warning('Gagal', 'Data Tidak Ditemukan');
        }

        $user->delete();
        $user_role = 'admin';
        $route = $user_role . '/user-Management';
        Alert::success('Sukses', 'Data Berhasil Di Hapus');
        return redirect($route);
    }

    public function destroylomba($id)
    {
        $lomba = Lomba::find($id);

        if (!$lomba) {
            Alert::warning('Gagal', 'Data Tidak Ditemukan');
        }

        $lomba->delete();
        $user_role = 'admin';
        $route = $user_role . '/lomba-Management';
        Alert::success('Sukses', 'Data Berhasil Di Hapus');
        return redirect($route);
    }

    public function destroykategori($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            Alert::warning('Gagal', 'Data Tidak Ditemukan');
        }

        $kategori->delete();
        $user_role = 'admin';
        $route = $user_role . '/kategori-Management';
        Alert::success('Sukses', 'Data Berhasil Di Hapus');
        return redirect($route);
    }

    public function updatedLomba(Request $request, string $id)
    {
        //
        $lomba = Lomba::find($id);
        $request->validate([
            'nama_lomba' => 'required',
            'kategori' => 'required',
            'lokasi' => 'required',
            'tanggal' => 'required'
        ]);

        $lomba = lomba::findOrFail($id);

        $data = [
            'nama_lomba' => $request->nama_lomba,
            'kategori' => $request->kategori,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
        ];

        $lomba->update($data);
        $user_role = 'admin';
        $route = $user_role . '/lomba-Management';
        Alert::success('Sukses', 'Data Berhasil Di Update');
        return redirect($route);
    }
    public function updatedKategori(Request $request, string $id)
    {
        //
        $kategori = Kategori::find($id);
        $request->validate([
            'kategori' => 'required',
        ]);

        $kategori = Kategori::findOrFail($id);

        $data = [
            'kategori' => $request->kategori,
        ];

        $kategori->update($data);
        $user_role = 'admin';
        $route = $user_role . '/kategori-Management';
        Alert::success('Sukses', 'Data Berhasil Di Update');
        return redirect($route);
    }

    public function updatedUser(Request $request, string $id)
    {
        //
        $user = User::find($id);
        $request->validate([
            'nama' => 'required',
            'identitas' => 'required',
            'password' => 'required',
            'role' => 'required',
            'kategori' => 'required',
            'status' => 'required',
        ]);

        $user = User::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'identitas' => $request->identitas,
            'password' => $request->password,
            'role' => $request->role,
            'kategori' => $request->kategori,
            'status' => $request->status,
        ];

        $user->update($data);
        $user_role = 'admin';
        $route = $user_role . '/user-Management';
        Alert::success('Sukses', 'Data Berhasil Di Update');
        return redirect($route);
    }
}
