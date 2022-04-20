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
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('factors');
    }
}