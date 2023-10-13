<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * user_id in:
 * - Log
 */

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'category_id',
        'status',
        'password',
        'is_engineer',
        'professional_title',
        'professional_registration',
        'professional_state',
        'phone',
        'cellphone',
        'cep',
        'address',
        'number',
        'neighborhood',
        'city',
        'state',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /** User Category */
    public function category()
    {
        return $this->belongsTo(UserCategory::class, 'category_id', 'id');
    }

    /** Document Request Up to Ten */
    public function document_request_up_to_ten()
    {
        return $this->hasOne(EngineeringDocumentRequestUpToTen::class, 'user_id', 'id');
    }

    /** Ticket Responsible */
    public function ticket_responsible()
    {
        return $this->hasMany(TicketResponsible::class, 'user_id', 'id');
    }

    /** Ticket Comment Responsible */
    public function ticketCommentResponsible()
    {
        return $this->hasMany(ticketCommentResponsible::class, 'user_id', 'id');
    }

    /** Ticket Log */
    public function log()
    {
        return $this->hasMany(TicketLog::class, 'user_id', 'id');
    }
}
