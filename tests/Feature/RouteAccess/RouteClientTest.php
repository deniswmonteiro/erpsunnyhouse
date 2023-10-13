<?php

namespace Tests\Feature\RouteAccess;

use App\Models\Client;
use Tests\TestCase;

class RouteClientTest extends TestCase
{

    /**
     * A view clients lists feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_clients_index_without_login()
    {
        $response = $this->getJson(route('clients_index'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view clients_create feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_clients_create_without_login()
    {
        $response = $this->getJson(route('clients_create'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view clients_store feature test.
     *
     * @return void
     */
    public function test_cannot_submit_a_form_to_clients_store_without_login()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $client = [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'phone' => $faker->phoneNumber,
            'cpf' => $faker->cpf,
            'address_state' => $faker->stateAbbr,
            'address_city' => $faker->city,
            'address_cep' => $faker->postcode,
            'address' => $faker->streetAddress,
            'address_number' => rand(0, 1) == 1 ? $faker->buildingNumber : $faker->secondaryAddress,
            'address_neighborhood' => '',
            'address_complement' => $faker->secondaryAddress,
        ];
        $response = $this->postJson(route('clients_store'), $client);
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view clients_edit feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_clients_edit_without_login()
    {
        $id = Client::first()->id;

        $response = $this->getJson(route('clients_edit', ['id' => encrypt($id)]));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view clients_update feature test.
     *
     * @return void
     */
    public function test_cannot_submit_a_form_to_clients_update_without_login()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $client = [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'phone' => $faker->phoneNumber,
            'cpf' => $faker->cpf,
            'address_state' => $faker->stateAbbr,
            'address_city' => $faker->city,
            'address_cep' => $faker->postcode,
            'address' => $faker->streetAddress,
            'address_number' => rand(0, 1) == 1 ? $faker->buildingNumber : $faker->secondaryAddress,
            'address_neighborhood' => '',
            'address_complement' => $faker->secondaryAddress,
        ];

        $id = Client::all()->random()->id;
        $response = $this->postJson(route('clients_update', ['id' => encrypt($id)]), $client);
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view clients_destroy feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_clients_destroy_without_login()
    {
        $id = Client::first()->id;

        $response = $this->postJson(route('clients_destroy', ['id' => encrypt($id)]));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view clients_validate_email feature test.
     *
     * @return void
     */
    public function test_cannot_access_ajax_clients_validate_email_without_login()
    {

        $response = $this->getJson(route('clients_validate_email'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view clients_validate_name feature test.
     *
     * @return void
     */
    public function test_cannot_access_ajax_clients_validate_name_without_login()
    {

        $response = $this->getJson(route('clients_validate_name'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view clients_validate_email_client feature test.
     *
     * @return void
     */
    public function test_cannot_access_ajax_clients_validate_email_client_without_login()
    {

        $response = $this->getJson(route('clients_validate_name'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view clients_store_ajax feature test.
     *
     * @return void
     */
    public function test_cannot_access_ajax_sellers_store_without_login()
    {

        $response = $this->getJson(route('clients_store_ajax'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

}
