<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValorTableEmpresaServicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresa_servicos', function (Blueprint $table) {
            $table->double('valor',8,2)->unsigned()->nullable();
            $table->double('desconto',8,2)->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresa_servicos', function (Blueprint $table) {
            //
        });
    }
}
