<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngineeringGeneratorDocumentsNewFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engineering_generator_documents_new_file', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('engineering_generator_id');
            $table->string('name');
            $table->string('file_new_name');
            $table->string('file_new_path');
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
        Schema::dropIfExists('engineering_generator_documents_new_file');
    }
}
