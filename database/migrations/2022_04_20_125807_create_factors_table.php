<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactorsTable extends Migration
{

    public function up()
    {
        Schema::create('factors', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('titulo')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('sub_titulo')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('factors');
    }
}
