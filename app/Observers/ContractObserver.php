<?php

namespace App\Observers;

use App\Http\Controllers\ContractController;
use App\Http\Controllers\LogController;
use App\Models\Client;
use App\Models\Contract;
use App\Models\ContractPayment;
use App\Models\Log;
use App\Models\PaymentCash;
use App\Models\PaymentCompanyInstallment;
use App\Models\PaymentCustom;
use App\Models\PaymentPartialParceled;
use App\Models\PaymentTotalParceled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractObserver
{
    /**
     * Handle the Contract "created" event.
     *
     * @param \App\Models\Contract $contract
     * @return void
     */
    public function created(Contract $contract)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {
            $request = Request::capture();
            $ip = $request->ip();

            $category = LogController::$CONTRATO;
            $name_client = $contract->client->name;

            $id = Auth::id();
            $name = Auth::user()->name;
            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$CONTRATO_CRIADO,
                'message' => "
                    <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                    <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                    <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                    <strong class='text-primary'>Cliente: </strong> <strong class='text-danger'>$name_client.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);
        }
    }

    /**
     * Handle the Contract "updated" event.
     *
     * @param \App\Models\Contract $contract
     * @return void
     */
    public function updated(Contract $contract)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {

            $changes = LogController::getChangesContract($contract);

            if (strlen($changes) > 0) {

                $request = Request::capture();
                $ip = $request->ip();

                $category = LogController::$CONTRATO;
                $name_client = $contract->client->name;

                $id = Auth::id();
                $name = Auth::user()->name;
                $now = date('d/m/Y H:i:s');

                Log::create([
                    'title' => LogController::$CONTRATO_EDITADO,
                    'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Cliente: </strong> <strong class='text-danger'>$name_client.</strong><br>
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
     * Handle the Contract "deleted" event.
     *
     * @param \App\Models\Contract $contract
     * @return void
     */
    public function deleted(Contract $contract)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {
            $request = Request::capture();
            $ip = $request->ip();

            $category = LogController::$CONTRATO_DELETADO;

            if ($contract->client != null) {
                $name_client = $contract->client->name;
            } else {
                $name_client = session()->get('client_name');
            }

            $id = Auth::id();
            $name = Auth::user()->name;

            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$CONTRATO_DELETADO,
                'message' => "
                        <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                        <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                        <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                        <strong class='text-primary'>Cliente: </strong> <strong class='text-danger'>$name_client.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);

            $cp = ContractPayment::find($contract->payment_id);
            
            switch (ContractPayment::find($contract->payment_id)->type->name) {
                case ContractController::$PAYMENT_CASH:
                    PaymentCash::find($cp->payment_id)->delete();
                    break;

                case ContractController::$PAYMENT_PARTIAL_PARCELED:
                    PaymentPartialParceled::find($cp->payment_id)->delete();
                    break;

                case ContractController::$PAYMENT_TOTAL_PARCELED:
                    PaymentTotalParceled::find($cp->payment_id)->delete();
                    break;

                case ContractController::$PAYMENT_COMPANY_INSTALLMENT:
                    PaymentCompanyInstallment::find($cp->payment_id)->delete();
                    break;

                case ContractController::$PAYMENT_CUSTOM:
                    PaymentCustom::find($cp->payment_id)->delete();
                    break;
            }

            ContractPayment::find($contract->payment_id)->delete();
        }
    }

    /**
     * Handle the Contract "restored" event.
     *
     * @param \App\Models\Contract $contract
     * @return void
     */
    public function restored(Contract $contract)
    {
        //
    }

    /**
     * Handle the Contract "force deleted" event.
     *
     * @param \App\Models\Contract $contract
     * @return void
     */
    public function forceDeleted(Contract $contract)
    {
        //
    }
}
