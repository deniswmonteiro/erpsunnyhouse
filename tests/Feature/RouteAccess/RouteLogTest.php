<?php

namespace Tests\Feature\RouteAccess;
use App\Models\Seller;
use Tests\TestCase;

class RouteLogTest extends TestCase
{

    /**
     * A view logs_index feature test.
     *
     * @return void
     */
    public function test_cannot_access_logs_without_login()
    {

        $response = $this->getJson(route('logs_index'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

}
