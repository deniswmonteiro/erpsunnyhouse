<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringDocumentElectricalProject extends Model
{
    use HasFactory;

    protected $table = 'engineering_document_electrical_project';

    protected $fillable = [
        'generator_id',
        'file_electrical_project_name',
        'file_electrical_project_path'
    ];

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'generator_id', 'id');
    }
}
