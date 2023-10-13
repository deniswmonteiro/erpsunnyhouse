<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringDocumentRequestAboveSeventyFive extends Model
{
    use HasFactory;

    protected $table = 'engineering_document_request_above_seventy_five';

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
        'average_fp',
        'uc_installed_load_kw',
        'uc_installed_load_kva',
        'uc_demand_kw',
        'uc_demand_kva',
        'uc_input_pattern',
        'uc_power',
        'tariff_group',
        'contracted_demand_fp',
        'contracted_demand_p',
        'extension_type',
        'transformer_identification',
        'point_coordinate_x',
        'point_coordinate_y',
        'generation_type',
        'generation_details',
        'generation_framework',
        'generation_available_power',
        'generation_power',
        'generation_ok',
        'generation_voltage',
        'generation_start_date',
        'art_observation',
        'diagram_observation',
        'memo_observation',
        'electrical_observation',
        'current_stage_observation',
        'compliance_certificate_observation',
        'uc_participants_observation',
        'legal_instrument_observation',
        'aneel_observation',
        'technical_viability_observation',
        'air_substation_observation',
        'air_sheltered_observation',
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
