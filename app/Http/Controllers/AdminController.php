<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lomba;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\DaftarPengajuan;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;

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
    public function updateKategori($id)
    {

        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $kategori = Kategori::find($id);
        return view('admin.updateKategori', compact('nama', 'role', 'kategori'));
    }

    public function updateUser($id)
    {

        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $user = User::find($id);
        $kategori = Kategori::orderBy('created_at', 'desc')->pluck('kategori');
        return view('admin.updateUser', compact('nama', 'role', 'user', 'kategori'));
    }
    public function updateLomba($id)
{
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
    $lomba = Lomba::find($id);
    $kategoriOptions = Kategori::pluck('kategori', 'id');
    

    return view('admin.updateLomba', compact('nama', 'role', 'lomba', 'kategoriOptions'));
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

    // public function editUser($id)
    // {
    //     $user = User::find($id);
    //     return response()->json($user);
    // }
    // public function updateUser(Request $request, $id)
    // {
    //     $user = User::find($id);
    //     $user->nama = $request->nama;
    //     $user->identitas = $request->identitas;
    //     if ($request->password) {
    //         $user->password = bcrypt($request->password); // enkripsi password baru jika diisi
    //     }
    //     // Tambahkan bidang lain jika perlu di sini
    //     $user->save();
    //     return response()->json(['success' => true]);
    //     $user_role = 'admin';
    //     $route = $user_role . '/user-Management';
    //     Alert::success('Sukses', 'Data Berhasil ditambahkan');
    //     return redirect($route);
    // }

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
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        $user_role = 'admin';
        $route = $user_role . '/user-Management';
        Alert::success('Sukses', 'Data Berhasil Di Update');
        return redirect($route);
    }

}
