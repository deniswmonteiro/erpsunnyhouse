<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsinaRateio extends Model
{
    use HasFactory;

    protected $table = 'usinas_apuracao';

    protected $fillable = [
        'usinas_id',
        'contas_contratos_id',
        'rateio',
        'vigencia',
        'ciclocreditos',
    ];

    public function usina()
    {
        return $this->belongsTo(Usina::class, 'usinas_id', 'id');
    }

    public function contaContrato()
    {
        return $this->belongsTo(ContasContrato::class, 'contas_contratos_id', 'id');
    }
}
