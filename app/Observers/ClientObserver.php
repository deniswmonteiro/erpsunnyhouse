<?php

namespace App\Observers;

use App\Http\Controllers\LogController;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientObserver
{
    /**
     * Handle the Client "created" event.
     *
     * @param \App\Models\Client $client
     * @return void
     */
    public function created(Client $client)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {


            $request = Request::capture();
            $ip = $request->ip();

            $category = LogController::$CLIENTE;

            $name_user = $client->name;
            $id = Auth::id();
            $name = Auth::user()->name;
            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$CLIENTE_CRIADO,
                'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Cliente: </strong> <strong class='text-danger'>$name_user.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);
        }
    }

    /**
     * Handle the Client "updated" event.
     *
     * @param \App\Models\Client $client
     * @return void
     */
    public function updated(Client $client)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {
            $changes = LogController::getChangesClient($client);

            if (strlen($changes) > 0) {
                $request = Request::capture();
                $category = LogController::$CLIENTE;
                $ip = $request->ip();

                $name_user = $client->name;
                $id = Auth::id();
                $name = Auth::user()->name;
                $now = date('d/m/Y H:i:s');

                Log::create([
                    'title' => LogController::$CLIENTE_EDITADO,
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
     * Handle the Client "deleted" event.
     *
     * @param \App\Models\Client $client
     * @return void
     */
    public function deleted(Client $client)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {

            $request = Request::capture();
            $ip = $request->ip();

            $category = LogController::$CLIENTE;

            $name_user = $client->name;
            $id = Auth::id();
            $name = Auth::user()->name;
            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$CLIENTE_DELETADO,
                'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Cliente: </strong> <strong class='text-danger'>$name_user.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);

            // $id = $client->id;
            // $contracts = Contract::where('client_id', $id)->get();

            // foreach ($contracts as $contract) {
            //     session()->put('client_name', $client->name);
            //     $contract->delete();
            //     session()->forget('client_name');
            // }
        }
    }

    /**
     * Handle the Client "restored" event.
     *
     * @param \App\Models\Client $client
     * @return void
     */
    public function restored(Client $client)
    {
        //
    }

    /**
     * Handle the Client "force deleted" event.
     *
     * @param \App\Models\Client $client
     * @return void
     */
    public function forceDeleted(Client $client)
    {
        //
    }
}
