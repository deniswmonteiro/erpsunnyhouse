<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentSolarInverterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_solar_inverter', function (Blueprint $table) {
            $table->id();
            $table->longText('producer');
            $table->bigInteger('mppt');
            $table->bigInteger('power');
            $table->bigInteger('voltage');
            $table->bigInteger('guarantee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_solar_inverter');
    }
}
