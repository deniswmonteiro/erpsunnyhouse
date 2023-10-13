<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropNewFileColumnsToEngineeringGeneratorDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engineering_generator_documents', function (Blueprint $table) {
            $table->dropColumn('file_new_name');
            $table->dropColumn('file_new_path');
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
            $table->string('file_new_name')->after('file_electrical_project_path');
            $table->string('file_new_path')->after('file_new_name');
        });
    }
}
