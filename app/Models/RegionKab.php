<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionKab extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'region_kab';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'id_prov'
    ];

    public function prov()
    {
        return $this->belongsTo(RegionProv::class, 'id_prov', 'id');
    }

    public function kecs()
    {
        return $this->hasMany(RegionKec::class, 'id_kab', 'id');
    }

    public function dess()
    {
        return $this->hasMany(RegionDes::class, 'id_kab', 'id');
    }
}
