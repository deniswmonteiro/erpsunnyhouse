<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringDocumentAneel extends Model
{
    use HasFactory;

    protected $table = 'engineering_document_aneel';

    protected $fillable = [
        'generator_id',
        'file_aneel_form_name',
        'file_aneel_form_path'
    ];

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'generator_id', 'id');
    }
}
