<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropQuantityParcelColumnFromPaymentTotalParceledTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_total_parceled', function (Blueprint $table) {
            $table->dropColumn('quantity_parcel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_total_parceled', function (Blueprint $table) {
            $table->bigInteger('quantity_parcel')
                ->after('bank_id');
        });
    }
}
