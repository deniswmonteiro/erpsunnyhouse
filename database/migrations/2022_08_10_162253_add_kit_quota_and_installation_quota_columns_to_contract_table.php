<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKitQuotaAndInstallationQuotaColumnsToContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract', function (Blueprint $table) {
            $table->double('kit_quota')->nullable()->after('profit_estimate');
            $table->double('installation_quota')->nullable()->after('kit_quota');
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
            $table->dropColumn('kit_quota');
            $table->dropColumn('installation_quota');
        });
    }
}
