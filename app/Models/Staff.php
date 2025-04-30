<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'name',
        'StaffID',
        'tgl_lahir',
        'email',
        'foto',
        'telp',
        'alamat',
        'id_prov',
        'id_kab',
        'id_kec',
        'id_des',
        'jabatan',
        'tgl_masuk',
        'tgl_keluar',
        'status',
    ];

    protected $dates = [
        'tgl_lahir',
        'tgl_masuk',
        'tgl_keluar',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the province related to the staff.
     */
    public function provinsi()
    {
        return $this->belongsTo(RegionProv::class, 'id_prov');
    }

    /**
     * Get the kabupaten related to the staff.
     */
    public function kabupaten()
    {
        return $this->belongsTo(RegionKab::class, 'id_kab');
    }

    /**
     * Get the kecamatan related to the staff.
     */
    public function kecamatan()
    {
        return $this->belongsTo(RegionKec::class, 'id_kec');
    }

    /**
     * Get the desa related to the staff.
     */
    public function desa()
    {
        return $this->belongsTo(RegionDes::class, 'id_des');
    }

    /**
     * Get the full address of the staff.
     */
    public function getFullAddressAttribute()
    {
        $address = $this->alamat ?? '';

        if ($this->desa) {
            $address .= ', ' . $this->desa->name;
        }

        if ($this->kecamatan) {
            $address .= ', ' . $this->kecamatan->name;
        }

        if ($this->kabupaten) {
            $address .= ', ' . $this->kabupaten->name;
        }

        if ($this->provinsi) {
            $address .= ', ' . $this->provinsi->name;
        }

        return $address;
    }
}