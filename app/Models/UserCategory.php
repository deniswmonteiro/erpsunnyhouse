<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    use HasFactory;
    public static $ADMINISTRATOR = 'ADMINISTRADOR';
    public static $ENGINEERING = 'ENGENHARIA';
    public static $OPERATIONAL = 'OPERACIONAL';
    public static $TECHNICIAN = 'TÉCNICO';

    protected $table = 'user_category';
    protected $fillable = [
        'name'
    ];

}
