<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * client_id in:
 * - Contract
 */
class Client extends Model
{
    use HasFactory;

    protected $table = 'client';

    protected $fillable = [
        'name',
        'birth_date',
        'email',
        'phone',
        'cpf',
        'cnpj',
        'is_corporate',
        'corporate_name',
        'file_cnh_name',
        'file_cnh_path',
        'file_cnpj_name',
        'file_cnpj_path',
        'file_social_contract_name',
        'file_social_contract_path',
        'file_procuration_name',
        'file_procuration_path',
        'address_state',
        'address_city',
        'address_cep',
        'address',
        'address_number',
        'address_neighborhood',
        'address_complement',
        'login',
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    public function contract_accounts()
    {
        return $this->hasMany(ClientContractAccount::class, 'client_id', 'id');
    }

    public function generator()
    {
        return $this->hasOne(EngineeringGenerator::class, 'client_id', 'id');
    }

    public function beneficiary()
    {
        return $this->hasOne(EngineeringBeneficiary::class, 'client_id', 'id');
    }

    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'contract_client_id', 'id');
    }
}
