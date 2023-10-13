<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGeneratorProjectTypeColumnToEngineeringGeneratorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engineering_generator', function (Blueprint $table) {
            $table->string('generator_project_type')->after('client_id');
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
            $table->dropColumn('generator_project_type');
        });
    }
}
