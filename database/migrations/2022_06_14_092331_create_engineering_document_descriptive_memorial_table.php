<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngineeringDocumentDescriptiveMemorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engineering_document_descriptive_memorial', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('generator_id');
            $table->string('file_descriptive_memorial_name');
            $table->string('file_descriptive_memorial_path');
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
        Schema::dropIfExists('engineering_document_descriptive_memorial');
    }
}
