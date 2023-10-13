<?php

namespace Database\Factories;

use App\Models\Seller;
use App\Models\SellerTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seller::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $team_id = SellerTeam::all()->random()->id;

        $faker_pt = \Faker\Factory::create('pt_BR');

        $titles = ['Srta.', 'Dr.', 'Sr.', 'Sra.'];

        do {
            $name = $faker_pt->name;
            $containsName = false;
            foreach ($titles as $title) {
                if (stripos($name, $title) !== false) {
                    $containsName = true;
                }
            }

        } while ($containsName == true);

        return [
            'seller_team_id' => $team_id,
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'cep' => '66625-000',
            'address' => $this->faker->address,
            'address_number' => strval($this->faker->numberBetween(10, 100)),
            'complement' => 'Text Text Text Text Text',
        ];
    }
}
