<?php

namespace App\Http\Controllers;

use App\Models\RegionDes;
use App\Models\RegionKab;
use App\Models\RegionKec;
use App\Models\RegionProv;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RegionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $regionProv = RegionProv::all();
        $regionKab = RegionKab::all();
        $regionKec = RegionKec::all();
        $regionDes = RegionDes::all();

        $lastProvId = RegionProv::max('id') ?? 0;
        $lastKabId = RegionKab::max('id') ?? 0;
        $lastKecId = RegionKec::max('id') ?? 0;
        $lastDesId = RegionDes::max('id') ?? 0;
        $nextProvId = $lastProvId + 1;
        $nextKabId = $lastKabId + 1;
        $nextKecId = $lastKecId + 1;
        $nextDesId = $lastDesId + 1;
        return view('admin.region.index', compact('regionProv', 'regionKab', 'regionKec', 'regionDes', 'nama', 'role','nextProvId','nextKabId', 'nextKecId', 'nextDesId'));
    }

    public function storeProv(Request $request)
    {
        try {
            $request->validate(['name' => 'required']);
            RegionProv::create($request->only('name', 'id'));
            Alert::success('Success', 'Province has been added.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to add province.');
        }
        return back();
    }

    public function updateProvinsi(Request $request, $id)
    {
        try {
            $request->validate(['name' => 'required']);
            RegionProv::find($id)->update($request->only('name'));
            Alert::success('Success', 'Province has been updated.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to update province.');
        }
        return back();
    }

    public function storeKab(Request $request)
    {
        try {
            $request->validate(['name' => 'required', 'id_prov' => 'required']);
            RegionKab::create($request->only('name', 'id_prov', 'id'));
            Alert::success('Success', 'City/Regency has been added.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to add city/regency.');
        }
        return back();
    }

    public function updateKabupaten(Request $request, $id)
    {
        try {
            $request->validate(['name' => 'required']);
            RegionKab::find($id)->update($request->only('name'));
            Alert::success('Success', 'City/Regency has been updated.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to update city/regency.');
        }
        return back();
    }

    public function storeKec(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'id_prov' => 'required',
                'id_kab' => 'required'
            ]);
            RegionKec::create($request->only('name', 'id_prov', 'id_kab', 'id'));
            Alert::success('Success', 'District has been added.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to add district.');
        }
        return back();
    }

    public function updateKecamatan(Request $request, $id)
    {
        try {
            $request->validate(['name' => 'required']);
            RegionKec::find($id)->update($request->only('name'));
            Alert::success('Success', 'District has been updated.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to update district.');
        }
        return back();
    }

    public function storeDes(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'id_prov' => 'required',
                'id_kab' => 'required',
                'id_kec' => 'required'
            ]);
            RegionDes::create($request->only('name', 'id_prov', 'id_kab', 'id_kec', 'id'));
            Alert::success('Success', 'Village has been added.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to add village.');
        }
        return back();
    }

    public function updateDesa(Request $request, $id)
    {
        try {
            $request->validate(['name' => 'required']);
            RegionDes::find($id)->update($request->only('name'));
            Alert::success('Success', 'Village has been updated.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to update village.');
        }
        return back();
    }

    public function destroyProv($id)
    {
        try {
            RegionProv::destroy($id);
            Alert::success('Success', 'Province has been deleted.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to delete province.');
        }
        return back();
    }

    public function destroyKab($id)
    {
        try {
            RegionKab::destroy($id);
            Alert::success('Success', 'City/Regency has been deleted.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to delete city/regency.');
        }
        return back();
    }

    public function destroyKec($id)
    {
        try {
            RegionKec::destroy($id);
            Alert::success('Success', 'District has been deleted.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to delete district.');
        }
        return back();
    }

    public function destroyDes($id)
    {
        try {
            RegionDes::destroy($id);
            Alert::success('Success', 'Village has been deleted.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to delete village.');
        }
        return back();
    }


    // data tabel
    public function dataProvinsi(Request $request)
    {
        if ($request->ajax()) {
            $data = RegionProv::select(['id', 'name']);
            return DataTables::of($data)
                ->addColumn('Action', function ($row) {
                    return '
                <div class="row d-flex align-items-center">
                    <div class="col-8">
                        <input type="text" name="name" value="' . $row->name . '" class="form-control form-control-sm" id="input-name-' . $row->id . '">
                    </div>
                    <div class="col-4 d-flex justify-content-center gap-2">
                        <a href="javascript:void(0)" onclick="submitUpdateForm(' . $row->id . ')" class="btn text-warning btn-sm update-btn" data-id="' . $row->id . '">
                            <i class="fas fa-edit"></i> Update
                        </a>
                        <a href="javascript:void(0)" onclick="submitDeleteForm(' . $row->id . ')" class="btn text-danger btn-sm delete-btn" data-id="' . $row->id . '">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
                
                <form id="update-form-' . $row->id . '" action="' . route('admin.region.provinsi.update', $row->id) . '" method="POST" style="display: none;">
                    ' . csrf_field() . '
                    <input type="hidden" name="name" id="hidden-name-' . $row->id . '">
                </form>
                
                <form id="delete-form-' . $row->id . '" action="' . route('admin.region.provinsi.destroy', $row->id) . '" method="POST" style="display: none;">
                    ' . csrf_field() . method_field('DELETE') . '
                </form>

                <script>
                function submitUpdateForm(id) {
                    var inputValue = document.getElementById("input-name-" + id).value;
                    document.getElementById("hidden-name-" + id).value = inputValue;
                    document.getElementById("update-form-" + id).submit();
                }
                
                function submitDeleteForm(id) {
                    if(confirm("Are you sure you want to delete this record?")) {
                        document.getElementById("delete-form-" + id).submit();
                    }
                }
                </script>
                ';
                })
                ->rawColumns(['Action'])
                ->make(true);
        }
    }

    public function dataKabupaten(Request $request)
    {
        if ($request->ajax()) {
            $data = RegionKab::with('prov')->select(['id', 'name', 'id_prov']);
            return datatables()->of($data)
                ->addColumn('provinsi_name', function ($row) {
                    return $row->prov ? $row->prov->name : '-';
                })
                ->addColumn('Action', function ($row) {
                    return '
                <div class="row d-flex align-items-center">
                    <div class="col-8">
                        <input type="text" name="name" value="' . $row->name . '" class="form-control form-control-sm" id="input-name-' . $row->id . '">
                    </div>
                    <div class="col-4 d-flex justify-content-center gap-2">
                        <a href="javascript:void(0)" onclick="submitUpdateForm(' . $row->id . ')" class="btn text-warning btn-sm update-btn" data-id="' . $row->id . '">
                            <i class="fas fa-edit"></i> Update
                        </a>
                        <a href="javascript:void(0)" onclick="submitDeleteForm(' . $row->id . ')" class="btn text-danger btn-sm delete-btn" data-id="' . $row->id . '">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
                
                <form id="update-form-' . $row->id . '" action="' . route('admin.region.kabupaten.update', $row->id) . '" method="POST" style="display: none;">
                    ' . csrf_field() . '
                    <input type="hidden" name="name" id="hidden-name-' . $row->id . '">
                </form>
                
                <form id="delete-form-' . $row->id . '" action="' . route('admin.region.kabupaten.destroy', $row->id) . '" method="POST" style="display: none;">
                    ' . csrf_field() . method_field('DELETE') . '
                </form>

                <script>
                function submitUpdateForm(id) {
                    var inputValue = document.getElementById("input-name-" + id).value;
                    document.getElementById("hidden-name-" + id).value = inputValue;
                    document.getElementById("update-form-" + id).submit();
                }
                
                function submitDeleteForm(id) {
                    if(confirm("Are you sure you want to delete this record?")) {
                        document.getElementById("delete-form-" + id).submit();
                    }
                }
                </script>
                ';
                })
                ->rawColumns(['Action'])
                ->make(true);
        }
    }

    public function dataKecamatan(Request $request)
    {
        if ($request->ajax()) {
            $data = RegionKec::with(['prov', 'kab'])->select(['id', 'id_prov', 'id_kab', 'name']);
            return DataTables::of($data)
                ->addColumn('kabupaten_name', function ($row) {
                    return $row->kab ? $row->kab->name : '-';
                })
                ->addColumn('provinsi_name', function ($row) {
                    return $row->prov ? $row->prov->name : '-';
                })
                ->addColumn('Action', function ($row) {
                    return '
                <div class="row d-flex align-items-center">
                    <div class="col-8">
                        <input type="text" name="name" value="' . $row->name . '" class="form-control form-control-sm" id="input-name-' . $row->id . '">
                    </div>
                    <div class="col-4 d-flex justify-content-center gap-2">
                        <a href="javascript:void(0)" onclick="submitUpdateForm(' . $row->id . ')" class="btn text-warning btn-sm update-btn" data-id="' . $row->id . '">
                            <i class="fas fa-edit"></i> Update
                        </a>
                        <a href="javascript:void(0)" onclick="submitDeleteForm(' . $row->id . ')" class="btn text-danger btn-sm delete-btn" data-id="' . $row->id . '">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
                
                <form id="update-form-' . $row->id . '" action="' . route('admin.region.kecamatan.update', $row->id) . '" method="POST" style="display: none;">
                    ' . csrf_field() . '
                    <input type="hidden" name="name" id="hidden-name-' . $row->id . '">
                </form>
                
                <form id="delete-form-' . $row->id . '" action="' . route('admin.region.kecamatan.destroy', $row->id) . '" method="POST" style="display: none;">
                    ' . csrf_field() . method_field('DELETE') . '
                </form>

                <script>
                function submitUpdateForm(id) {
                    var inputValue = document.getElementById("input-name-" + id).value;
                    document.getElementById("hidden-name-" + id).value = inputValue;
                    document.getElementById("update-form-" + id).submit();
                }
                
                function submitDeleteForm(id) {
                    if(confirm("Are you sure you want to delete this record?")) {
                        document.getElementById("delete-form-" + id).submit();
                    }
                }
                </script>
                ';
                })
                ->rawColumns(['Action'])
                ->make(true);
        }
    }

    public function dataDesa(Request $request)
    {
        if ($request->ajax()) {
            $data = RegionDes::with(['prov', 'kab', 'kec'])->select(['id', 'id_prov', 'id_kab', 'id_kec', 'name']);
            return DataTables::of($data)
                ->addColumn('kecamatan_name', function ($row) {
                    return $row->kec ? $row->kec->name : '-';
                })
                ->addColumn('kabupaten_name', function ($row) {
                    return $row->kab ? $row->kab->name : '-';
                })
                ->addColumn('provinsi_name', function ($row) {
                    return $row->prov ? $row->prov->name : '-';
                })
                ->addColumn('Action', function ($row) {
                    return '
                <div class="row d-flex align-items-center">
                    <div class="col-8">
                        <input type="text" name="name" value="' . $row->name . '" class="form-control form-control-sm" id="input-name-' . $row->id . '">
                    </div>
                    <div class="col-4 d-flex justify-content-center gap-2">
                        <a href="javascript:void(0)" onclick="submitUpdateForm(' . $row->id . ')" class="btn text-warning btn-sm update-btn" data-id="' . $row->id . '">
                            <i class="fas fa-edit"></i> Update
                        </a>
                        <a href="javascript:void(0)" onclick="submitDeleteForm(' . $row->id . ')" class="btn text-danger btn-sm delete-btn" data-id="' . $row->id . '">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
                
                <form id="update-form-' . $row->id . '" action="' . route('admin.region.desa.update', $row->id) . '" method="POST" style="display: none;">
                    ' . csrf_field() . '
                    <input type="hidden" name="name" id="hidden-name-' . $row->id . '">
                </form>
                
                <form id="delete-form-' . $row->id . '" action="' . route('admin.region.desa.destroy', $row->id) . '" method="POST" style="display: none;">
                    ' . csrf_field() . method_field('DELETE') . '
                </form>

                <script>
                function submitUpdateForm(id) {
                    var inputValue = document.getElementById("input-name-" + id).value;
                    document.getElementById("hidden-name-" + id).value = inputValue;
                    document.getElementById("update-form-" + id).submit();
                }
                
                function submitDeleteForm(id) {
                    if(confirm("Are you sure you want to delete this record?")) {
                        document.getElementById("delete-form-" + id).submit();
                    }
                }
                </script>
                ';
                })
                ->rawColumns(['Action'])
                ->make(true);
        }
    }

    // FILTER INPUT REGION DATA
    public function getKabupatenByProv($id_prov)
    {
        $kabupaten = RegionKab::where('id_prov', $id_prov)->get();
        return response()->json($kabupaten);
    }

    public function getKabupaten($id_prov)
    {
        $kabupaten = RegionKab::where('id_prov', $id_prov)->get();
        return response()->json($kabupaten);
    }

    public function getKecamatan($id_kab)
    {
        $kecamatan = RegionKec::where('id_kab', $id_kab)->get();
        return response()->json($kecamatan);
    }

}