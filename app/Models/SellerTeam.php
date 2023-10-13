<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerTeam extends Model
{
    use HasFactory;

    protected $table = 'seller_team';

    protected $fillable = [
        'id',
        'name'
    ];

    public function sellers()
    {
        return $this->hasMany(Seller::class, 'seller_team_id', 'id');
    }

    public function totalSales($start_date = null, $end_date = null)
    {
        $sellerTeam = $this->id;

        $sellers = Seller::where('seller_team_id', $sellerTeam)->get();
        $sum = 0;

        foreach ($sellers as $seller) {
            $sum += $seller->totalSales($start_date, $end_date);
//            if ($start_date != null & $end_date != null) {
//                $start_date = $start_date . ' 00:00:00';
//                $end_date = $end_date . ' 23:59:59';
//
//                $contracts = Contract::where('seller_id', $seller->id)
//                    ->whereBetween('created_at', [$start_date, $end_date])->get();
//            } else {
//                $contracts = Contract::where('seller_id', $seller->id)->get();
//            }
//
//            foreach ($contracts as $contract) {
//                $value = $contract->getValue();
//                $sum += $value;
//            }
        }

        return $sum;
    }

}

