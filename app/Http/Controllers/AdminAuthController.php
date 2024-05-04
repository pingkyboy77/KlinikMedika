<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    function index()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        // Validasi data yang diterima dari form login
        $data = $request->validate([
            'identitas' => 'required',
            'password' => 'required',
        ]);
        // Coba melakukan proses login menggunakan Auth::attempt()
        if (Auth::attempt($data)) {
            // Jika berhasil, regenerasi session dan redirect ke dashboard
            $request->session()->regenerate();
            $user = User::where('identitas', $data['identitas'])->first();
            $user_role = $user->role;
            // dd($user_role);
            $viewName = $user_role . '.dashboard';
            return view($viewName, compact('user_role'));
        }

        // Jika login gagal, kembali ke halaman sebelumnya dengan pesan error
        return back()->with('LoginError', 'Gagal Login, identitas Atau Password Tidak Ditemukan');
    }

    function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
