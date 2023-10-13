<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDocumentInformationsToEngineeringDocumentAneelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engineering_document_aneel', function (Blueprint $table) {
            $table->string('file_aneel_form_name')->nullable()->change();
            $table->string('file_aneel_form_path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('engineering_document_aneel', function (Blueprint $table) {
            $table->string('file_aneel_form_name')->change();
            $table->string('file_aneel_form_path')->change();
        });
    }
}
