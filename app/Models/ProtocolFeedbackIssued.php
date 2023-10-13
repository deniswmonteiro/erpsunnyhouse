<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProtocolFeedbackIssued extends Model
{
    use HasFactory;

    protected $table = 'protocol_feedback_issued';

    protected $fillable = [
        'generator_id',
        'protocol_number',
        'protocol_date',
    ];

    public function generator()
    {
        return $this->belongsTo(EngineeringGenerator::class, 'generator_id', 'id');
    }
}
