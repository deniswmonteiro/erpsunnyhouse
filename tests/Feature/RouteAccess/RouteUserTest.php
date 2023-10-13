<?php

namespace Tests\Feature\RouteAccess;

use App\Models\User;
use Tests\TestCase;

class RouteUserTest extends TestCase
{

    /**
     * A view user lits feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_users_index_without_login()
    {
        $response = $this->getJson(route('users_index'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view edit_users feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_edit_users_without_login()
    {
        $id = User::first()->id;

        $response = $this->getJson(route('edit_users', ['id' => encrypt($id)]));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view create_user feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_create_user_without_login()
    {
        $response = $this->getJson(route('create_user'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view register_users feature test.
     *
     * @return void
     */
    public function test_cannot_submit_a_form_to_register_users_without_login()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $user = [
            'name' => $faker->name,
            'status' => false,
            'category_id' => 2,
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => 'abcdef' // password
        ];

        $response = $this->postJson(route('register'), $user);
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view update_users feature test.
     *
     * @return void
     */
    public function test_cannot_submit_a_form_to_update_users_without_login()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $user = [
            'name' => $faker->name,
            'status' => false,
            'category' => 2,
            'email' => $faker->unique()->safeEmail,
            'password' => 'abcdef' // passwords
        ];

        $id = User::all()->random()->id;
        $response = $this->postJson(route('update_users', ['id' => encrypt($id)]), $user);
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
        $id = User::first()->id;

        $response = $this->postJson(route('users_destroy', ['id' => encrypt($id)]));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

}
