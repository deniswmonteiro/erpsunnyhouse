<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringGeneratorEquipments extends Model
{
    use HasFactory;

    protected $table = 'engineering_generator_equipments';

    protected $fillable = [
        'engineering_generator_id',
        'equipment_id',
        'name',
        'quantity',
        'type',
    ];

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'engineering_generator_id', 'id');
    }

    public function equipment()
    {
        return $this->belongsTo(EquipmentSolarInverter::class, 'equipment_id', 'id');
    }
}
