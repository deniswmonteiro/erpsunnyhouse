<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringGeneratorDocuments extends Model
{
    use HasFactory;

    protected $table = 'engineering_generator_documents';

    protected $fillable = [
        'engineering_generator_id',
        'file_access_request_form_name',
        'file_access_request_form_path',
        'file_art_name',
        'file_art_path',
        'file_aneel_form_name',
        'file_aneel_form_path',
        'file_data_sheet_certificates_name',
        'file_data_sheet_certificates_path',
        'file_descriptive_memorial_name',
        'file_descriptive_memorial_path',
        'file_electrical_project_name',
        'file_electrical_project_path',
    ];

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'engineering_generator_id', 'id');
    }
}
