<?php

namespace Database\Factories;

use App\Http\Controllers\ContractController;
use App\Models\Bank;
use App\Models\Client;
use App\Models\Contract;
use App\Models\ContractPayment;
use App\Models\PaymentAfterBy;
use App\Models\PaymentCash;
use App\Models\PaymentCompanyInstallment;
use App\Models\PaymentCustom;
use App\Models\PaymentPartialParceled;
use App\Models\PaymentTotalParceled;
use App\Models\PaymentType;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use DateTime;

class ContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $seller_id = Seller::all()->random()->id;
        $client_id = Client::all()->random()->id;
        $start = date("d/m/Y", strtotime(date("Y-m-d") . "-12 month"));
        $today = date("d/m/Y", strtotime(date("Y-m-d")));

        $datestart = DateTime::createFromFormat('d/m/Y', $start)->getTimestamp();
        $dateend = DateTime::createFromFormat('d/m/Y', $today)->getTimestamp();

        $timestamp = rand($datestart, $dateend);
//        $timestamp_end = strtotime('+90 day', $timestamp);
//        $timestamp_n = strtotime('+' . (rand(1, 3) * 30) . ' day', $timestamp);

        $date = (new DateTime())->setTimestamp($timestamp);
//        $date_end = (new DateTime())->setTimestamp($timestamp_end);

        $installation_deadline = (new DateTime())->setTimestamp(strtotime('+90 day', $timestamp));

        $type = strval(rand(1, 2));

        $status_list = [
            ContractController::$STATUS_BUDGET,
            ContractController::$STATUS_HIRED,
            ContractController::$STATUS_ACTIVE,
            ContractController::$STATUS_PENDENCY,
            ContractController::$STATUS_INSTALLING,
            ContractController::$STATUS_INSTALLED,
            ContractController::$STATUS_CONCLUDED,
            ContractController::$STATUS_CANCELED,
        ];

        $status = array_rand($status_list, 1);

        $faker_pt = \Faker\Factory::create('pt_BR');

        $payments = [
            ContractController::$PAYMENT_CASH,
            ContractController::$PAYMENT_PARTIAL_PARCELED,
            ContractController::$PAYMENT_TOTAL_PARCELED,
            ContractController::$PAYMENT_COMPANY_INSTALLMENT,
            ContractController::$PAYMENT_CUSTOM,
        ];

        $cash = rand(2000, 12000);
        $quantity = rand(1, 3) * 12;
        $parcel = rand(1700, 2000);
        $value = $cash + ($parcel * $quantity);
        $profit_estimate = rand(1, 100);
        $bank = Bank::all()->random();
        $text = $faker_pt->text;
        $payment_after_by = PaymentAfterBy::all();

        $payment_selected = $payments[rand(0, 4)];
        $payment_type = PaymentType::where('name', $payment_selected)->first();

        switch ($payment_selected) {
            case ContractController::$PAYMENT_CASH:
                $payment = PaymentCash::create([
                    'value' => $value,
                    'value_initial' => $value * 0.2,
                    'payment_after_by_id' => $payment_after_by[rand(1, 2)]->id
                ]);
                break;

            case ContractController::$PAYMENT_PARTIAL_PARCELED:
                $payment = PaymentPartialParceled::create([
                    'cash' => $cash,
                    'value' => $value,
                    'bank_id' => (rand(1, 10) > 3) ? $bank->id : null,
                ]);
                break;

            case ContractController::$PAYMENT_TOTAL_PARCELED:
                $payment = PaymentTotalParceled::create([
                    'value' => $value,
                    'bank_id' => (rand(1, 10) > 3) ? $bank->id : null,
                ]);
                break;
            
            case ContractController::$PAYMENT_COMPANY_INSTALLMENT:
                $payment = PaymentCompanyInstallment::create([
                    'quantity_parcel' => $quantity,
                    'cash' => $cash,
                    'value' => $value,
                    'bank_id' => (rand(1, 10) > 3) ? $bank->id : null,
                    'payment_after_by_id' => $payment_after_by[rand(0, 2)]->id
                ]);
                break;

            case ContractController::$PAYMENT_CUSTOM:
                $payment = PaymentCustom::create([
                    'value' => $value,
                    'text' => $text,
                ]);
                break;
        }

        // payment_type_id, payment_id
        $contract_payment = ContractPayment::create([
            'payment_type_id' => $payment_type->id,
            'payment_id' => $payment->id
        ]);

        return [
            'seller_id' => $seller_id,
            'client_id' => $client_id,
            'payment_id' => $contract_payment->id,
            'status' => $status_list[$status],
            'description' => $this->faker->text,
            'profit_estimate' => $profit_estimate,
            'type' => $type,
            'contract_date' => $date,
            'installation_deadline' => $installation_deadline,

            'generator_structure' => ($type == 1) ? strval(rand(1, 4)) : null,
            'area' => ($type == 1) ? strval(rand(10, 60)) : null,
            'monthly_avg_generation' => ($type == 1) ? strval(rand(300, 800)) : null,

            'created_at' => $date,
            'updated_at' => $date
        ];
    }
}
