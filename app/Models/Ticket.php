<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'ticket';

    protected $fillable = [
        'contract_client_id',
        'title',
        'status',
        'description',
        'type',
        'deadline',
        'requester',
        'is_contract',
    ];

    public function attachment()
    {
        return $this->hasMany(TicketAttachment::class, 'ticket_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(TicketComment::class, 'ticket_id', 'id');
    }

    public function log()
    {
        return $this->hasMany(TicketLog::class, 'ticket_id', 'id');
    }

    public function responsible()
    {
        return $this->hasMany(TicketResponsible::class, 'ticket_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'contract_client_id', 'id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_client_id', 'id');
    }
}
