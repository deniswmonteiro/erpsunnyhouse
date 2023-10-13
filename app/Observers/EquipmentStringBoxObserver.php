<?php

namespace App\Observers;

use App\Http\Controllers\LogController;
use App\Models\EquipmentStringBox;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentStringBoxObserver
{
    /**
     * Handle the EquipmentStringBox "created" event.
     *
     * @param \App\Models\EquipmentStringBox $equipmentStringBox
     * @return void
     */
    public function created(EquipmentStringBox $equipmentStringBox)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {

            $text = 'String Box ' . $equipmentStringBox->producer . ' ' . $equipmentStringBox->model;

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
                        <strong class='text-primary'>Tipo:</strong> <strong class='text-warning'>String Box.</strong><br>
                        <strong class='text-primary'>Equipamento: </strong> <strong class='text-danger'>$text.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);
        }

    }

    /**
     * Handle the EquipmentStringBox "updated" event.
     *
     * @param \App\Models\EquipmentStringBox $equipmentStringBox
     * @return void
     */
    public function updated(EquipmentStringBox $equipmentStringBox)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {
            $changes = LogController::getChangesEquipmentStringBox($equipmentStringBox);

            if (strlen($changes) > 0) {
                $request = Request::capture();
                $category = LogController::$EQUIPAMENTO;
                $ip = $request->ip();

                $text = 'String Box ' . $equipmentStringBox->producer . ' ' . $equipmentStringBox->model;

                $id = Auth::id();
                $name = Auth::user()->name;
                $now = date('d/m/Y H:i:s');

                Log::create([
                    'title' => LogController::$EQUIPAMENTO_EDITADO,
                    'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Tipo:</strong> <strong class='text-warning'>String Box.</strong><br>
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
     * Handle the EquipmentStringBox "deleted" event.
     *
     * @param \App\Models\EquipmentStringBox $equipmentStringBox
     * @return void
     */
    public function deleted(EquipmentStringBox $equipmentStringBox)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {

            $request = Request::capture();
            $ip = $request->ip();

            $category = LogController::$EQUIPAMENTO;

            $text = 'String Box ' . $equipmentStringBox->producer . ' ' . $equipmentStringBox->model;

            $id = Auth::id();
            $name = Auth::user()->name;
            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$EQUIPAMENTO_DELETADO,
                'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                         <strong class='text-primary'>Tipo:</strong> <strong class='text-warning'>String Box.</strong><br>
                        <strong class='text-primary'>Equipamento: </strong> <strong class='text-danger'>$text.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);

            // $equipmentStringBox->deleteContractCascade();
        }
    }

    /**
     * Handle the EquipmentStringBox "restored" event.
     *
     * @param \App\Models\EquipmentStringBox $equipmentStringBox
     * @return void
     */
    public function restored(EquipmentStringBox $equipmentStringBox)
    {
        //
    }

    /**
     * Handle the EquipmentStringBox "force deleted" event.
     *
     * @param \App\Models\EquipmentStringBox $equipmentStringBox
     * @return void
     */
    public function forceDeleted(EquipmentStringBox $equipmentStringBox)
    {
        //
    }
}
