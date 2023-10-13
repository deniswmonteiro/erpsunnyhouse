<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Http\Controllers\ContractController;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract', function (Blueprint $table) {
            $table->id();
            $table->longText('status');

            $table->bigInteger('seller_id');
            $table->bigInteger('client_id');
            $table->bigInteger('payment_id');
            $table->longText('description')->nullable();
            $table->bigInteger('type');

            $table->longText('contract_name');
            $table->longText('phone');
            $table->longText('address');
            $table->longText('address_number');
            $table->longText('address_state');
            $table->longText('address_city');
            $table->longText('address_cep');
            $table->longText('address_neighborhood');
            $table->longText('address_complement')->nullable();

            $table->bigInteger('generator_structure')->nullable();
            $table->bigInteger('area')->nullable();
            $table->bigInteger('monthly_avg_generation')->nullable();

//            $table->dateTime('started_at');
//            $table->dateTime('finished_at');
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
        Schema::dropIfExists('contract');
    }
}
