<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Http\Controllers\ContractController;

/**
 * seller_id in:
 * - Contract
 */
class Seller extends Model
{
    use HasFactory;

    protected $table = 'seller';

    protected $fillable = [
        'name',
        'email',
        'address',
        'address_number',
        'phone',
        'cep',
        'complement',
        'neighborhood',
        'city',
        'state',
        'seller_team_id',
    ];

    public function team()
    {
        return $this->belongsTo(SellerTeam::class, 'seller_team_id', 'id');
    }

    public function totalSales($start_date = null, $end_date = null)
    {
        $sum = 0;

        if ($start_date != null & $end_date != null) {
            $start_date = $start_date;
            $end_date = $end_date;

            $contracts = Contract::where('seller_id', $this->id)
                ->where('status', ContractController::$STATUS_CONCLUDED)
                ->whereBetween('contract_date', [$start_date, $end_date])
                ->get();
        }
        
        else {
            $contracts = Contract::where('seller_id', $this->id)->get();
        }

        foreach ($contracts as $contract) {
            $value = $contract->getValue();
            $sum += $value;
        }

        return $sum;
    }

    public function allContracts($start_date = null, $end_date = null, $status = null, $type = false)
    {
        $contracts = Contract::where('seller_id', $this->id);

        if ($status != null) {
            $contracts = $contracts->where('status', $status);
        }

        if ($type != false) {
            $contracts = $contracts->where('type', $type);
        }

        if ($start_date != null & $end_date != null) {
            $start_date = $start_date . ' 00:00:00';
            $end_date = $end_date . ' 23:59:59';
            $contracts = $contracts->whereBetween('contract_date', [$start_date, $end_date]);
        }

        $contracts = $contracts->get();

        return $contracts;
    }
}
