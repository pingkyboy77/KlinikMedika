<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionProv extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'region_prov';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'name'
    ];

    public function kabs()
    {
        return $this->hasMany(RegionKab::class, 'id_prov', 'id');
    }

    public function kecs()
    {
        return $this->hasMany(RegionKec::class, 'id_prov', 'id');
    }

    public function dess()
    {
        return $this->hasMany(RegionDes::class, 'id_prov', 'id');
    }
}
