<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScenariosTable extends Migration
{

    public function up()
    {
        Schema::create('scenarios', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_married')->default(false);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('scenarios');
    }
}