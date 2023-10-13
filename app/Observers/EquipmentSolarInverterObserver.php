<?php

namespace App\Observers;

use App\Http\Controllers\LogController;
use App\Models\EquipmentSolarInverter;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentSolarInverterObserver
{
    /**
     * Handle the EquipmentSolarInverter "created" event.
     *
     * @param \App\Models\EquipmentSolarInverter $equipmentSolarInverter
     * @return void
     */
    public function created(EquipmentSolarInverter $equipmentSolarInverter)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {

            $text = 'Inversor ' .
                $equipmentSolarInverter->producer . ' - ' .
                $equipmentSolarInverter->power . 'kW - ' .
                $equipmentSolarInverter->mppt . ' MPPT - ' .
                $equipmentSolarInverter->voltage . 'V';

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
                        <strong class='text-primary'>Tipo:</strong> <strong class='text-warning'>Inversor.</strong><br>
                        <strong class='text-primary'>Equipamento: </strong> <strong class='text-danger'>$text.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);
        }
    }

    /**
     * Handle the EquipmentSolarInverter "updated" event.
     *
     * @param \App\Models\EquipmentSolarInverter $equipmentSolarInverter
     * @return void
     */
    public function updated(EquipmentSolarInverter $equipmentSolarInverter)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {
            $changes = LogController::getChangesEquipmentSolarInverter($equipmentSolarInverter);

            if (strlen($changes) > 0) {
                $request = Request::capture();
                $category = LogController::$EQUIPAMENTO;
                $ip = $request->ip();

                $text = 'Inversor ' .
                    $equipmentSolarInverter->producer . ' - ' .
                    $equipmentSolarInverter->power . 'kW - ' .
                    $equipmentSolarInverter->mppt . ' MPPT - ' .
                    $equipmentSolarInverter->voltage . 'V';

                $id = Auth::id();
                $name = Auth::user()->name;
                $now = date('d/m/Y H:i:s');

                Log::create([
                    'title' => LogController::$EQUIPAMENTO_EDITADO,
                    'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Tipo:</strong> <strong class='text-warning'>Inversor.</strong><br>
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
     * Handle the EquipmentSolarInverter "deleted" event.
     *
     * @param \App\Models\EquipmentSolarInverter $equipmentSolarInverter
     * @return void
     */
    public function deleted(EquipmentSolarInverter $equipmentSolarInverter)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {

            $request = Request::capture();
            $ip = $request->ip();

            $category = LogController::$EQUIPAMENTO;

            $text = 'Inversor ' .
                $equipmentSolarInverter->producer . ' - ' .
                $equipmentSolarInverter->power . 'kW - ' .
                $equipmentSolarInverter->mppt . ' MPPT - ' .
                $equipmentSolarInverter->voltage . 'V';

            $id = Auth::id();
            $name = Auth::user()->name;
            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$EQUIPAMENTO_DELETADO,
                'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                         <strong class='text-primary'>Tipo:</strong> <strong class='text-warning'>Inversor.</strong><br>
                        <strong class='text-primary'>Equipamento: </strong> <strong class='text-danger'>$text.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);

            // $equipmentSolarInverter->deleteContractCascade();
        }
    }

    /**
     * Handle the EquipmentSolarInverter "restored" event.
     *
     * @param \App\Models\EquipmentSolarInverter $equipmentSolarInverter
     * @return void
     */
    public function restored(EquipmentSolarInverter $equipmentSolarInverter)
    {
        //
    }

    /**
     * Handle the EquipmentSolarInverter "force deleted" event.
     *
     * @param \App\Models\EquipmentSolarInverter $equipmentSolarInverter
     * @return void
     */
    public function forceDeleted(EquipmentSolarInverter $equipmentSolarInverter)
    {
        //
    }
}
