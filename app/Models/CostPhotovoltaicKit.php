<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostPhotovoltaicKit extends Model
{
    use HasFactory;

    protected $table = 'cost_photovoltaic_kit';

    protected $fillable = [
        'project_costs_id',
        'solar_inverter_id',
        'description',
        'value',
        'date',
        'structure',
        'input_pattern',
    ];

    public function cost()
    {
        return $this->belongsTo(ProjectCosts::class, 'project_costs_id', 'id');
    }

    public function solar_inverter()
    {
        return $this->hasOne(EquipmentSolarInverter::class, 'solar_inverter_id', 'id');
    }
}
