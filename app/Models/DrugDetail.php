<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'drug_detail_id',
        'transaction_id',
        'pasien_id',
        'drug_id',
        'quantity',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->drug_detail_id = 'DG' . str_pad((DrugDetail::max('id') + 1), 5, '0', STR_PAD_LEFT);
        });
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }
}
