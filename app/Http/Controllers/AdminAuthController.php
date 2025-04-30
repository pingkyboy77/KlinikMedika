<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lomba;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return back()->with('LoginError', 'Gagal Login, email tidak ditemukan');
        }

        if (!Hash::check($data['password'], $user->password)) {
            return back()->with('LoginError', 'Gagal Login, password salah');
        }

        if ($user->status != 1) {
            return back()->with('LoginError', 'Gagal Login, akun Anda belum aktif');
        }

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            return redirect()->route('beranda');
        }

        return back()->with('LoginError', 'Gagal Login, email atau password tidak ditemukan');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
