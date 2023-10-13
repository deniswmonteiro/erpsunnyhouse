<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            
            $table->string('status');
            $table->string('tipo_contrato');
            $table->bigInteger('client_id');
            $table->double('potencia_quota');
            $table->double('qtd_kwh');
            $table->bigInteger('tempo_vigencia');
            $table->date('data_vigencia');

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
        Schema::dropIfExists('contratos');
    }
}
