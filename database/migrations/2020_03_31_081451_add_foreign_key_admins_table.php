<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyAdminsTable extends Migration
{
    public function up()
    {
        Schema::table('admins', function(Blueprint $table)
        {
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('grupo_id')->references('id')->on('admin_grupos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('admins', function(Blueprint $table)
        {
            $table->dropForeign('user_id');
            $table->dropForeign('grupo_id');  
        });
    }  
}
