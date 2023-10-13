<?php

namespace Tests\Feature\RouteAccess;

use Tests\TestCase;

class RouteLoginTest extends TestCase
{

    /**
     * A login feature test.
     *
     * @return void
     */
    public function test_can_access_view_login_form()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    /**
     * A view dashboard feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_dashboard_without_login()
    {
        $response = $this->getJson(route('dashboard'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }
}
