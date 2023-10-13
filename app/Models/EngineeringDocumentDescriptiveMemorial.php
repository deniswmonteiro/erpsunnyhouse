<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringDocumentDescriptiveMemorial extends Model
{
    use HasFactory;

    protected $table = 'engineering_document_descriptive_memorial';

    protected $fillable = [
        'generator_id',
        'file_descriptive_memorial_name',
        'file_descriptive_memorial_path'
    ];

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'generator_id', 'id');
    }
}
