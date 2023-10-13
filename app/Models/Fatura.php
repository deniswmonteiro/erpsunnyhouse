<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    use HasFactory;

    protected $table = 'faturas';

    protected $fillable = [
        'contas_contratos_id',
        'data_fatura',
        'valor_faturado',
        'valor_tarifa',
        'valor_tarifa_energia',
        'data_inicio_ciclo',
        'kwh_energia_registrada',
        'kwh_energia_compensada',
        'data_fim_ciclo',
        'kwh_faturada',
    ];

    public function contaContrato()
    {
        return $this->belongsTo(ContasContrato::class, 'contas_contratos_id', 'id');
    }
}
