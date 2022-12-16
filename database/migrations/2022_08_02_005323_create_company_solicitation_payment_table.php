<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanySolicitationPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_solicitation_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('empresa_id')->unsigned();
            $table->bigInteger('solicitacao_id')->unsigned();
            $table->foreign('solicitacao_id')->references('id')->on('user_solicitacao_bonus');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->unique(['empresa_id','solicitacao_id']);
            $table->string('filename');
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
        Schema::dropIfExists('company_solicitation_payment');
    }
}
