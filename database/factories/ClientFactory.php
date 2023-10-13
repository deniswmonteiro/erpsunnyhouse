<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\SellerTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

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

        $titles = ['Srta.', 'Dr.', 'Sr.', 'Sra.'];

        do {
            $name = $faker_pt->name;
            $containsName = false;

            foreach ($titles as $title) {
                if (stripos($name, $title) !== false) $containsName = true;
            }

        } while ($containsName == true);

        $is_corporate = rand(0, 1) == 1;
        $cpf = $this->faker->cpf;

        if ($is_corporate) {
            $corporate_name = $faker_pt->company;
            $cnpj = $this->faker->cnpj;
        }
        
        else {
            $corporate_name = null;
            $cnpj = null;
        }

        return [
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'cpf' => $cpf,
            'cnpj' => $cnpj,
            'is_corporate' => $is_corporate,
            'corporate_name' => $corporate_name,
            'address_state' => $this->faker->stateAbbr,
            'address_city' => $faker_pt->city,
            'address_cep' => $this->faker->postcode,
            'address' => $this->faker->streetAddress,
            'address_number' => rand(0, 1) == 1 ? $this->faker->buildingNumber : $this->faker->secondaryAddress,
            'address_neighborhood' => $neighborhoods[array_rand($neighborhoods, 1)],
            'address_complement' => $this->faker->secondaryAddress,
        ];
    }
}
