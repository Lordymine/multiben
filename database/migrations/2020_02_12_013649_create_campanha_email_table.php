<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampanhaEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanha_email', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome_campanha');
            $table->string('nome_indicado');
            $table->string('email');
            $table->string('arquivo_video');
            $table->text('mensagem');
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('campanha_email');
    }
}
