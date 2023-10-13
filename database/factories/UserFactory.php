<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $neighborhoods = [
            'Aeroporto', 'Caruara', 'Maracajá', 'Pratinha', 'Água Boa', 'Castanheira', 'Maracangalha', 'Reduto ', 'Águas Lindas', 'Chapéu-Virado', 'Marahú', 'Sacramenta', 'Águas Negras', 'Cidade Velha', 'Marambaia', 'São Brás', 'Agulha', 'Condor', 'Marco', 'São Clemente', 'Ariramba', 'Coqueiro', 'Miramar', 'São Francisco', 'Aurá', 'Cremação', 'Montese (Terra Firme)', 'São João de Outeiro', 'Baia do Sol', 'Cruzeiro', 'Murubira', 'Souza', 'Barreiro', 'Curió - Utinga', 'Natal do Murubira Sucurijuquara', 'Batista Campos', 'Farol', 'Nazaré', 'Tapanã', 'Benguí', 'Fátima(Matinha)', 'Paracuri', 'Telégrafo', 'Bonfim', 'Guamá', 'Paraíso', 'Tenoné', 'Guanabara', 'Parque Guajará', 'Umarizal', 'Cabanagem', 'Itaiteua', 'Parque Verde', 'Campina (Comércio)'
        ];

        $faker_pt = \Faker\Factory::create('pt_BR');
        
        // Category
        $category = rand(1, 4);

        if ($category == 2) $is_engineering = 1;
        else if ($category == 3) $is_engineering = rand(0, 1);
        else $is_engineering = 0;

        // Engineer data
        if ($is_engineering) {
            $professional_title = ucwords($faker_pt->jobTitle);
            $professional_registration = $this->faker->randomNumber($nbDigits = 8, $strict = false);
            $professional_state = $this->faker->stateAbbr;
            $phone = $this->faker->phoneNumber;
            $cellphone = $this->faker->phoneNumber;
            $cep = $this->faker->postcode;
            $address = $this->faker->streetAddress;
            $number = rand(0, 1) == 1 ? $this->faker->buildingNumber : $this->faker->secondaryAddress;
            $neighborhood = $neighborhoods[array_rand($neighborhoods, 1)];
            $city = $faker_pt->city;
            $state = $this->faker->stateAbbr;
        }

        else {
            $professional_title = null;
            $professional_registration = null;
            $professional_state = null;
            $phone = null;
            $cellphone = null;
            $cep = null;
            $address = null;
            $number = null;
            $neighborhood = null;
            $city = null;
            $state = null;
        }

        return [
            'name' => $this->faker->name,
            'status' => rand(0, 1),
            'category_id' => $category,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  // Password
            'remember_token' => Str::random(10),
            'is_engineer' => $is_engineering,
            'professional_title' => $professional_title,
            'professional_registration' => $professional_registration,
            'professional_state' => $professional_state,
            'phone' => $phone,
            'cellphone' => $cellphone,
            'cep' => $cep,
            'address' => $address,
            'number' => $number,
            'neighborhood' => $neighborhood,
            'city' => $city,
            'state' => $state,
        ];
    }
}
