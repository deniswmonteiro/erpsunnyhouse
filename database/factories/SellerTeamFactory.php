<?php

namespace Database\Factories;

use App\Models\SellerTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellerTeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SellerTeam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company
        ];
    }
}
