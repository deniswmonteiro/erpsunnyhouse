<?php

namespace App\Models;

use App\Http\Controllers\ContractController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table = 'bank';

    protected $fillable = [
        'code',
        'name',
    ];

    public function contracts()
    {
        $bankPartialParceled = PaymentPartialParceled::where('bank_id', $this->id)->get();
        $bankTotalParceled = PaymentTotalParceled::where('bank_id', $this->id)->get();
        $bankCompanyInstallment = PaymentCompanyInstallment::where('bank_id', $this->id)->get();
        $contracts = [];

        foreach ($bankPartialParceled as $item) {
            $id_type = PaymentType::where('name', ContractController::$PAYMENT_PARTIAL_PARCELED)->first()->id;
            $contract_payment = ContractPayment::where('payment_type_id', $id_type)
                ->where('payment_id', $item->id)->get();

            foreach ($contract_payment as $payment) {
                $contract = Contract::where('payment_id', $payment->id)->first();
                array_push($contracts, $contract);
            }
        }

        foreach ($bankTotalParceled as $item) {
            $id_type = PaymentType::where('name', ContractController::$PAYMENT_TOTAL_PARCELED)->first()->id;
            $contract_payment = ContractPayment::where('payment_type_id', $id_type)
                ->where('payment_id', $item->id)->get();

            foreach ($contract_payment as $payment) {
                $contract = Contract::where('payment_id', $payment->id)->first();
                array_push($contracts, $contract);
            }
        }

        foreach ($bankCompanyInstallment as $item) {
            $id_type = PaymentType::where('name', ContractController::$PAYMENT_COMPANY_INSTALLMENT)->first()->id;
            $contract_payment = ContractPayment::where('payment_type_id', $id_type)
                ->where('payment_id', $item->id)->get();

            foreach ($contract_payment as $payment) {
                $contract = Contract::where('payment_id', $payment->id)->first();
                array_push($contracts, $contract);
            }
        }

        return $contracts;
    }

    // public function deleteContractCascade()
    // {
    //     $bankPartialParceled = PaymentPartialParceled::where('bank_id', $this->id)->get();
    //     $bankTotalParceled = PaymentTotalParceled::where('bank_id', $this->id)->get();
    //     $bankCompanyInstallment = PaymentCompanyInstallment::where('bank_id', $this->id)->get();

    //     foreach ($bankPartialParceled as $item) {
    //         $id_type = PaymentType::where('name', ContractController::$PAYMENT_PARTIAL_PARCELED)->first()->id;
    //         $contract_payment = ContractPayment::where('payment_type_id', $id_type)
    //             ->where('payment_id', $item->id)->get();
            
    //         foreach ($contract_payment as $payment) {
    //             $contract = Contract::where('payment_id', $payment->id)->first();
    //             $contract->delete();
    //             $payment->delete();
    //         }
    //     }

    //     foreach ($bankTotalParceled as $item) {
    //         $id_type = PaymentType::where('name', ContractController::$PAYMENT_TOTAL_PARCELED)->first()->id;
    //         $contract_payment = ContractPayment::where('payment_type_id', $id_type)
    //             ->where('payment_id', $item->id)->get();
            
    //         foreach ($contract_payment as $payment) {
    //             $contract = Contract::where('payment_id', $payment->id)->first();
    //             $contract->delete();
    //             $payment->delete();
    //         }
    //     }

    //     foreach ($bankCompanyInstallment as $item) {
    //         $id_type = PaymentType::where('name', ContractController::$PAYMENT_COMPANY_INSTALLMENT)->first()->id;
    //         $contract_payment = ContractPayment::where('payment_type_id', $id_type)
    //             ->where('payment_id', $item->id)->get();
            
    //         foreach ($contract_payment as $payment) {
    //             $contract = Contract::where('payment_id', $payment->id)->first();
    //             $contract->delete();
    //             $payment->delete();
    //         }
    //     }
    // }
}
