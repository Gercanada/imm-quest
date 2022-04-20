<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCriterionIdToScenariosTable extends Migration
{
    public function up()
    {
        Schema::table('scenarios', function (Blueprint $table) {
            $table->unsignedBigInteger('criteion_id');
            $table->foreign('criteion_id')->references('id')->on('criteria');
        });
    }

    public function down()
    {
        Schema::table('scenarios', function (Blueprint $table) {
            $table->dropIfExists(['criteion_id']);
            $table->dropColumn(['criteion_id']);
        });
    }
}