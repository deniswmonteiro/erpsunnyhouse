<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usina extends Model
{
    use HasFactory;

    protected $table = 'usinas';

    protected $fillable = [
        'contas_contratos_id',
        'nome',
        'apelido',
        'documento',
        'login',
        'senha',
        'producaoMeta',
        'diaLeitura',
        'ciclo',
        'investimento',
    ];

    public function contaContrato()
    {
        return $this->belongsTo(ContasContrato::class, 'contas_contratos_id', 'id');
    }
}
