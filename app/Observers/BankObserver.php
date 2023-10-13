<?php

namespace App\Observers;

use App\Http\Controllers\LogController;
use App\Models\Bank;
use App\Models\Contract;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankObserver
{
    /**
     * Handle the Bank "updated" event.
     *
     * @param \App\Models\Bank $bank
     * @return void
     */
    public function updated(Bank $bank)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {
            $changes = LogController::getChangesBank($bank);

            if (strlen($changes) > 0) {
                $request = Request::capture();
                $category = LogController::$BANCO;
                $ip = $request->ip();

                $bank_name = $bank->name;
                $bank_code = $bank->code;
                $id = Auth::id();
                $name = Auth::user()->name;
                $now = date('d/m/Y H:i:s');

                Log::create([
                    'title' => LogController::$BANCO_EDITADO,
                    'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Cliente: </strong> <strong class='text-danger'>$bank_code - $bank_name.</strong><br>
                        <ul>
                            $changes
                        </ul>",
                    'ip' => $ip,
                    'category' => $category,
                    'user_id' => $id
                ]);
            }
        }


        //
    }

    /**
     * Handle the Bank "created" event.
     *
     * @param \App\Models\Bank $bank
     * @return void
     */
    public function created(Bank $bank)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {


            $request = Request::capture();
            $ip = $request->ip();

            $category = LogController::$BANCO;

            $bank_name = $bank->name;
            $bank_code = $bank->code;
            $id = Auth::id();
            $name = Auth::user()->name;
            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$BANCO_CRIADO,
                'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Banco: </strong> <strong class='text-danger'>$bank_code - $bank_name.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);
        }
    }

    /**
     * Handle the Bank "deleted" event.
     *
     * @param \App\Models\Bank $bank
     * @return void
     */
    public function deleted(Bank $bank)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {

            $request = Request::capture();
            $ip = $request->ip();

            $category = LogController::$BANCO;

            $bank_name = $bank->name;
            $bank_code = $bank->code;
            $id = Auth::id();
            $name = Auth::user()->name;
            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$BANCO_DELETADO,
                'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Banco: </strong> <strong class='text-danger'>$bank_code - $bank_name.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);
        }
    }

    /**
     * Handle the Bank "restored" event.
     *
     * @param \App\Models\Bank $bank
     * @return void
     */
    public function restored(Bank $bank)
    {
        //
    }

    /**
     * Handle the Bank "force deleted" event.
     *
     * @param \App\Models\Bank $bank
     * @return void
     */
    public function forceDeleted(Bank $bank)
    {
        //
    }
}
