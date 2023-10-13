<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngineeringGeneratorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engineering_generator', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('engineering_project_id');
            $table->string('generator_cep');
            $table->string('generator_address');
            $table->string('generator_number');
            $table->string('generator_complement')->nullable();
            $table->string('generator_neighborhood');
            $table->string('generator_city');
            $table->string('generator_state');
            $table->string('generator_contract_account');
            $table->bigInteger('generator_power');
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
        Schema::dropIfExists('engineering_generator');
    }
}
