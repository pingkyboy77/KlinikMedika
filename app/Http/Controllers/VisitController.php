<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class VisitController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $services = Service::orderBy('ServiceName')->get();
        return view('transactions.staff.index', compact('nama', 'role', 'services'));
    }

    public function data(Request $request)
    {
        $query = Transaction::with(['pasien', 'service'])
            ->when($request->service_id, fn($q) => $q->where('service_id', $request->service_id))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest();

        return DataTables::of($query)
            ->addColumn('pasien_name', fn($row) => $row->pasien->PasienName)
            ->addColumn('service_name', fn($row) => $row->service->ServiceName)
            ->addColumn('action', function ($row) {
                if ($row->status === 'open') {
                    return '
                    <form method="POST" action="' . route('staff.visit.cancel', $row->id) . '" class="cancel-form" style="display:inline;">
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-sm text-danger">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </form>';
                }
                return '';
            })
            ->editColumn('status', fn($row) => ucfirst($row->status))
            ->rawColumns(['action'])
            ->make(true);
    }


    public function cancel($id)
    {
        $treatment = Transaction::findOrFail($id);
        if ($treatment->status === 'open') {
            $treatment->update(['status' => 'cancel']);
        }
        return redirect()->route('staff.visit.index')->with('success', 'Treatment cancelled.');
    }
}
