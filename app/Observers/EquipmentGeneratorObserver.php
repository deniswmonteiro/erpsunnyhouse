<?php

namespace App\Observers;

use App\Http\Controllers\LogController;
use App\Models\Contract;
use App\Models\EquipmentGenerator;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentGeneratorObserver
{
    /**
     * Handle the EquipmentGenerator "created" event.
     *
     * @param \App\Models\EquipmentGenerator $equipmentGenerator
     * @return void
     */
    public function created(EquipmentGenerator $equipmentGenerator)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {

            $text = 'Módulo Solar ' .
                $equipmentGenerator->producer . ' - ' .
                $equipmentGenerator->module . ' - ' .
                $equipmentGenerator->technology . ' - ' .
                $equipmentGenerator->power . 'W';

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
                        <strong class='text-primary'>Tipo:</strong> <strong class='text-warning'>Módulo Solar.</strong><br>
                        <strong class='text-primary'>Equipamento: </strong> <strong class='text-danger'>$text.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);
        }

    }

    /**
     * Handle the EquipmentGenerator "updated" event.
     *
     * @param \App\Models\EquipmentGenerator $equipmentGenerator
     * @return void
     */
    public function updated(EquipmentGenerator $equipmentGenerator)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {
            $changes = LogController::getChangesEquipmentGenerator($equipmentGenerator);

            if (strlen($changes) > 0) {
                $request = Request::capture();
                $category = LogController::$EQUIPAMENTO;
                $ip = $request->ip();

                $text = 'Módulo Solar ' .
                    $equipmentGenerator->producer . ' - ' .
                    $equipmentGenerator->module . ' - ' .
                    $equipmentGenerator->technology . ' - ' .
                    $equipmentGenerator->power . 'W';


                $id = Auth::id();
                $name = Auth::user()->name;
                $now = date('d/m/Y H:i:s');

                Log::create([
                    'title' => LogController::$EQUIPAMENTO_EDITADO,
                    'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Tipo:</strong> <strong class='text-warning'>Módulo Solar.</strong><br>
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
     * Handle the EquipmentGenerator "deleted" event.
     *
     * @param \App\Models\EquipmentGenerator $equipmentGenerator
     * @return void
     */
    public function deleted(EquipmentGenerator $equipmentGenerator)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {

            $request = Request::capture();
            $ip = $request->ip();

            $category = LogController::$EQUIPAMENTO;

            $text = 'Módulo Solar ' .
                $equipmentGenerator->producer . ' - ' .
                $equipmentGenerator->module . ' - ' .
                $equipmentGenerator->technology . ' - ' .
                $equipmentGenerator->power . 'W';


            $id = Auth::id();
            $name = Auth::user()->name;
            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$EQUIPAMENTO_DELETADO,
                'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                         <strong class='text-primary'>Tipo:</strong> <strong class='text-warning'>Módulo Solar.</strong><br>
                        <strong class='text-primary'>Equipamento: </strong> <strong class='text-danger'>$text.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);

            // $equipmentGenerator->deleteContractCascade();
        }
    }

    /**
     * Handle the EquipmentGenerator "restored" event.
     *
     * @param \App\Models\EquipmentGenerator $equipmentGenerator
     * @return void
     */
    public function restored(EquipmentGenerator $equipmentGenerator)
    {
        //
    }

    /**
     * Handle the EquipmentGenerator "force deleted" event.
     *
     * @param \App\Models\EquipmentGenerator $equipmentGenerator
     * @return void
     */
    public function forceDeleted(EquipmentGenerator $equipmentGenerator)
    {
        //
    }
}
