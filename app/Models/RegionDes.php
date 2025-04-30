<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionDes extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'region_des';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'id_prov',
        'id_kab',
        'id_kec'
    ];

    public function prov()
    {
        return $this->belongsTo(RegionProv::class, 'id_prov', 'id');
    }

    public function kab()
    {
        return $this->belongsTo(RegionKab::class, 'id_kab', 'id');
    }

    public function kec()
    {
        return $this->belongsTo(RegionKec::class, 'id_kec', 'id');
    }
}
