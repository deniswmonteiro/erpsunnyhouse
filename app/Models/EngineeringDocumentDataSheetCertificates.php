<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringDocumentDataSheetCertificates extends Model
{
    use HasFactory;

    protected $table = 'engineering_document_data_sheet_certificates';

    protected $fillable = [
        'generator_id',
        'file_data_sheet_certificates_name',
        'file_data_sheet_certificates_path'
    ];

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'generator_id', 'id');
    }
}
