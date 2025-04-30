<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'identity_number',
        'insurance_number',
        'PasienName',
        'tgl_lahir',
        'email',
        'telp',
        'alamat',
        'id_prov',
        'id_kab',
        'id_kec',
        'id_des',
        'allergy',
    ];
}

