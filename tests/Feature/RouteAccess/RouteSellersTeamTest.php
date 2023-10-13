<?php

namespace Tests\Feature\RouteAccess;

use App\Models\SellerTeam;
use Tests\TestCase;

class RouteSellersTeamTest extends TestCase
{

    /**
     * A view seller_team_store feature test.
     *
     * @return void
     */
    public function test_cannot_submit_a_form_to_seller_team_store_without_login()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $seller_team = [
            'name' => $faker->company
        ];
        $response = $this->postJson(route('seller_team_store'), $seller_team);
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view seller_team_update feature test.
     *
     * @return void
     */
    public function test_cannot_submit_a_form_to_seller_team_update_without_login()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $seller_team = [
            'name' => $faker->name
        ];

        $id = SellerTeam::all()->random()->id;
        $response = $this->postJson(route('seller_team_update', ['id' => encrypt($id)]), $seller_team);
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view users_destroy feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_users_destroy_without_login()
    {
        $id = SellerTeam::first()->id;

        $response = $this->postJson(route('seller_team_destroy', ['id' => encrypt($id)]));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }


    /**
     * A view teams_store_ajax feature test.
     *
     * @return void
     */
    public function test_cannot_access_ajax_teams_store_without_login()
    {

        $response = $this->getJson(route('teams_store_ajax'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

}
