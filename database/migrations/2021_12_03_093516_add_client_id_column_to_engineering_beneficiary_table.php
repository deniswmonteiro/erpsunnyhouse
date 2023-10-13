<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientIdColumnToEngineeringBeneficiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engineering_beneficiary', function (Blueprint $table) {
            $table->bigInteger('client_id')->nullable()->after('engineering_generator_id');
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
            $table->dropColumn('client_id');
        });
    }
}
