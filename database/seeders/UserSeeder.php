<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Seller;
use App\Models\SellerTeam;
use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User categories (ADMINISTRADOR, ENGENHARIA, OPERACIONAL and TÉCNICO)
        UserCategory::create([
            'name' => UserCategory::$ADMINISTRATOR
        ]);
        UserCategory::create([
            'name' => UserCategory::$ENGINEERING
        ]);
        UserCategory::create([
            'name' => UserCategory::$OPERATIONAL
        ]);
        UserCategory::create([
            'name' => UserCategory::$TECHNICIAN
        ]);

        // Data
        User::factory(30)->create();
        Client::factory(300)->create();
        SellerTeam::factory(30)->create();
        Seller::factory(45)->create();

        // User "ADMINISTRADOR"
        User::create([
            'name' => "User Admin",
            'status' => true,
            'category_id' => 1,
            'email' => "admin@admin.com",
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'), // password
            'remember_token' => false,
        ]);

    }
}
