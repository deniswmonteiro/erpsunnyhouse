<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngineeringProjectSurveyImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engineering_project_survey_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('engineering_generator_id');
            $table->string('name');
            $table->string('image_survey_name');
            $table->string('image_survey_path');
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
        Schema::dropIfExists('engineering_project_survey_images');
    }
}
