<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProjectIdToProtocolRequestFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocol_request_feedback', function (Blueprint $table) {
            $table->renameColumn('project_id', 'generator_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocol_request_feedback', function (Blueprint $table) {
            $table->renameColumn('generator_id', 'project_id');
        });
    }
}
