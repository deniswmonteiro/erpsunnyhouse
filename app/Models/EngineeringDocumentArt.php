<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringDocumentArt extends Model
{
    use HasFactory;

    protected $table = 'engineering_document_art';

    protected $fillable = [
        'generator_id',
        'file_art_name',
        'file_art_path'
    ];

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'generator_id', 'id');
    }
}
