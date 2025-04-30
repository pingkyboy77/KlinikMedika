<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionKec extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'region_kec';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'id_prov',
        'id_kab'
    ];

    public function prov()
    {
        return $this->belongsTo(RegionProv::class, 'id_prov', 'id');
    }

    public function kab()
    {
        return $this->belongsTo(RegionKab::class, 'id_kab', 'id');
    }

    public function dess()
    {
        return $this->hasMany(RegionDes::class, 'id_kec', 'id');
    }
}
