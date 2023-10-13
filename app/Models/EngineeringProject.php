<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringProject extends Model
{
    use HasFactory;

    protected $table = 'engineering_project';

    protected $fillable = [
        'contract_id',
        'status',
        'observation',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'id');
    }

    public function generator()
    {
        return $this->hasMany(EngineeringGenerator::class, 'engineering_project_id', 'id');
    }

    public function cost()
    {
        return $this->hasOne(ProjectCosts::class, 'engineering_project_id', 'id');
    }
}
