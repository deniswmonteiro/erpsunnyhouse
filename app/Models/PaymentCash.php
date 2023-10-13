<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCash extends Model
{
    use HasFactory;
    protected $table = 'payment_cash';

    protected $fillable = [
        'payment_after_by_id',
        'value',
        'value_initial',
    ];

    public function afterBy()
    {
        return $this->belongsTo(PaymentAfterBy::class, 'payment_after_by_id', 'id');
    }
}
