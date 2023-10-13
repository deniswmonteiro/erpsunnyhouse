<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiaryEffectiveDate extends Model
{
    use HasFactory;

    protected $table = 'beneficiary_effective_date';

    protected $fillable = [
        'generator_id',
        'effective_date',
        'status',
    ];

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'generator_id', 'id');
    }

    public function beneficiary()
    {
        return $this->hasMany(EngineeringBeneficiary::class, 'beneficiary_effective_date_id', 'id');
    }
}
