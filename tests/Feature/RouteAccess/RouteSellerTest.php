<?php

namespace Tests\Feature\RouteAccess;
use App\Models\Seller;
use Tests\TestCase;

class RouteSellerTest extends TestCase
{

    /**
     * A view sellers_index feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_sellers_index_without_login()
    {
        $response = $this->getJson(route('sellers_index'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view sellers_create feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_sellers_create_without_login()
    {
        $response = $this->getJson(route('sellers_create'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view sellers_store feature test.
     *
     * @return void
     */
    public function test_cannot_submit_a_form_to_sellers_store_without_login()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $seller = [
            'seller_team_id' => 1,
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'phone' => $faker->phoneNumber,
            'cep' => '66625-000',
            'address' => $faker->address,
            'address_number' => strval($faker->numberBetween(10, 100)),
            'complement' => 'Text Text Text Text Text',
        ];
        $response = $this->postJson(route('sellers_store'), $seller);
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view sellers_edit feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_sellers_edit_without_login()
    {
        $id = Seller::first()->id;

        $response = $this->getJson(route('sellers_edit', ['id' => encrypt($id)]));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view sellers_update feature test.
     *
     * @return void
     */
    public function test_cannot_submit_a_form_to_sellers_update_without_login()
    {
        $faker = \Faker\Factory::create('pt_BR');


        $seller = [
            'seller_team_id' => 1,
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'phone' => $faker->phoneNumber,
            'cep' => '66625-000',
            'address' => $faker->address,
            'address_number' => strval($faker->numberBetween(10, 100)),
            'complement' => 'Text Text Text Text Text',
        ];

        $id = Seller::all()->random()->id;
        $response = $this->postJson(route('sellers_update', ['id' => encrypt($id)]), $seller);
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view sellers_destroy feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_sellers_destroy_without_login()
    {
        $id = Seller::first()->id;

        $response = $this->postJson(route('sellers_destroy', ['id' => encrypt($id)]));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view sellers_validate_email feature test.
     *
     * @return void
     */
    public function test_cannot_access_ajax_sellers_validate_email_without_login()
    {

        $response = $this->getJson(route('sellers_validate_email'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view sellers_validate_name feature test.
     *
     * @return void
     */
    public function test_cannot_access_ajax_sellers_validate_email_seller_without_login()
    {

        $response = $this->getJson(route('sellers_validate_email_seller'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view sellers_validate_name feature test.
     *
     * @return void
     */
    public function test_cannot_access_ajax_sellers_validate_name_without_login()
    {

        $response = $this->getJson(route('sellers_validate_name'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view sellers_store_ajax feature test.
     *
     * @return void
     */
    public function test_cannot_access_ajax_sellers_store_without_login()
    {

        $response = $this->getJson(route('sellers_store_ajax'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

}
