<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractPayment extends Model
{
    use HasFactory;
    protected $table = 'contract_payment';

    protected $fillable = [
        'contract_id',
        'payment_type_id',
        'payment_id',
    ];

    public function type()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id', 'id');
    }
}
