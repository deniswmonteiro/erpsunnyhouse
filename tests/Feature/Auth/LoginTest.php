<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_user_cannot_login_with_wrong_credentials()
    {

        $email = 'admin@admin.com.br';
        $password = 'admin123';

        $response = $this->from('/login')->post('/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();

    }

    public function test_user_can_login_with_correct_credentials()
    {

        $email = 'admin@admin.com';
        $password = 'admin123';

        $response = $this->post('/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $user = User::where('email', $email)->first();
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

}
