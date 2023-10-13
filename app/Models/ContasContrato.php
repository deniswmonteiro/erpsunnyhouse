<?php

namespace App\Models;

use App\Models\Fatura;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContasContrato extends Model
{
    use HasFactory;

    protected $table = 'contas_contratos';

    protected $fillable = [
        'client_id',
        'cod_cc',
        'apelido',
        'classificacao',
        'tipo_classificacao',
        'modalidade_tarifaria',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function deleteFaturas()
    {
        $faturas = Fatura::where('contas_contratos_id', $this->id)->get();

        foreach ($faturas as $fatura) {
            $fatura->delete();
        }
    }
}
