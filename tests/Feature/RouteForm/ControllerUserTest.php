<?php

namespace Tests\Feature\RouteForm;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ControllerUserTest extends TestCase
{

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
     * A view register_users feature test.
     *
     * @return void
     */
    public function test_cannot_register_user_with_email_existent()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $existent = User::all()->random();
        $admin = User::where('email', 'admin@admin.com')->first();

        Auth::login($admin);
        $user = [
            'name' => 'test cannot register user with email existent',
            'status' => false,
            'category_id' => 2,
//            'email' => $existent->email,
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => 'abcdef' // password
        ];

        $response = $this->postJson(route('register'), $user);
//        $redirect_code = 200;
//        $response->assertStatus($redirect_code);
        $response->assertRedirect('/users');

    }

//    /**
//     * A view update_users feature test.
//     *
//     * @return void
//     */
//    public function test_cannot_submit_a_form_to_update_users_without_login()
//    {
//        $faker = \Faker\Factory::create('pt_BR');
//
//        $user = [
//            'name' => $faker->name,
//            'status' => false,
//            'category' => 2,
//            'email' => $faker->unique()->safeEmail,
//            'password' => 'abcdef' // passwords
//        ];
//
//        $id = User::all()->random()->id;
//        $response = $this->postJson(route('update_users', ['id' => encrypt($id)]), $user);
//        $redirect_code = 302;
//        $response->assertStatus($redirect_code);
//        $response->assertRedirect('/login');
//
//    }


}
