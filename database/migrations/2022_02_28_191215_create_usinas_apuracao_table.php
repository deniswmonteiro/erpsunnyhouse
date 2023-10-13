<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsinasApuracaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usinas_apuracao', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('usinas_id');

            $table->date('mesref');
            $table->double('producao');
            $table->bigInteger('desempenho');
            $table->double('tarifa');
            $table->double('valor');
            $table->double('rendimento');
            $table->bigInteger('arvores');
            $table->double('co2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usinas_apuracao');
    }
}
