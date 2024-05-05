<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function beranda()
    {
        $user_role = 'Super Admin';
        return view('admin.dashboard', compact('user_role'));
    }
    public function userManagement()
    {
        $data_users = User::get();
        $user_role = 'Super Admin';
        return view('admin.userManagement', compact('user_role', 'data_users'));
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
        $user_role = 'Super Admin';
        return view('admin.userManagement', compact('user_role'));
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
    
}
