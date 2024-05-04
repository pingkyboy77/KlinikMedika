<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function beranda()
    {
        $user_role = "Mahasiswa";
        return view('mahasiswa.dashboard',compact('user_role'));
    }

    public function daftarDosenPembimbing()
    {
        $user_role = "Mahasiswa";
        return view('mahasiswa.daftarDosenPembimbing', compact('user_role'));
    }
    public function daftarPerlombaan()
    {
        $user_role = "Mahasiswa";
        return view('mahasiswa.daftarPerlombaan',compact('user_role'));
    }
    public function history()
    {
        $user_role = "Mahasiswa";
        return view('mahasiswa.history',compact('user_role'));
    }
    public function jadwalBimbingan()
    {
        $user_role = "Mahasiswa";
        return view('mahasiswa.jadwalBimbingan',compact('user_role'));
    }
}

