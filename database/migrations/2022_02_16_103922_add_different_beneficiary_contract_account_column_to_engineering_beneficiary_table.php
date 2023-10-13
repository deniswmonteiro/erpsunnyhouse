<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDifferentBeneficiaryContractAccountColumnToEngineeringBeneficiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engineering_beneficiary', function (Blueprint $table) {
            $table->boolean('different_beneficiary_contract_account')->after('client_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('engineering_beneficiary', function (Blueprint $table) {
            $table->dropColumn('different_beneficiary_contract_account');
        });
    }
}
