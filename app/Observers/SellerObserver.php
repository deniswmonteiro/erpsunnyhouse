<?php

namespace App\Observers;

use App\Http\Controllers\LogController;
use App\Models\Contract;
use App\Models\Log;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerObserver
{
    /**
     * Handle the Seller "created" event.
     *
     * @param \App\Models\Seller $seller
     * @return void
     */
    public function created(Seller $seller)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {

            $request = Request::capture();
            $ip = $request->ip();

            $category = LogController::$VENDEDOR;

            $name_user = $seller->name;
            $id = Auth::id();
            $name = Auth::user()->name;
            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$VENDEDOR_CRIADO,
                'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Vendedor: </strong> <strong class='text-danger'>$name_user.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);
        }
    }

    /**
     * Handle the Seller "updated" event.
     *
     * @param \App\Models\Seller $seller
     * @return void
     */
    public function updated(Seller $seller)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {

            $changes = LogController::getChangesSeller($seller);

            if (strlen($changes) > 0) {
                $request = Request::capture();
                $category = LogController::$VENDEDOR;
                $ip = $request->ip();

                $name_user = $seller->name;
                $id = Auth::id();
                $name = Auth::user()->name;
                $now = date('d/m/Y H:i:s');

                Log::create([
                    'title' => LogController::$VENDEDOR_EDITADO,

                    'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Cliente: </strong> <strong class='text-danger'>$name_user.</strong><br>
                        <ul>
                        $changes
                        </ul>",
                    'ip' => $ip,
                    'category' => $category,
                    'user_id' => $id
                ]);
            }
        }
    }

    /**
     * Handle the Seller "deleted" event.
     *
     * @param \App\Models\Seller $seller
     * @return void
     */
    public function deleted(Seller $seller)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {
            $request = Request::capture();
            $ip = $request->ip();

            $category = LogController::$VENDEDOR;

            $name_user = $seller->name;
            $id = Auth::id();
            $name = Auth::user()->name;
            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$VENDEDOR_DELETADO,
                'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Vendedor: </strong> <strong class='text-danger'>$name_user.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);

            // $id = $seller->id;
            // $contracts = Contract::where('seller_id', $id)->get();

            // foreach ($contracts as $contract) {
            //     $contract->delete();
            // }
        }
    }

    /**
     * Handle the Seller "restored" event.
     *
     * @param \App\Models\Seller $seller
     * @return void
     */
    public function restored(Seller $seller)
    {
        //
    }

    /**
     * Handle the Seller "force deleted" event.
     *
     * @param \App\Models\Seller $seller
     * @return void
     */
    public function forceDeleted(Seller $seller)
    {
        //
    }
}
