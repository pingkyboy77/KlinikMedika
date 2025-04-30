<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lomba;
use App\Models\Kategori;
use App\Models\RegionDes;
use App\Models\RegionKab;
use App\Models\RegionKec;
use App\Models\DrugDetail;
use App\Models\RegionProv;

use App\Models\Transaction;
use Illuminate\Http\Request;

use App\Models\DaftarBimbingan;
use App\Models\DaftarPengajuan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // DASHBOARD PAGE
    public function index()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        return view('admin.dashboard', compact('nama', 'role'));
    }

    public function data()
    {
        $visitsPerMonth = Transaction::selectRaw("TO_CHAR(created_at, 'YYYY-MM') as month, COUNT(*) as count")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $topServices = Transaction::select('service_id', DB::raw('count(*) as total'))
            ->groupBy('service_id')
            ->with('service')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $topDrugs = DrugDetail::select('drug_id', DB::raw('SUM(quantity) as total'))
            ->groupBy('drug_id')
            ->with('drug')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return response()->json([
            'visitsPerMonth' => $visitsPerMonth,
            'topServices' => $topServices,
            'topDrugs' => $topDrugs,
        ]);
    }

    public function exportPdf()
    {
        $transactions = Transaction::with(['pasien', 'service'])
            ->latest()
            ->get();
        $pdf = Pdf::loadView('admin.reports.pdf', compact('transactions'));
        return $pdf->download('clinic_report.pdf');
    }

    // ------------------------------------------------------------------------------------------------------------

    // VIEW SHOW PAGE
    // REGION PAGE

    public function region()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $regionProv = RegionProv::get();
        $regionKab = RegionKab::get();
        $regionKec = RegionKec::get();
        $regionDes = RegionDes::get();
        return view('admin.region', compact('nama', 'role', 'regionProv', 'regionKab', 'regionKec', 'regionDes'));
    }

    // USER PAGE
    public function userManagement()
    {
        // $data_users = User::get();
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $data_users = User::get();
        return view('admin.user.userManagement', compact('nama', 'role', 'data_users'));
    }
    public function showStoreUser()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        return view('admin.user.createUser', compact('nama', 'role'));
    }
    public function updateUser($id)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $user = User::find($id);
        return view('admin.user.updateUser', compact('nama', 'role', 'user'));
    }
    // -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    // TRANSACTION FUNCTION

    // MODUL USER
    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Cek kalau email sudah ada
            'identitas' => 'required|string',
            'password' => 'required|string|min:8|max:16',
            'role' => 'required|in:admin,staff,dokter,kasir',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // dd($validator->validate());
            User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'identitas' => $request->identitas,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => $request->status,
            ]);

            Alert::success('Sukses', 'Data has been added');
            return redirect()->route('admin.user-Management');
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed.' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error_message', 'failed: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroyuser($id)
    {
        $user = User::find($id);

        if (!$user) {
            Alert::warning('Error', 'Data not found');
        }

        $user->delete();
        $user_role = 'admin';
        $route = $user_role . '/user-Management';
        Alert::success('Sukses', 'Data has been Deleted');
        return redirect($route);
    }

    public function updatedUser(Request $request, string $id)
    {
        //
        $user = User::find($id);
        $request->validate([
            'role' => 'required',
            'status' => 'required',
        ]);

        $user = User::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'identitas' => $request->identitas,
            'password' => $request->password,
            'role' => $request->role,
            'status' => $request->status,
        ];
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        $user_role = 'admin';
        $route = $user_role . '/user-Management';
        Alert::success('Sukses', 'Data has been Updated');
        return redirect($route);
    }

    // -------------------------------------------------------------------------------------------------------------------------------------------
}
