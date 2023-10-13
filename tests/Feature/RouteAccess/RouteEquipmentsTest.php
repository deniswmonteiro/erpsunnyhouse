<?php

namespace Tests\Feature\RouteAccess;

use App\Models\EquipmentOther;
use Tests\TestCase;

class RouteEquipmentsTest extends TestCase
{

    /**
     * A view equipments_index feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_equipments_index_without_login()
    {
        $response = $this->getJson(route('equipments_index'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view equipments_store feature test.
     *
     * @return void
     */
    public function test_cannot_submit_a_form_to_equipments_store_without_login()
    {
        $faker = \Faker\Factory::create('pt_BR');

        //TYPE: OTHER
        $equipment_other = [
            'name' => $faker->name
        ];
        $response = $this->postJson(route('equipments_store'), $equipment_other);
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view equipments_update feature test.
     *
     * @return void
     */
    public function test_cannot_submit_a_form_to_equipments_update_without_login()
    {
        $faker = \Faker\Factory::create('pt_BR');

        //TYPE: OTHER
        $equipment_other = [
            'name' => $faker->name
        ];

        $id = EquipmentOther::all()->random()->id;
        $response = $this->postJson(route('equipments_update', ['id' => encrypt($id)]), $equipment_other);
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view equipments_destroy feature test.
     *
     * @return void
     */
    public function test_cannot_access_view_equipments_destroy_without_login()
    {
        $id = EquipmentOther::first()->id;

        $response = $this->postJson(route('equipments_destroy', ['id' => encrypt($id)]));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

    /**
     * A view store_product_ajax feature test.
     *
     * @return void
     */
    public function test_cannot_access_ajax_store_product_without_login()
    {

        $response = $this->getJson(route('store_product_ajax'));
        $redirect_code = 302;
        $response->assertStatus($redirect_code);
        $response->assertRedirect('/login');

    }

}
