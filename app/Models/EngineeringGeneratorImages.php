<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringGeneratorImages extends Model
{
    use HasFactory;

    protected $table = 'engineering_generator_images';

    protected $fillable = [
        'engineering_generator_id',
        'type',
        'name',
        'image_generator_name',
        'image_generator_path',
    ];

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'engineering_generator_id', 'id');
    }
}
