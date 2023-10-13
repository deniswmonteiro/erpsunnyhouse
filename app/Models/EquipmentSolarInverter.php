<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentSolarInverter extends Model
{
    use HasFactory;

    protected $table = 'equipment_solar_inverter';

    protected $fillable = [
        'id',
        'producer',
        'mppt',
        'power',
        'voltage',
        'guarantee',
        'datasheet_name',
        'datasheet_path'
    ];

    public function generator_equipment()
    {
        return $this->hasMany(EngineeringGeneratorEquipments::class, 'equipment_id', 'id');
    }

    public function contracts()
    {
        $contract_equipments = ContractEquipment::where('product_id', $this->id)->get();
        $contracts = [];
        foreach ($contract_equipments as $contract_equipment) {
            $contract_id = $contract_equipment->contract_id;
            $contract = Contract::find($contract_id);
            array_push($contracts, $contract);
        }
        return $contracts;
    }
}
