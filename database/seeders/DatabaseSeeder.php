<?php

namespace Database\Seeders;

use App\Models\EquipmentOther;
use App\Models\EquipmentGenerator;
use App\Models\EquipmentSolarInverter;
use App\Models\EquipmentStringBox;
use App\Models\SellerTeam;
use App\Models\Contract;
use App\Models\LogCategory;
use App\Models\Seller;
use App\Models\UserCategory;
use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        config()->set('seeding', true);

        $this->call([
            UserSeeder::class,
            EquipmentSeeder::class,
            PaymentSeeder::class,
            ContractSeeder::class,
        ]);

        config()->set('seeding', false);
    }
}
