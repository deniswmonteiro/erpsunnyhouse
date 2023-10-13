<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatasheetInfoColumnsToEquipmentCableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipment_cable', function (Blueprint $table) {
            $table->string('datasheet_name')->nullable()->after('name');
            $table->string('datasheet_path')->nullable()->after('datasheet_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipment_cable', function (Blueprint $table) {
            $table->dropColumn('datasheet_name');
            $table->dropColumn('datasheet_path');
        });
    }
}
