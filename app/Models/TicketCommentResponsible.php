<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketCommentResponsible extends Model
{
    use HasFactory;

    protected $table = 'ticket_comment_responsible';

    protected $fillable = [
        'ticket_comment_id',
        'user_id'
    ];

    public function ticketComment()
    {
        return $this->belongsTo(TicketComment::class, 'ticket_comment_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
