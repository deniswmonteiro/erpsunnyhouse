<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEngineerDataColumnsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->boolean('is_engineer')->after('remember_token');
            $table->string('professional_title')->nullable()->after('is_engineer');
            $table->string('professional_registration')->nullable()->after('professional_title');
            $table->string('professional_state')->nullable()->after('professional_registration');
            $table->string('phone')->nullable()->after('professional_state');
            $table->string('cellphone')->nullable()->after('phone');
            $table->string('cep')->nullable()->after('cellphone');
            $table->string('address')->nullable()->after('cep');
            $table->string('number')->nullable()->after('address');
            $table->string('neighborhood')->nullable()->after('number');
            $table->string('city')->nullable()->after('neighborhood');
            $table->string('state')->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('is_engineer');
            $table->dropColumn('professional_title');
            $table->dropColumn('professional_registration');
            $table->dropColumn('professional_state');
            $table->dropColumn('phone');
            $table->dropColumn('cellphone');
            $table->dropColumn('cep');
            $table->dropColumn('address');
            $table->dropColumn('number');
            $table->dropColumn('neighborhood');
            $table->dropColumn('city');
            $table->dropColumn('state');
        });
    }
}
