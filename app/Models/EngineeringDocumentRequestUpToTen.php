<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringDocumentRequestUpToTen extends Model
{
    use HasFactory;

    protected $table = 'engineering_document_request_up_to_ten';

    protected $fillable = [
        'generator_id',
        'user_id',
        'client_rg',
        'client_rg_shipping_date',
        'client_phone',
        'client_cellphone',
        'branch_activity',
        'has_special_loads',
        'special_loads_details',
        'subgroup',
        'consumption_class',
        'connection_type',
        'uc_power',
        'uc_declared_load',
        'uc_circuit_breaker',
        'uc_available_power',
        'extension_type',
        'transformer_identification',
        'point_coordinate_x',
        'point_coordinate_y',
        'responsible_name',
        'responsible_phone',
        'responsible_email',
        'generation_type',
        'generation_details',
        'generation_framework',
        'generation_power',
        'generation_ok',
        'generation_voltage',
        'generation_start_date',
        'art_observation',
        'diagram_observation',
        'memo_observation',
        'compliance_certificate_observation',
        'uc_participants_observation',
        'legal_instrument_observation',
        'aneel_observation',
        'new_link_observation',
        'pattern_change_observation',
        'rent_contract_observation',
        'procuration_observation',
        'condominium_observation',
    ];

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'generator_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
