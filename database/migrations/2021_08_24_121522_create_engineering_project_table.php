<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngineeringProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engineering_project', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contract_id');
            $table->date('equipment_date_acquisition')->nullable();
            $table->date('equipment_delivery_date')->nullable();
            $table->string('file_nf_name')->nullable();
            $table->string('file_nf_path')->nullable();
            $table->string('file_cnh_name');
            $table->string('file_cnh_path');
            $table->string('file_cnpj_name')->nullable();
            $table->string('file_cnpj_path')->nullable();
            $table->string('file_social_contract_name')->nullable();
            $table->string('file_social_contract_path')->nullable();
            $table->string('engeneering_project_type');
            $table->string('installation_cep');
            $table->string('installation_address');
            $table->string('installation_number');
            $table->string('installation_complement');
            $table->string('installation_neighborhood');
            $table->string('installation_city');
            $table->string('installation_state');
            $table->string('installation_cc_generator');
            $table->bigInteger('installation_generator_power');
            $table->string('cc_beneficiary')->nullable();
            $table->string('beneficiary_consumption_class')->nullable();
            $table->double('beneficiary_rate')->nullable();
            $table->longText('beneficiary_address')->nullable();
            $table->longText('observation')->nullable();
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
        Schema::dropIfExists('engineering_project');
    }
}
