<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProtocolHomologated extends Model
{
    use HasFactory;

    protected $table = 'protocol_homologated';

    protected $fillable = [
        'generator_id',
        'protocol_date',
    ];

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'generator_id', 'id');
    }
}
