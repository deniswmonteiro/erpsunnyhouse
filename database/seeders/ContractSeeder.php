<?php

namespace Database\Seeders;

use App\Http\Controllers\ContractController;
use App\Models\Bank;
use App\Models\Contract;
use App\Models\ContractPayment;
use App\Models\ContractEquipment;
use App\Models\EquipmentGenerator;
use App\Models\EquipmentCable;
use App\Models\EquipmentConnector;
use App\Models\EquipmentSolarInverter;
use App\Models\EquipmentStringBox;
use App\Models\PaymentCash;
use App\Models\PaymentCustom;
use App\Models\PaymentPartialParceled;
use App\Models\PaymentTotalParceled;
use App\Models\PaymentType;
use Illuminate\Database\Seeder;
use DateTime;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contract::factory(180)->create();

        $contracts = Contract::all();
//        $datestart = DateTime::createFromFormat('d/m/Y', '01/01/2020')->getTimestamp();
//        $dateend = DateTime::createFromFormat('d/m/Y', '31/12/2022')->getTimestamp();
        $faker_pt = \Faker\Factory::create('pt_BR');


        foreach ($contracts as $contract) {
//            $timestamp = rand($datestart, $dateend);
//            $timestamp_end = strtotime('+60 day', $timestamp);
//            $date = (new DateTime())->setTimestamp($timestamp_end);

            if ($contract->generator_structure != null) {
                $generator = EquipmentGenerator::all()->random();
                $stringBox = EquipmentStringBox::all()->random();
                $cable = EquipmentCable::all()->random();
                $connector = EquipmentConnector::all()->random();
                $solarInverter = EquipmentSolarInverter::all()->random();

                ContractEquipment::create([
                    'contract_id' => $contract->id,
                    'product_id' => $generator->id,
                    'type' => 'GENERATOR',
                    'quantity' => strval(rand(15, 50))
                ]);

                ContractEquipment::create([
                    'contract_id' => $contract->id,
                    'product_id' => $stringBox->id,
                    'type' => 'STRING_BOX',
                    'quantity' => strval(rand(1, 5))
                ]);

                ContractEquipment::create([
                    'contract_id' => $contract->id,
                    'product_id' => $cable->id,
                    'type' => 'CABLE',
                    'quantity' => 1 . ' KIT'
                ]);

                ContractEquipment::create([
                    'contract_id' => $contract->id,
                    'product_id' => $connector->id,
                    'type' => 'CONNECTOR',
                    'quantity' => 1 . ' KIT'
                ]);

                ContractEquipment::create([
                    'contract_id' => $contract->id,
                    'product_id' => $solarInverter->id,
                    'type' => 'SOLAR_INVERTER',
                    'quantity' => strval(rand(1, 10))
                ]);
            }
        }
    }
}
