<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturas', function (Blueprint $table) {
            $table->string('data_fatura')->change();
            $table->date('data_inicio_ciclo')->nullable()->change();
            $table->date('data_fim_ciclo')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faturas', function (Blueprint $table) {
            $table->date('data_fatura')->change();
            $table->date('data_inicio_ciclo')->change();
            $table->date('data_fim_ciclo')->change();
        });
    }
}
