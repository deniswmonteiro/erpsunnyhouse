<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEngineeringProjectIdToEngineeringGeneratorDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engineering_generator_documents', function (Blueprint $table) {
            $table->renameColumn('engineering_project_id', 'engineering_generator_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('engineering_generator_documents', function (Blueprint $table) {
            $table->renameColumn('engineering_generator_id', 'engineering_project_id');
        });
    }
}
