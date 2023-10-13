<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngineeringProjectDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engineering_project_documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('engineering_project_id');
            $table->string('file_access_request_form_name');
            $table->string('file_access_request_form_path');
            $table->string('file_art_name');
            $table->string('file_art_path');
            $table->string('file_aneel_form_name');
            $table->string('file_aneel_form_path');
            $table->string('file_data_sheet_certificates_name');
            $table->string('file_data_sheet_certificates_path');
            $table->string('file_descriptive_memorial_name');
            $table->string('file_descriptive_memorial_path');
            $table->string('file_electrical_project_name');
            $table->string('file_electrical_project_path');
            $table->string('file_new_name')->nullable();
            $table->string('file_new_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('engineering_project_documents');
    }
}
