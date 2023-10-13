<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngineeringDocumentRequestUpToTenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engineering_document_request_up_to_ten', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('generator_id');
            $table->bigInteger('user_id');
            $table->string('client_rg')->nullable();
            $table->date('client_rg_shipping_date')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('client_cellphone')->nullable();
            $table->string('branch_activity')->nullable();
            $table->boolean('has_special_loads')->nullable();
            $table->string('special_loads_details')->nullable();
            $table->string('subgroup');
            $table->string('consumption_class');
            $table->string('connection_type');
            $table->double('uc_power')->nullable();
            $table->double('uc_declared_load')->nullable();
            $table->double('uc_circuit_breaker');
            $table->double('uc_available_power')->nullable();
            $table->string('extension_type');
            $table->string('transformer_identification')->nullable();
            $table->string('point_coordinate_x')->nullable();
            $table->string('point_coordinate_y')->nullable();
            $table->string('responsible_name')->nullable();
            $table->string('responsible_phone')->nullable();
            $table->string('responsible_email')->nullable();
            $table->string('generation_type');
            $table->string('generation_details')->nullable();
            $table->string('generation_framework');
            $table->double('generation_power')->nullable();
            $table->string('generation_ok')->nullable();
            $table->string('generation_voltage')->nullable();
            $table->string('generation_start_date')->nullable();
            $table->string('art_observation')->nullable();
            $table->string('diagram_observation')->nullable();
            $table->string('memo_observation')->nullable();
            $table->string('compliance_certificate_observation')->nullable();
            $table->string('uc_participants_observation')->nullable();
            $table->string('legal_instrument_observation')->nullable();
            $table->string('aneel_observation')->nullable();
            $table->string('new_link_observation')->nullable();
            $table->string('pattern_change_observation')->nullable();
            $table->string('rent_contract_observation')->nullable();
            $table->string('procuration_observation')->nullable();
            $table->string('condominium_observation')->nullable();
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
        Schema::dropIfExists('engineering_document_request_up_to_ten');
    }
}
