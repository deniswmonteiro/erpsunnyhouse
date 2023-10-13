<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDifferentGeneratorContractAccountColumnToEngineeringGeneratorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engineering_generator', function (Blueprint $table) {
            $table->boolean('different_generator_contract_account')->after('generator_state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('engineering_generator', function (Blueprint $table) {
            $table->dropColumn('different_generator_contract_account');
        });
    }
}
