<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_group', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_subscription_token_id')->unsigned();
            $table->foreign('user_subscription_token_id')->references('id')->on('user_subscription_token');
            $table->bigInteger('member_user_id')->unsigned();
            $table->foreign('member_user_id')->references('id')->on('users');
            $table->string('status');
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
        Schema::dropIfExists('subscription_group');
    }
}
