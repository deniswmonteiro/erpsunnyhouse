<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterNFColumnsToEngineeringProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engineering_project', function (Blueprint $table) {
            $table->renameColumn('file_nf_name', 'file_invoice_name');
            $table->renameColumn('file_nf_path', 'file_invoice_path');
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
            $table->renameColumn('file_invoice_name', 'file_nf_name');
            $table->renameColumn('file_invoice_path', 'file_nf_path');
        });
    }
}
