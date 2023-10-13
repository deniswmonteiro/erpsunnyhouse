<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientContractAccount extends Model
{
    use HasFactory;

    protected $table = 'client_contract_account';

    protected $fillable = [
        'client_id',
        'contract_account_number',
        'address',
        'neighborhood',
        'city',
        'installation_number',
        'account_month',
        'file_bill_name',
        'file_bill_path',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
