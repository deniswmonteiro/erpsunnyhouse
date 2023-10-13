<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_project', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_costs_id');
            $table->bigInteger('solar_inverter_id');
            $table->string('description');
            $table->double('value');
            $table->date('date');
            $table->string('structure');
            $table->string('input_pattern');
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
        Schema::dropIfExists('cost_project');
    }
}
