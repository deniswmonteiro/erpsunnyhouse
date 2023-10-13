<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCompanyInstallment extends Model
{
    use HasFactory;

    protected $table = 'payment_company_installment';

    protected $fillable = [
        'payment_after_by_id',
        'cash',
        'quantity_parcel',
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

    public function afterBy()
    {
        return $this->belongsTo(PaymentAfterBy::class, 'payment_after_by_id', 'id');
    }
}
