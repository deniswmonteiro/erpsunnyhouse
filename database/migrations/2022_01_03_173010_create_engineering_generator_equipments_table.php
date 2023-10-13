<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngineeringGeneratorEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engineering_generator_equipments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('engineering_generator_id');
            $table->bigInteger('equipment_id');
            $table->string('name');
            $table->bigInteger('quantity');
            $table->string('type');
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
        Schema::dropIfExists('engineering_generator_equipments');
    }
}
