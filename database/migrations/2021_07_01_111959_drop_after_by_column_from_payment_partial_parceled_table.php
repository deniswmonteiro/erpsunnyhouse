<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAfterByColumnFromPaymentPartialParceledTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_partial_parceled', function (Blueprint $table) {
            $table->dropColumn('after_by');
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
            $table->bigInteger('after_by')
                ->after('value');
        });
    }
}
