<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAfterBy extends Model
{
    use HasFactory;
    protected $table = 'payment_after_by';

    protected $fillable = [
        'name',
    ];
}
