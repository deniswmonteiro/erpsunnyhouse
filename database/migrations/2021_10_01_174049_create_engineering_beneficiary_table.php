<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngineeringBeneficiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engineering_beneficiary', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('engineering_generator_id');
            $table->string('beneficiary_contract_account')->nullable();
            $table->string('beneficiary_consumption_class')->nullable();
            $table->double('beneficiary_rate')->nullable();
            $table->longText('beneficiary_address')->nullable();
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
        Schema::dropIfExists('engineering_beneficiary');
    }
}
