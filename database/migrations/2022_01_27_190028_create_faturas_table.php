<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturas', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('contas_contratos_id');

            $table->date('data_fatura');
            $table->double('valor_faturado');
            $table->double('valor_tarifa');
            $table->double('valor_tarifa_energia');

            $table->date('data_inicio_ciclo');
            $table->double('kwh_energia_registrada');
            $table->double('kwh_energia_compensada');

            $table->date('data_fim_ciclo');
            $table->double('kwh_faturada');

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
        Schema::dropIfExists('faturas');
    }
}
