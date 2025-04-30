<?php

namespace App\Http\Controllers;


use App\Models\Drug;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DrugController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        if ($request->ajax()) {
            $data = Drug::select(['id', 'DrugID', 'DrugName', 'UnitType', 'Price', 'status']);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status_badge', fn($row) => $row->status == '1' ? 'Active' : 'Inactive')
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('admin.drugs.edit', $row->id) . '" class="btn btn-sm text-warning"><i class="fas fa-edit"></i> Edit</a>
                        <form action="' . route('admin.drugs.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button class="btn btn-sm text-danger delete-btn" onclick="return confirm(\'Delete this drug?\')"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.drugs.index', compact('nama', 'role'));
    }

    public function create()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        return view('admin.drugs.create', compact('nama', 'role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'DrugID' => 'required|unique:drugs',
            'DrugName' => 'required',
            'UnitType' => 'required',
            'Price' => 'required|numeric',
            'status' => 'required|in:0,1',
        ]);

        Drug::create($request->all());

        return redirect()->route('admin.drugs.index')->with('success', 'Drug added successfully.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $drug = Drug::findOrFail($id);
        return view('admin.drugs.edit', compact('drug', 'nama', 'role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'DrugID' => 'required|unique:drugs,DrugID,' . $id,
            'DrugName' => 'required',
            'UnitType' => 'required',
            'Price' => 'required|numeric',
            'status' => 'required|in:0,1',
        ]);

        $drug = Drug::findOrFail($id);
        $drug->update($request->all());

        return redirect()->route('admin.drugs.index')->with('success', 'Drug updated successfully.');
    }

    public function destroy($id)
    {
        Drug::findOrFail($id)->delete();
        return redirect()->route('admin.drugs.index')->with('success', 'Drug deleted successfully.');
    }
}

