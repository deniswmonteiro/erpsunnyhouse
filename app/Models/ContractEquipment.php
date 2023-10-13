<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractEquipment extends Model
{
    use HasFactory;
    protected $table = 'contract_equipment';

    protected $fillable = [
        'contract_id',
        'product_id',
        'type',
        'quantity',
    ];

}
