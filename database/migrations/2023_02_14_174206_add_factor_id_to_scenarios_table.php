<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFactorIdToScenariosTable extends Migration
{
    public function up()
    {
        Schema::table('scenarios', function (Blueprint $table) {
            $table->json('factors_id')->nullable()->references('id')->on('factors');
            // $table->foreign('factor_id')->references('id')->on('factors'); //->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('scenarios', function (Blueprint $table) {
            $table->dropForeign(['factor_id']);
            $table->dropColumn('factor_id');
        });
    }
}
