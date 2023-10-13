<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropGeneratorsAndBeneficiariesColumnsToEngineeringProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engineering_project', function (Blueprint $table) {
            $table->dropColumn('installation_cep');
            $table->dropColumn('installation_address');
            $table->dropColumn('installation_number');
            $table->dropColumn('installation_complement');
            $table->dropColumn('installation_neighborhood');
            $table->dropColumn('installation_city');
            $table->dropColumn('installation_state');
            $table->dropColumn('installation_cc_generator');
            $table->dropColumn('installation_generator_power');
            $table->dropColumn('cc_beneficiary');
            $table->dropColumn('beneficiary_consumption_class');
            $table->dropColumn('beneficiary_rate');
            $table->dropColumn('beneficiary_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('engineering_project', function (Blueprint $table) {
            $table->bigInteger('installation_cep')->after('engeneering_project_type');
            $table->bigInteger('installation_address')->after('installation_cep');
            $table->bigInteger('installation_number')->after('installation_address');
            $table->bigInteger('installation_complement')->after('installation_number');
            $table->bigInteger('installation_neighborhood')->after('installation_complement');
            $table->bigInteger('installation_city')->after('installation_neighborhood');
            $table->bigInteger('installation_state')->after('installation_city');
            $table->bigInteger('installation_cc_generator')->after('installation_state');
            $table->bigInteger('installation_generator_power')->after('installation_cc_generator');
            $table->bigInteger('cc_beneficiary')->nullable()->after('installation_cc_generator');
            $table->bigInteger('beneficiary_consumption_class')->nullable()->after('cc_beneficiary');
            $table->bigInteger('beneficiary_rate')->nullable()->after('beneficiary_consumption_class');
            $table->bigInteger('beneficiary_address')->nullable()->after('beneficiary_rate');
        });
    }
}
