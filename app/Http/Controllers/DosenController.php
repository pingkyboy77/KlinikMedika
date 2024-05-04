<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function beranda()
    {
        $user_role = "Dosen";
        return view('dosen.dashboard', compact('user_role'));
    }

    public function daftarBimbingan()
    {
        $user_role = "Dosen";
        return view('dosen.daftarBimbingan', compact('user_role'));
    }
    public function pengajuanLomba()
    {
        $user_role = "Dosen";
        return view('dosen.pengajuanLomba', compact('user_role'));
    }
    public function jadwalBimbingan()
    {
        $user_role = "Dosen";
        return view('dosen.jadwalBimbingan', compact('user_role'));
    }
}
