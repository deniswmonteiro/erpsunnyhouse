<?php

namespace App\Observers;

use App\Http\Controllers\ContractController;
use App\Models\ContractPayment;
use App\Models\PaymentCash;
use App\Models\PaymentCustom;
use App\Models\PaymentPartialParceled;
use App\Models\PaymentTotalParceled;

class ContractPaymentObserver
{
    /**
     * Handle the ContractPayment "created" event.
     *
     * @param \App\Models\ContractPayment $contractPayment
     * @return void
     */
    public function created(ContractPayment $contractPayment)
    {
        //
    }

    /**
     * Handle the ContractPayment "updated" event.
     *
     * @param \App\Models\ContractPayment $contractPayment
     * @return void
     */
    public function updated(ContractPayment $contractPayment)
    {
        //
    }

    /**
     * Handle the ContractPayment "deleted" event.
     *
     * @param \App\Models\ContractPayment $contractPayment
     * @return void
     */
    public function deleted(ContractPayment $contractPayment)
    {
//        switch ($contractPayment->type->name) {
//            case ContractController::$PAYMENT_CASH:
//                PaymentCash::find($contractPayment->payment_id)->delete();
//                break;
//            case ContractController::$PAYMENT_PARTIAL_PARCELED:
//                PaymentPartialParceled::find($contractPayment->payment_id)->delete();
//                break;
//            case ContractController::$PAYMENT_TOTAL_PARCELED:
//                PaymentTotalParceled::find($contractPayment->payment_id)->delete();
//                break;
//            case ContractController::$PAYMENT_CUSTOM:
//                PaymentCustom::find($contractPayment->payment_id)->delete();
//                break;
//        }
    }

    /**
     * Handle the ContractPayment "restored" event.
     *
     * @param \App\Models\ContractPayment $contractPayment
     * @return void
     */
    public function restored(ContractPayment $contractPayment)
    {
        //
    }

    /**
     * Handle the ContractPayment "force deleted" event.
     *
     * @param \App\Models\ContractPayment $contractPayment
     * @return void
     */
    public function forceDeleted(ContractPayment $contractPayment)
    {
        //
    }
}
