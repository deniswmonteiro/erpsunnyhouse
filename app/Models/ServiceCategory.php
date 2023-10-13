<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;
    public static $PRESTADOR = 'PRESTADOR';
    public static $EQUIPAMENTO = 'EQUIPAMENTO';
    public static $MATERIAL = 'MATERIAL';

    protected $table = 'service_category';
    protected $fillable = [
        'name'
    ];

}
