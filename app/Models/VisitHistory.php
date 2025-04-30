<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'visit_id',
        'pasien_id',
        'visit_date',
        'service_id',
        'service_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->visit_id = 'VS' . str_pad((VisitHistory::max('id') + 1), 5, '0', STR_PAD_LEFT);
        });
    }

    public function getPasienNameAttribute()
    {
        return $this->pasien->PasienName;
    }
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
