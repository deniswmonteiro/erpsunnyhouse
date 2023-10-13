<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFilesColumnsToClientContractAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_contract_account', function (Blueprint $table) {
            $table->string('file_bill_name')->change();
            $table->string('file_bill_path')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_contract_account', function (Blueprint $table) {
            $table->string('file_bill_name')->nullable()->change();
            $table->string('file_bill_path')->nullable()->change();
        });
    }
}
