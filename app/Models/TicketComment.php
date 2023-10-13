<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    use HasFactory;

    protected $table = 'ticket_comment';

    protected $fillable = [
        'ticket_id',
        'comment_author',
        'comment_text',
        'comment_date',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    public function ticketCommentResponsible()
    {
        return $this->hasMany(TicketCommentResponsible::class, 'ticket_comment_id', 'id');
    }
}
