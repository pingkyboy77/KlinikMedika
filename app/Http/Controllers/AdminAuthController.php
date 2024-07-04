<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lomba;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    function landing()
    {
        return view('auth.landing');
    }
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
            // Jika berhasil, regenerasi session
            $request->session()->regenerate();

            // Dapatkan informasi pengguna yang masuk
            $user = User::where('identitas', $data['identitas'])->first();
            $role = $user->role;

            // Tentukan rute yang akan diarahkan
            $routeName = $role . '.beranda';
            // dd($routeName);
            // Redirect ke rute yang sesuai dengan peran pengguna
            return redirect()->route($routeName);
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return back()->with('LoginError', 'Gagal Login, identitas atau password tidak ditemukan');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // Pastikan rute login benar
    }
}
