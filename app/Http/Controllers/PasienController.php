<?php

namespace App\Http\Controllers;
use App\Models\Pasien;
use App\Models\RegionDes;
use App\Models\RegionKab;
use App\Models\RegionKec;
use App\Models\RegionProv;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;

        if ($request->ajax()) {
            $data = Pasien::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('staff.pasiens.edit', $row->id);
                    $deleteUrl = route('staff.pasiens.destroy', $row->id);
                    $treatmentUrl = route('staff.pasiens.generate-visit', ['pasien_id' => $row->id]);

                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm text-warning"><i class="fas fa-edit"></i> Edit</a> ';
                    $btn .= '<form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-sm text-danger delete-btn" onclick="return confirm(\'Are you sure?\')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                         </form> ';
                    $btn .= '<a href="' . $treatmentUrl . '" class="btn btn-sm text-info">
                            <i class="fas fa-notes-medical"></i> Generate Tindakan
                         </a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.pasiens.index', compact('nama', 'role'));
    }


    public function create()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $provinsi = RegionProv::orderBy('name')->get();
        $lastPasien = Pasien::orderBy('id', 'desc')->first();
        $newId = $lastPasien ? $lastPasien->id + 1 : 1;
        $registrationNumber = 'PS' . str_pad($newId, 5, '0', STR_PAD_LEFT);
        return view('admin.pasiens.create', compact('nama', 'role', 'provinsi', 'registrationNumber'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'identity_number' => 'required',
        'insurance_number' => 'nullable',
        'PasienName' => 'required',
        'tgl_lahir' => 'nullable|date',
        'email' => 'required|email',
        'telp' => 'nullable',
        'allergy' => 'nullable',
        'id_prov' => 'nullable',
        'id_kab' => 'nullable',
        'id_kec' => 'nullable',
        'id_des' => 'nullable',
        'alamat' => 'nullable',
    ]);

    // Generate registration number
    $lastPasien = Pasien::orderBy('id', 'desc')->first();
    $newId = $lastPasien ? $lastPasien->id + 1 : 1;
    $validated['registration_number'] = 'PS' . str_pad($newId, 5, '0', STR_PAD_LEFT);

    Pasien::create($validated);

    return redirect()->route('staff.pasiens.index')->with('success', 'Pasien berhasil ditambahkan.');
}

    public function edit(Pasien $pasien)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $provinsi = RegionProv::orderBy('name')->get();
        return view('admin.pasiens.edit', compact('pasien', 'nama', 'role', 'provinsi'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'registration_number' => 'required|unique:pasiens,registration_number,'.$pasien->id,
            'identity_number' => 'required|unique:pasiens,identity_number,'.$pasien->id,
            'insurance_number' => 'required|unique:pasiens,insurance_number,'.$pasien->id,
            'PasienName' => 'required',
            'email' => 'required|email|unique:pasiens,email,'.$pasien->id,
        ]);

        $pasien->update($request->all());

        return redirect()->route('staff.pasiens.index')
                         ->with('success','Pasien updated successfully');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()->route('staff.pasiens.index')
                         ->with('success','Pasien deleted successfully');
    }

    public function getKabupatens($id_prov)
    {
        $kabupatens = RegionKab::where('id_prov', $id_prov)->orderBy('name')->get();
        return response()->json($kabupatens);
    }

    public function getKecamatans($id_kab)
    {
        $kecamatans = RegionKec::where('id_kab', $id_kab)->orderBy('name')->get();
        return response()->json($kecamatans);
    }

    public function getDesas($id_kec)
    {
        $desas = RegionDes::where('id_kec', $id_kec)->orderBy('name')->get();
        return response()->json($desas);
    }
}
