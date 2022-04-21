<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToScenariosTable extends Migration
{

    public function up()
    {
        Schema::table('scenarios', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('scenarios', function (Blueprint $table) {
            $table->dropIfExists(['user_id']);
            $table->dropColumn(['user_id']);
        });
    }
}