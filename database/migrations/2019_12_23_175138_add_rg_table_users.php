<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRgTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('rg')->unique()->nullable();
            $table->string('cpf')->unique()->nullable();
            $table->string('endereco')->nullable();
            $table->string('cep')->nullable();
            $table->bigInteger('telefone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rg');
            $table->dropColumn('cpf');
            $table->dropColumn('endereco');
            $table->dropColumn('cep');
            $table->dropColumn('telefone');
        });
    }
}
