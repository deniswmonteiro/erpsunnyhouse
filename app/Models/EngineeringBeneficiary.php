<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringBeneficiary extends Model
{
    use HasFactory;

    protected $table = 'engineering_beneficiary';

    protected $fillable = [
        'engineering_generator_id',
        'beneficiary_effective_date_id',
        'client_id',
        'different_beneficiary_contract_account',
        'beneficiary_contract_account',
        'beneficiary_consumption_class',
        'beneficiary_rate',
        'beneficiary_address',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'engineering_generator_id', 'id');
    }

    public function beneficiary_effective_date()
    {
        return $this->belongsTo(BeneficiaryEffectiveDate::class, 'beneficiary_effective_date_id', 'id');
    }
}
