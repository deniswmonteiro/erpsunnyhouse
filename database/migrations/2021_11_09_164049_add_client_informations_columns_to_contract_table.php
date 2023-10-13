<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientInformationsColumnsToContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract', function (Blueprint $table) {
            $table->string('file_cnh_name')->after('address_complement');
            $table->string('file_cnh_path')->after('file_cnh_name');
            $table->string('file_cnpj_name')->nullable()->after('file_cnh_path');
            $table->string('file_cnpj_path')->nullable()->after('file_cnpj_name');
            $table->string('file_social_contract_name')->nullable()->after('file_cnpj_path');
            $table->string('file_social_contract_path')->nullable()->after('file_social_contract_name');
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
            $table->dropColumn('file_cnh_name');
            $table->dropColumn('file_cnh_path');
            $table->dropColumn('file_cnpj_name');
            $table->dropColumn('file_cnpj_path');
            $table->dropColumn('file_social_contract_name');
            $table->dropColumn('file_social_contract_path');
        });
    }
}
