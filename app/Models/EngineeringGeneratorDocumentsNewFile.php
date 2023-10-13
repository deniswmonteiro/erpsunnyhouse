<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringGeneratorDocumentsNewFile extends Model
{
    use HasFactory;

    protected $table = 'engineering_generator_documents_new_file';

    protected $fillable = [
        'engineering_generator_id',
        'name',
        'file_new_name',
        'file_new_path',
    ];

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'engineering_generator_id', 'id');
    }
}
