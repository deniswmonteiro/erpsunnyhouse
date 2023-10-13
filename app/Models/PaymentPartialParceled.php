<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPartialParceled extends Model
{
    use HasFactory;
    protected $table = 'payment_partial_parceled';

    protected $fillable = [
        'cash',
        'value',
        'bank_id',
        'is_signature',
    ];

    protected $dates = [
        'date_initial',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}
