<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringDocumentAccessRequestForm extends Model
{
    use HasFactory;

    protected $table = 'engineering_document_access_request_form';

    protected $fillable = [
        'generator_id',
        'file_access_request_form_name',
        'file_access_request_form_path'
    ];

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'generator_id', 'id');
    }
}
