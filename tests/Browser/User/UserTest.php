<?php

namespace Tests\Feature\RouteForm;

use \App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_user_with_correct_credentials()
    {

        config()->set('seeding', true);

//        $faker = \Faker\Factory::create('pt_BR');
//        $user = User::create([
//            'name' => $faker->name,
//            'status' => false,
//            'category_id' => 1,
//            'email' => $faker->unique()->safeEmail,
//            'email_verified_at' => now(),
//            'password' => 'abcdef' // password
//        ]);

        $user = User::where('email', 'admin@admin.com')->first();

//        $this->browse(function ($browser) use ($user) {
//            $email = 'izidiocarvalho@gmail.com';
//            $password = 'admin123';
//            $status = encrypt('true');
//            $category = encrypt(1);
//            dump(route('create_user'));
//            $browser->visit('create_user')
//                ->type('name', 'abcdef');
//                ->type('email', $email)
//                ->type('password', $password)
//                ->select('status', $status)
//                ->select('category', $category);
//                ->press('Salvar')
//                ->assertPathIs('/users');
//            $url = $browser->driver->getCurrentURL();
//            dump($url);

//        });

        $this->browse(function ($browser) use ($user) {
            $browser->visitRoute('login')
                ->assertPathIs('/login/');
//                ->type('email', 'admin@admin.com');
//                    ->type('password', 'admin123')
//                    ->press('Login')
//                    ->assertPathIs('/dashboard');

        });

//        $response = $this->post(route('create_user'), [
//            'password' => $password,
//            'email' => $email,
//            'status' => $status,
//            'category' => $category,
//        ]);

//        $user->delete();
        config()->set('seeding', false);

    }
}
