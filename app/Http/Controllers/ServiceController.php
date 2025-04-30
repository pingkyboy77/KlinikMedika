<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        if ($request->ajax()) {
            $data = Service::select(['id', 'ServicesID', 'ServiceName', 'Price', 'status']);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status_badge', fn($row) => $row->status === "1" ? "Active" : "Inactive")
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('admin.services.edit', $row->id) . '" class="btn btn-sm text-warning"><i class="fas fa-edit"></i> Edit</a>
                        <button class="btn btn-sm text-danger delete-btn" data-id="' . $row->id . '"> <i class="fas fa-trash"></i> Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.services.index', compact('nama', 'role'));
    }

    public function create()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        return view('admin.services.create', compact('nama', 'role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ServicesID' => 'required|unique:services',
            'ServiceName' => 'required',
            'status' => 'required|in:0,1',
        ]);

        Service::create($request->all());
        Alert::success('Success', 'Record has been added.');
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service', 'nama', 'role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ServicesID' => 'required|unique:services,ServicesID,' . $id,
            'ServiceName' => 'required',
            'Price' => 'required',
            'status' => 'required|in:0,1',
        ]);

        $service = Service::findOrFail($id);

        // Hapus koma dari nilai harga
        $price = str_replace(',', '', $request->Price);

        $service->update([
            'ServicesID' => $request->ServicesID,
            'ServiceName' => $request->ServiceName,
            'Price' => $price,
            'status' => $request->status,
        ]);
        Alert::success('Success', 'Record has been Updated.');
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }


    public function destroy($id)
    {
        Service::destroy($id);
        return response()->json(['success' => 'Service deleted successfully.']);
    }
}

