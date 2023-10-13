<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropEquipmentsInformationsColumnsToEngineeringProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engineering_project', function (Blueprint $table) {
            $table->dropColumn('equipment_date_acquisition');
            $table->dropColumn('equipment_delivery_date');
            $table->dropColumn('file_invoice_name');
            $table->dropColumn('file_invoice_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('engineering_project', function (Blueprint $table) {
            $table->date('equipment_date_acquisition')->nullable()->after('status');;
            $table->date('equipment_delivery_date')->nullable()->after('equipment_date_acquisition');;
            $table->string('file_invoice_name')->nullable()->after('equipment_delivery_date');;
            $table->string('file_invoice_path')->nullable()->after('file_invoice_name');;
        });
    }
}
