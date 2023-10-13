<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropEngineeringProjectTypeColumnFromEngineeringProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engineering_project', function (Blueprint $table) {
            $table->dropColumn('engineering_project_type');
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
            $table->string('engineering_project_type')->after('contract_id');
        });
    }
}
