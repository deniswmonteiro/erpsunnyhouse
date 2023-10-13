<?php

namespace Tests\Feature\RouteAccess;

use App\Models\Contract;
use Tests\TestCase;

class RouteContractTest extends TestCase
{

    /**
     * A view contracts_index feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_contracts_index_without_login()
    {
        $response = $this->getJson(route('contracts_index'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view contracts_create feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_contracts_create_without_login()
    {
        $response = $this->getJson(route('contracts_create'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view contracts_store feature test.
     *
     * @return void
     */
    public function test_cannot_submit_a_form_to_contracts_store_without_login()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $contracts_store = [
            'status' => '',

            'seller_id' => 1,
            'client_id' => 1,
            'payment_id' => 1,
            'type' => 1,
            'phone' => $faker->phoneNumber,
            'description' => $faker->text,

            'contract_name' => $faker->name . ' ' . $faker->lastName,
            'address_state' => $faker->stateAbbr,
            'address_city' => $faker->city,
            'address_cep' => $faker->postcode,
            'address' => $faker->streetAddress,
            'address_number' => rand(0, 1) == 1 ? $faker->buildingNumber : $faker->secondaryAddress,
            'address_neighborhood' => '',
            'address_complement' => $faker->secondaryAddress,

            'generator_structure' => strval(rand(1, 4)),
            'area' => strval(rand(10, 60)),
            'monthly_avg_generation' => strval(rand(300, 800))
        ];
        $response = $this->postJson(route('contracts_store'), $contracts_store);
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view contracts_edit feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_contracts_edit_without_login()
    {
        $id = Contract::first()->id;

        $response = $this->getJson(route('contracts_edit', ['id' => encrypt($id)]));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view contracts_show feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_contracts_show_without_login()
    {
        $id = Contract::first()->id;

        $response = $this->getJson(route('contracts_show', ['id' => encrypt($id)]));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view contracts_update feature test.
     *
     * @return void
     */
    public function test_cannot_submit_a_form_to_contracts_update_without_login()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $contracts_update = [
            'status' => '',

            'seller_id' => 1,
            'client_id' => 1,
            'payment_id' => 1,
            'type' => 1,
            'phone' => $faker->phoneNumber,
            'description' => $faker->text,

            'contract_name' => $faker->name . ' ' . $faker->lastName,
            'address_state' => $faker->stateAbbr,
            'address_city' => $faker->city,
            'address_cep' => $faker->postcode,
            'address' => $faker->streetAddress,
            'address_number' => rand(0, 1) == 1 ? $faker->buildingNumber : $faker->secondaryAddress,
            'address_neighborhood' => '',
            'address_complement' => $faker->secondaryAddress,

            'generator_structure' => strval(rand(1, 4)),
            'area' => strval(rand(10, 60)),
            'monthly_avg_generation' => strval(rand(300, 800))
        ];


        $id = Contract::all()->random()->id;
        $response = $this->postJson(route('contracts_update', ['id' => encrypt($id)]), $contracts_update);
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view contracts_destroy feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_contracts_destroy_without_login()
    {
        $id = Contract::first()->id;

        $response = $this->postJson(route('contracts_destroy', ['id' => encrypt($id)]));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view contracts_user_address feature test.
     *
     * @return void
     */
    public function test_cannot_access_ajax_contracts_user_address_without_login()
    {

        $response = $this->getJson(route('contracts_user_address'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view contracts_print_adhesion feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_contracts_print_adhesion_without_login()
    {
        $id = Contract::first()->id;

        $response = $this->postJson(route('contracts_print_adhesion', ['id' => encrypt($id)]));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view contracts_print_contract feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_contracts_print_contract_without_login()
    {
        $id = Contract::first()->id;

        $response = $this->postJson(route('contracts_print_contract', ['id' => encrypt($id)]));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view contracts_print_power_of_attorney feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_contracts_print_power_of_attorney_without_login()
    {
        $id = Contract::first()->id;

        $response = $this->postJson(route('contracts_print_power_of_attorney', ['id' => encrypt($id)]));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

}
