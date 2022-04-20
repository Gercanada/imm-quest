<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubfactorIdToScenariosTable extends Migration
{
    public function up()
    {
        Schema::table('scenarios', function (Blueprint $table) {
            $table->unsignedBigInteger('subfactor_id');
            $table->foreign('subfactor_id')->references('id')->on('subfactors');
        });
    }

    public function down()
    {
        Schema::table('scenarios', function (Blueprint $table) {
            $table->dropIfExists(['subfactor_id']);
            $table->dropColumn(['subfactor_id']);
        });
    }
}