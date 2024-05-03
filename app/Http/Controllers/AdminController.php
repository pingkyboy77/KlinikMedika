<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function beranda()
    {
        $user_role = "Super Admin";
        return view('admin.dashboard',compact('user_role'));
    }
}
