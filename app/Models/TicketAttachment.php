<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketAttachment extends Model
{
    use HasFactory;

    protected $table = 'ticket_attachment';

    protected $fillable = [
        'ticket_id',
        'author',
        'file_ticket_attachment_name',
        'file_ticket_attachment_path',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }
}
