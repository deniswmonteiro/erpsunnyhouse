<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usinas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('contas_contratos_id');

            $table->string('nome');
            $table->string('apelido');
            $table->string('documento');
            $table->string('login');
            $table->string('senha');
            $table->double('producaoMeta');
            $table->bigInteger('diaLeitura');
            $table->bigInteger('ciclo');
            $table->string('investimento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usinas');
    }
}
