<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropInstallationAddresscolumnsFromContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract', function (Blueprint $table) {
            $table->dropColumn('contract_name');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('address_number');
            $table->dropColumn('address_state');
            $table->dropColumn('address_city');
            $table->dropColumn('address_cep');
            $table->dropColumn('address_neighborhood');
            $table->dropColumn('address_complement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract', function (Blueprint $table) {
            $table->longText('contract_name')->after('type');
            $table->longText('phone')->after('contract_name');
            $table->longText('address')->after('phone');
            $table->longText('address_number')->after('address');
            $table->longText('address_state')->after('address_number');
            $table->longText('address_city')->after('address_state');
            $table->longText('address_cep')->after('address_city');
            $table->longText('address_neighborhood')->after('address_cep');
            $table->longText('address_complement')->nullable()->after('address_neighborhood');
        });
    }
}
