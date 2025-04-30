<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BillingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $services = Service::orderBy('ServiceName')->get();
        return view('transactions.kasir.index', compact('nama', 'role', 'services'));
    }

    public function data(Request $request)
    {
        $query = Transaction::with(['pasien', 'service'])
            ->whereIn('status', ['done', 'printed'])
            ->when($request->service_id, fn($q) => $q->where('service_id', $request->service_id))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest();

        return DataTables::of($query)
            ->addColumn('pasien_name', fn($row) => $row->pasien->PasienName)
            ->addColumn('service_name', fn($row) => $row->service->ServiceName)
            ->editColumn('status', fn($row) => ucfirst($row->status))
            ->addColumn('action', function ($row) {
                $btn = '';

                if ($row->status === 'done') {
                    $btn .= '<a href="' . route('kasir.billing.print', $row->id) . '" class="btn btn-sm btn-info" target="_blank">
                <i class="fas fa-print"></i> Print Bill
            </a>';
                }


                if ($row->status === 'printed') {
                    $btn .=
                        '<form action="' .
                        route('kasir.billing.confirm', $row->id) .
                        '" method="POST" class="d-inline confirm-payment-form">
                            ' .
                        csrf_field() .
                        '
                            <button type="submit" class="btn btn-sm btn-success btn-confirm-payment">
                                <i class="fas fa-check-circle"></i> Confirm Payment
                            </button>
                        </form>';
                }

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function printBill($id)
    {
        $transaction = Transaction::with(['pasien', 'service', 'drugDetails.drug'])->findOrFail($id);

        if ($transaction->status === 'done') {
            $transaction->status = 'printed';
            $transaction->save();
        }

        $pdf = Pdf::loadView('transactions.kasir.bill', compact('transaction'));
        return $pdf->download('Bill_' . $transaction->transaction_id . '.pdf');
    }
    // public function printBill($id)
    // {
    //     $transaction = Transaction::with(['service', 'pasien', 'drugDetails.drug'])->findOrFail($id);

    //     // Hitung total harga: service + drugs
    //     $servicePrice = $transaction->service->Price ?? 0;
    //     $drugTotal = $transaction->drugDetails->sum(function ($item) {
    //         return $item->quantity * ($item->drug->Price ?? 0);
    //     });

    //     $total = $servicePrice + $drugTotal;

    //     return view('transactions.kasir.bill', compact('transaction', 'servicePrice', 'drugTotal', 'total'));
    // }

    public function confirmPayment(Request $request, $id)
    {

        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'paid';
        $transaction->save();

        return redirect()->route('kasir.billing.index')->with('success', 'Payment confirmed successfully!');
    }
}
