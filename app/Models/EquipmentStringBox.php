<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentStringBox extends Model
{

    use HasFactory;

    protected $table = 'equipment_string_box';

    protected $fillable = [
        'id',
        'model',
        'producer',
        'datasheet_name',
        'datasheet_path'
    ];

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

    // public function deleteContractCascade()
    // {
    //     $contract_equipments = ContractEquipment::where('product_id', $this->id)->get();
    //     foreach ($contract_equipments as $contract_equipment) {
    //         $contract_id = $contract_equipment->contract_id;
    //         $contract = Contract::find($contract_id);
    //         if ($contract) {
    //             $contract->delete();
    //         }
    //         $contract_equipment->delete();
    //     }
    // }
}
