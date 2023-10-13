<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropQuantityParcelColumnFromPaymentPartialParceledTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_partial_parceled', function (Blueprint $table) {
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
        Schema::table('payment_partial_parceled', function (Blueprint $table) {
            $table->bigInteger('quantity_parcel')
                ->after('cash');
        });
    }
}
