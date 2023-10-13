<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsinaApuracao extends Model
{
    use HasFactory;

    protected $table = 'usinas_apuracao';

    protected $fillable = [
        'usinas_id',
        'mesref',
        'producao',
        'desempenho',
        'tarifa',
        'valor',
        'rendimento',
        'arvores',
        'co2',
    ];

    public function usina()
    {
        return $this->belongsTo(Usina::class, 'usinas_id', 'id');
    }
}
