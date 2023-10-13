<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterContasContratosEContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contas_contratos', function (Blueprint $table) {
            $table->dropColumn('desconto');
            $table->dropColumn('tarifa_base');
            $table->dropColumn('meta_gestao');
        });

        Schema::table('contratos', function (Blueprint $table) {
            $table->bigInteger('desconto');
            $table->double('tarifa_base');
            $table->double('meta_gestao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contas_contratos', function (Blueprint $table) {
            $table->bigInteger('desconto');
            $table->double('tarifa_base');
            $table->double('meta_gestao');
        });

        Schema::table('contratos', function (Blueprint $table) {
            $table->dropColumn('desconto');
            $table->dropColumn('tarifa_base');
            $table->dropColumn('meta_gestao');
        });
    }
}
