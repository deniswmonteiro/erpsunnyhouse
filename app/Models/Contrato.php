<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $table = 'contratos';

    protected $fillable = [
        'client_id',
        'status',
        'tipo_contrato',
        'potencia_quota',
        'qtd_kwh',
        'tempo_vigencia',
        'data_vigencia',
        'valor',
        'desconto',
        'tarifa_base',
        'meta_gestao',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
