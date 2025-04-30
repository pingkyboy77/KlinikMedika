<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Service;
use App\Models\DrugDetail;
use App\Models\Transaction;
use App\Models\VisitHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class TindakanController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $pasien = Pasien::findOrFail($request->pasien_id);
        $doctors = User::where('role', 'dokter')->get();
        $services = Service::all();

        return view('transactions.create', compact('pasien', 'doctors', 'services', 'nama', 'role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'doctor_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $transaction = Transaction::create([
            'pasien_id' => $request->pasien_id,
            'doctor_id' => $request->doctor_id,
            'service_id' => $request->service_id,
            'status' => 'open',
            'created_by' => auth()->id(),
        ]);

        VisitHistory::create([
            'pasien_id' => $request->pasien_id,
            'visit_date' => now(),
            'service_id' => $request->service_id,
        ]);
        Alert::success('Success', 'Record has been added.');
        return redirect()->route('staff.visit.index')->with('success', 'Transaction created successfully.');
    }

    public function listForStaff()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $treatments = Transaction::with('pasien', 'service')->get();

        return view('transactions.staff.index', compact('treatments', 'nama', 'role'));
    }

    // TINDAKAN DOKTER
    public function listForDoctor()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $treatments = Transaction::where('doctor_id', Auth::id())->where('status', 'open')->with('pasien', 'service')->get();
        
        return view('transactions.index', compact('treatments', 'nama', 'role'));
    }

    public function data(Request $request)
    {
        $query = Transaction::with(['pasien', 'service'])
            ->where('doctor_id', Auth::id())
            ->where('status', 'open');

        return DataTables::of($query)
            ->addColumn('pasien_name', fn($row) => $row->pasien->PasienName)
            ->addColumn('service_name', fn($row) => $row->service->ServiceName)
            ->addColumn('action', function ($row) {
                return '
                <a href="' . route('dokter.tindakan.edit', $row->id) . '" class="btn btn-sm btn-primary">
                    <i class="fas fa-stethoscope"></i> Execute Tindakan
                </a>';
            })
            ->editColumn('status', fn($row) => ucfirst($row->status))
            ->rawColumns(['action'])
            ->make(true);
    }


    public function edit(Transaction $transaction)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $drugs = Drug::where('status', '1')->get();
        
        return view('transactions.execute', compact('transaction', 'drugs','nama', 'role'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'diagnosis' => 'required|string',
            'drugs.*.drug_id' => 'required|exists:drugs,id',
            'drugs.*.quantity' => 'required|integer|min:1',
        ]);

        $transaction->update([
            'diagnosis' => $request->diagnosis,
            'status' => 'done',
        ]);

        foreach ($request->drugs as $item) {
            DrugDetail::create([
                'transaction_id' => $transaction->id,
                'pasien_id' => $transaction->pasien_id,
                'drug_id' => $item['drug_id'],
                'quantity' => $item['quantity'],
            ]);
        }
        Alert::success('Success', 'Record has been added.');
        return redirect()->route('dokter.tindakan.index')->with('success', 'Treatment executed successfully.');
    }
}
