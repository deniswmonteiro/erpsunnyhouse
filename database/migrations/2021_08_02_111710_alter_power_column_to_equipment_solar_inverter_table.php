<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPowerColumnToEquipmentSolarInverterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipment_solar_inverter', function (Blueprint $table) {
            $table->float('power')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipment_solar_inverter', function (Blueprint $table) {
            $table->bigInteger('power')->change();
        });
    }
}
