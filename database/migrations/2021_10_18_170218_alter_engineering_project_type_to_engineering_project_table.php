<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEngineeringProjectTypeToEngineeringProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engineering_project', function (Blueprint $table) {
            $table->renameColumn('engeneering_project_type', 'engineering_project_type');
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
            $table->renameColumn('engineering_project_type', 'engeneering_project_type');
        });
    }
}
