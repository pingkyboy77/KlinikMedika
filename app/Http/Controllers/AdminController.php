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
        $user_role = 'Super Admin';
        return view('admin.userManagement', compact('user_role'));
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'nama' => 'required',
            'identitas' => 'required',
            'username' => 'required',
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
}
