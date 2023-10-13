<?php

namespace App\Observers;

use App\Http\Controllers\LogController;
use App\Models\EquipmentConnector;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentConnectorObserver
{
    /**
     * Handle the EquipmentConnector "created" event.
     *
     * @param  \App\Models\EquipmentConnector  $equipmentConnector
     * @return void
     */
    public function created(EquipmentConnector $equipmentConnector)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {
            $text = $equipmentConnector->name;
            $request = Request::capture();
            $ip = $request->ip();
            $category = LogController::$EQUIPAMENTO;
            $id = Auth::id();
            $name = Auth::user()->name;
            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$EQUIPAMENTO_CRIADO,
                'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Tipo:</strong> <strong class='text-warning'>Outros.</strong><br>
                        <strong class='text-primary'>Equipamento: </strong> <strong class='text-danger'>$text.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);
        }
    }

    /**
     * Handle the EquipmentConnector "updated" event.
     *
     * @param  \App\Models\EquipmentConnector  $equipmentConnector
     * @return void
     */
    public function updated(EquipmentConnector $equipmentConnector)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {
            $changes = LogController::getChangesEquipmentConnector($equipmentConnector);

            if (strlen($changes) > 0) {
                $request = Request::capture();
                $category = LogController::$EQUIPAMENTO;
                $ip = $request->ip();
                $text = $equipmentConnector->name;
                $id = Auth::id();
                $name = Auth::user()->name;
                $now = date('d/m/Y H:i:s');

                Log::create([
                    'title' => LogController::$EQUIPAMENTO_EDITADO,
                    'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Tipo:</strong> <strong class='text-warning'>Outros.</strong><br>
                        <strong class='text-primary'>Equipamento: </strong> <strong class='text-danger'>$text.</strong><br>
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
     * Handle the EquipmentConnector "deleted" event.
     *
     * @param  \App\Models\EquipmentConnector  $equipmentConnector
     * @return void
     */
    public function deleted(EquipmentConnector $equipmentConnector)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {
            $request = Request::capture();
            $ip = $request->ip();
            $category = LogController::$EQUIPAMENTO;
            $text = $equipmentConnector->name;
            $id = Auth::id();
            $name = Auth::user()->name;
            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$EQUIPAMENTO_DELETADO,
                'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                         <strong class='text-primary'>Tipo:</strong> <strong class='text-warning'>Outro.</strong><br>
                        <strong class='text-primary'>Equipamento: </strong> <strong class='text-danger'>$text.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);

            // $equipmentConnector->deleteContractCascade();
        }
    }

    /**
     * Handle the EquipmentConnector "restored" event.
     *
     * @param  \App\Models\EquipmentConnector  $equipmentConnector
     * @return void
     */
    public function restored(EquipmentConnector $equipmentConnector)
    {
        //
    }

    /**
     * Handle the EquipmentConnector "force deleted" event.
     *
     * @param  \App\Models\EquipmentConnector  $equipmentConnector
     * @return void
     */
    public function forceDeleted(EquipmentConnector $equipmentConnector)
    {
        //
    }
}
