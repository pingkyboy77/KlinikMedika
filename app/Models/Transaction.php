<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'pasien_id',
        'doctor_id',
        'service_id',
        'status',
        'diagnosis',
        'created_by',
        'updated_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->transaction_id = 'TD' . str_pad((Transaction::max('id') + 1), 5, '0', STR_PAD_LEFT);
            $model->created_by = Auth::id();
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function service()
{
    return $this->belongsTo(Service::class);
}

    public function drugDetails()
    {
        return $this->hasMany(DrugDetail::class);
    }
}
