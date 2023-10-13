<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_contratos', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('client_id');
            $table->bigInteger('cod_cc');
            $table->string('apelido');
            $table->string('classificacao');
            $table->string('tipo_classificacao');
            $table->string('modalidade_tarifaria');

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
        Schema::dropIfExists('contas_contratos');
    }
}
