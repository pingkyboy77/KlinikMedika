<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\RegionDes;
use App\Models\RegionKab;
use App\Models\RegionKec;
use App\Models\RegionProv;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class StaffController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        return view('admin.staff.index', compact('nama', 'role'));
    }

    public function getData(Request $request)
{
    try {
        if ($request->ajax()) {
            $data = Staff::with(['provinsi', 'kabupaten', 'kecamatan', 'desa'])
                ->select('id', 'name', 'StaffID', 'email', 'telp', 'jabatan', 'status', 'foto');

            return DataTables::of($data)
                ->addIndexColumn() 
                ->addColumn('avatar', function ($row) {
                    $avatar = $row->foto ? asset('storage/staff/' . $row->foto) : asset('default-avatar.png');
                    return '<img src="' . $avatar . '" alt="' . $row->name . '" class="img-thumbnail rounded-circle" width="50" height="50">';
                })
                ->addColumn('status_badge', function ($row) {
                    // dd($row->status);
                    return $row->status === "1"
                        ? "Active"
                        : "Inactive";
                })
                    ->addColumn('action', function ($row) {
                        $viewUrl = route('admin.staff.show', $row->id);
                        $editUrl = route('admin.staff.edit', $row->id);

                        return '
                        <div class="btn-group" role="group">
                            <a href="' . $viewUrl . '" class="btn btn-sm text-info"><i class="fas fa-eye"></i> View</a>
                            <a href="' . $editUrl . '" class="btn btn-sm text-warning"><i class="fas fa-edit"></i> Edit</a>
                            <button type="button" class="btn btn-sm text-danger delete-btn" data-id="' . $row->id . '">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>';
                    })
                ->rawColumns(['avatar', 'status_badge', 'action'])
                ->make(true);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function create()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $provinsi = RegionProv::orderBy('name')->get();
        return view('admin.staff.create', compact('provinsi', 'nama', 'role'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'StaffID' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'telp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'id_prov' => 'nullable|exists:region_prov,id',
            'id_kab' => 'nullable|exists:region_kab,id',
            'id_kec' => 'nullable|exists:region_kec,id',
            'id_des' => 'nullable|exists:region_des,id',
            'jabatan' => 'required|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'tgl_masuk' => 'nullable|date',
            'tgl_keluar' => 'nullable|date',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle the image upload
        $foto = $this->uploadImage($request->file('foto'));
        // dd($foto);

        // Create staff record
        Staff::create([
            'name' => $request->name,
            'StaffID' => $request->StaffID,
            'email' => $request->email,
            'foto' => $foto,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'id_prov' => $request->id_prov,
            'id_kab' => $request->id_kab,
            'id_kec' => $request->id_kec,
            'id_des' => $request->id_des,
            'jabatan' => $request->jabatan,
            'tgl_lahir' => $request->tgl_lahir,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_keluar' => $request->tgl_keluar,
            'status' => $request->status,
        ]);
        Alert::success('Success', 'Record has been added.');
        return redirect()->route('admin.staff.index')->with('success', 'Data staff berhasil ditambahkan.');
    }

    public function show($id)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $staff = Staff::with(['provinsi', 'kabupaten', 'kecamatan', 'desa'])->findOrFail($id);
        return view('admin.staff.show', compact('staff', 'nama', 'role'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $staff = Staff::findOrFail($id);
        $provinsi = RegionProv::orderBy('name')->get();
        $kabupatens = [];
        $kecamatans = [];
        $desas = [];

        if ($staff->id_prov) {
            $kabupatens = RegionKab::where('id_prov', $staff->id_prov)->orderBy('name')->get();
        }

        if ($staff->id_kab) {
            $kecamatans = RegionKec::where('id_kab', $staff->id_kab)->orderBy('name')->get();
        }

        if ($staff->id_kec) {
            $desas = RegionDes::where('id_kec', $staff->id_kec)->orderBy('name')->get();
        }

        return view('admin.staff.edit', compact('staff', 'provinsi', 'kabupatens', 'kecamatans', 'desas', 'nama', 'role'));
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'StaffID' => 'required|string|max:255' . $id,
            'email' => 'required|email|max:255' . $id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'telp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'id_prov' => 'nullable|exists:region_prov,id',
            'id_kab' => 'nullable|exists:region_kab,id',
            'id_kec' => 'nullable|exists:region_kec,id',
            'id_des' => 'nullable|exists:region_des,id',
            'jabatan' => 'required|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'tgl_masuk' => 'nullable|date',
            'tgl_keluar' => 'nullable|date',
            'status' => 'required|in:1,0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle the image upload if a new one is provided
        $foto = $staff->foto;
        if ($request->hasFile('foto')) {
            // Delete the old image
            if ($staff->foto) {
                Storage::disk('public')->delete('staff/' . $staff->foto);
            }
            // Upload the new image
            $foto = $this->uploadImage($request->file('foto'));
        }

        // Update staff record
        $staff->update([
            'name' => $request->name,
            'StaffID' => $request->StaffID,
            'email' => $request->email,
            'foto' => $foto,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'id_prov' => $request->id_prov,
            'id_kab' => $request->id_kab,
            'id_kec' => $request->id_kec,
            'id_des' => $request->id_des,
            'jabatan' => $request->jabatan,
            'tgl_lahir' => $request->tgl_lahir,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_keluar' => $request->tgl_keluar,
            'status' => $request->status,
        ]);
        Alert::success('Success', 'Record has been Updated.');
        return redirect()->route('admin.staff.index')->with('success', 'Data staff berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $staff = Staff::findOrFail($id);

            // Delete the image file if it exists
            if ($staff->foto && Storage::disk('public')->exists('staff/' . $staff->foto)) {
                Storage::disk('public')->delete('staff/' . $staff->foto);
            }

            // Delete the staff record
            $staff->delete();

            return response()->json(['success' => 'Data staff berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus data: ' . $e->getMessage()], 500);
        }
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

    private function uploadImage($file)
    {
        $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();

        $manager = new ImageManager(new GdDriver());
        $image = $manager->read($file->getPathname());

        $image->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        Storage::disk('public')->put('staff/' . $fileName, (string) $image->encode());

        return $fileName;
    }
}
