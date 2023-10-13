<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsinasRateioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usinas_rateio', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('usinas_id');
            $table->bigInteger('contas_contratos_id');

            $table->bigInteger('rateio');
            $table->date('vigencia');
            $table->bigInteger('ciclocreditos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usinas_rateio');
    }
}
