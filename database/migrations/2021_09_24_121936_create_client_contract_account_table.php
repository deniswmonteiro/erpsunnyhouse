<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientContractAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_contract_account', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id');
            $table->string('contract_account_number');
            $table->string('address');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('installation_number');
            $table->date('account_month');
            $table->string('file_bill_name')->nullable();
            $table->string('file_bill_path')->nullable();
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
        Schema::dropIfExists('client_contract_account');
    }
}
