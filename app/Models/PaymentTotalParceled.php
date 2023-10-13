<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTotalParceled extends Model
{
    use HasFactory;
    protected $table = 'payment_total_parceled';

    protected $fillable = [
        'bank_id',
        'value',
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
