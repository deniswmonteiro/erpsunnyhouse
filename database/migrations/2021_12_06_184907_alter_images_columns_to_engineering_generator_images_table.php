<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterImagesColumnsToEngineeringGeneratorImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engineering_generator_images', function (Blueprint $table) {
            $table->renameColumn('image_survey_name', 'image_generator_name');
            $table->renameColumn('image_survey_path', 'image_generator_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('engineering_generator_images', function (Blueprint $table) {
            $table->renameColumn('image_generator_name', 'image_survey_name');
            $table->renameColumn('image_generator_path', 'image_survey_path');
        });
    }
}
