<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGeneratorConsumptionColumnToEngineeringGeneratorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engineering_generator', function (Blueprint $table) {
            $table->float('generator_consumption')->nullable()->after('generator_power');;
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
            $table->dropColumn('generator_consumption');
        });
    }
}
